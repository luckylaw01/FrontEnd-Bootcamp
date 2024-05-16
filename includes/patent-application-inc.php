<?php
// Include your database connection file here
include_once 'database.php';

include 'header.php';
include 'create-notification.php';

// Check if form is submitted
if(isset($_POST['patent-application-submit'])) {
    // Get form data
    $applicantFullName = $_POST['patent-applicant-full-name'];
    $applicantEmail = $_POST['patent-applicant-email'];
    $applicant2Email = !empty($_POST['patent-applicant2-email']) ? $_POST['patent-applicant2-email'] : 'empty';
    $applicant3Email = !empty($_POST['patent-applicant3-email']) ? $_POST['patent-applicant3-email'] : 'empty';
    $applicant4Email = !empty($_POST['patent-applicant4-email']) ? $_POST['patent-applicant4-email'] : 'empty';
    $patentTitle = $_POST['patent-title'];
    $patentDescription = $_POST['patent-description'];
    $patentClaims = $_POST['patent-claims'];
    $patentDrawings = isset($_FILES['patent-drawings']) ? $_FILES['patent-drawings']['name'] : null;
    $patentAbstract = $_POST['patent-abstract'];
    $patentReferences = $_POST['prior-art'];
    $patentVideoLink = $_POST['video-link'];
    $patentCountry = $_POST['patent-country'];
    $additionalInfo = $_POST['additional-info'];

    // Generate blockchain ID
    function generateRandomCode($length = 20) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $code;
    }

    $patentBlockchainID = generateRandomCode();

    // Set default values
    $patentFilingDate = date('Y-m-d');
    $patentApprovalDate = date('Y-m-d');
    $patentApprovalAgentID = 1; // Assuming default agent ID is 1
    $patentApprovalStatus = 'empty';

    // Include your mysqli connection file
    // For example: include_once('mysqli_connection.php');
    include 'database.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare statement
    $stmt = $conn->prepare("INSERT INTO patents (patent_applicant_id, patent_blockchain_id, patent_applicant_full_name, patent_applicant2_email, patent_applicant3_email, patent_applicant4_email, patent_filing_date, patent_approval_date, patent_approval_agent_id, patent_approval_status, patent_title, patent_description, patent_drawings, patent_video_link, patent_abstract, patent_claims, patent_references, patent_country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("ssssssssisssssssss", $userId, $patentBlockchainID, $applicantFullName, $applicant2Email, $applicant3Email, $applicant4Email, $patentFilingDate, $patentApprovalDate, $patentApprovalAgentID, $patentApprovalStatus, $patentTitle, $patentDescription, $patentDrawings, $patentVideoLink, $patentAbstract, $patentClaims, $patentReferences, $patentCountry);

    // Execute statement
    $stmt->execute();

    // Close statement
    $stmt->close();

    // Close connection
    

    createNotification($userId, 'System alerts', 'Successful submission' , 'Dear sir, your submission for the patent ' . $patentTitle . ' has been recieved and is under review!' , 'UWDPS system');
    // Redirect after successful submission
    // header('Location: success.php');
    // exit();

    $conn->close();

    header('Location: ../success-page.php');
}
else{
    header('Location: ../fail.php');
}

