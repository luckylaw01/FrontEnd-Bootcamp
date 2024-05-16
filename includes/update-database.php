<?php
// Include your database connection file
include 'database.php';
include 'create-notification.php';
include 'select.php';



// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the data sent from the client-side (JavaScript)
    $patentId = $_POST['patentId'];
    $status = $_POST['status'];
    $rejectionReason = $_POST['rejectionReason'];
    $reviewNotes = $_POST['reviewNotes'];

    // Update the database
    $sql = "UPDATE patents SET patent_approval_status = ?, patent_rejection_reasons = ?, patent_approval_notes = ? WHERE patent_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
    // Handle the error, such as printing the error message
    echo "Error preparing SQL statement: " . $conn->error;
    } 
    else {
    // Proceed with binding parameters and executing the statement
    $stmt->bind_param("sssi", $status, $rejectionReason, $reviewNotes, $patentId);


    // Execute the statement
    if ($stmt->execute()) {
        // Database update successful
        echo "Database updated successfully";

        $thisPatent = selectPatents($conn, 'patent_id', $patentId);
        $patentOwnerId = $thisPatent[0]['patent_applicant_id'];
        $patentTitle = $thisPatent[0]['patent_title'];

        $thisOwner = selectUsers($conn, 'user_id', $patentOwnerId);
        $thisOwnerName = $thisOwner[0]['first_name'] . $thisOwner[0]['last_name'];

        createNotification($patentOwnerId, 'WIPO Information', 'Patent application ' . $status , 'Dear applicant from UWDPS, your patent application for ' . $patentTitle . ' has been '. $status .' ', 'Admin');

        createNotification(99999999998, 'WIPO Information', 'You have ' . $status .' the patent ' .$patentTitle, 'WIPO,  patent application from '.$thisOwnerName.' has been '. $status .' ', 'Admin');

    } else {
        // Database update failed
        echo "Error updating database: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}
}

// Close the database connection
$conn->close();
