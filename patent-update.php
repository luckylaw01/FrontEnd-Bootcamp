<?php
// Include the database connection
include "includes/database.php";

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set
    if (isset($_POST["patent_id"]) && isset($_POST["rejectionReason"]) && isset($_POST["reviewNotes"])) {
        // Sanitize and store form data
        $patent_id = $_POST["patent_id"];
        $rejectionReason = $_POST["rejectionReason"];
        $reviewNotes = $_POST["reviewNotes"];

        // Check which button was clicked
        if (isset($_POST["rejectButton"])) {
            // Update patent_approval_status to "Rejected" and store rejection reason
            $sql = "UPDATE patents SET patent_approval_status = 'rejected', patent_rejection_reasons = '$rejectionReason' WHERE patent_id = '$patent_id'";
            $status = "rejected";
        } elseif (isset($_POST["approveButton"])) {
            // Update patent_approval_status to "Approved" and store review notes
            $sql = "UPDATE patents SET patent_approval_status = 'approved', patent_approval_notes = '$reviewNotes' WHERE patent_id = '$patent_id'";
            $status = "approved";
        }

        // Execute SQL query
        if ($conn->query($sql) === TRUE) {

            $_SESSION['message'] = "Update successful!";
            include "includes/select.php";
            include "includes/create-notification.php";
            $thisPatent = selectPatents($conn, 'patent_id', $patent_id);

            $patentOwnerId = $thisPatent[0]['patent_applicant_id'];
            $patentTitle = $thisPatent[0]['patent_title'];

            $thisOwner = selectUsers($conn, 'user_id', $patentOwnerId);
            $thisOwnerName = $thisOwner[0]['first_name'] . $thisOwner[0]['last_name'];

            createNotification($patentOwnerId, 'WIPO Information', 'Patent application ' . $status , 'Dear applicant from UWDPS, your patent application for ' . $patentTitle . ' has been '. $status .' ', 'Admin');

            createNotification(99999999998, 'WIPO Information', 'You have ' . $status .' the patent ' .$patentTitle, 'WIPO,  patent application from '.$thisOwnerName.' has been '. $status .' ', 'Admin');


            header("Location: agent-success.php");



            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;

        }
    } else {
        echo "Form fields are not set.";
        $_SESSION['message'] = "Update unsuccessful!";
        header("Location: fail.php");
    }
} else {
    echo "Form not submitted.";
    header("Location: fail.php");
}

// Close the database connection
$conn->close();

