<?php
// Include database connection
include "includes/database.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $subject = $_POST['subject'];
    $destination = $_POST['destination'];
    $message = $_POST['message'];
    $time_stamp = date('Y-m-d H:i:s'); // Current timestamp

    // If destination is specific user, retrieve user_id from user email
    if ($destination == 'specific-user') {
        $user_email = $_POST['user-email'];
        // Retrieve user_id based on user_email from users table
        $query = "SELECT user_id FROM users WHERE email = '$user_email'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $destination = $row['user_id'];
        } else {
            // User with provided email does not exist
            // Handle error or display message accordingly
            header("Location: fail.php");
            exit(); // Terminate script execution
        }
    }

    // Insert announcement into notifications table
    $query = "INSERT INTO notifications (destination, source, time_stamp, type, subject, message) 
              VALUES ('$destination', '0', '$time_stamp', 'announcement', '$subject', '$message')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Announcement successfully sent
        // Redirect or display success message 
        header("Location: agent-success.php");
        exit(); // Terminate script execution
    } else {
        // Error occurred while sending announcement
        // Handle error or display message accordingly
        header("Location: fail.php");
        exit(); // Terminate script execution
    }
} else {
    // Form was not submitted
    // Redirect or display error message accordingly
    header("Location: fail.php");
    exit(); // Terminate script execution
}
?>
