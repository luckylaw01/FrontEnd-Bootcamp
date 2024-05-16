<?php

// Include your database connection file
include 'database.php';

$sessionId = $_SESSION['sessionid'];

// Function to create a notification
function createNotification($destination, $type, $subject, $message, $source = 'admin') {
    global $conn; // Assuming $conn is your database connection object

    // Prepare the SQL statement
    $sql = "INSERT INTO notifications (destination, source, type, subject, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssss", $destination, $source, $type, $subject, $message);

    // Execute the statement
    if ($stmt->execute()) {
        // Notification created successfully
        return true;
    } else {
        // Notification creation failed
        return false;
    }

    // Close the statement
    
}

/*
// Example usage to create an announcement notification from admin
createNotification($destination, 'announcement', $subject, $message);

// Example usage to create a notification with custom source
createNotification($destination, 'application', $subject, $message, 'system');

*/

function getNotificationsWithin24Hours($conn, $sessionId) {
    // SQL query
    $sql = "SELECT *
            FROM notifications
            WHERE time_stamp >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
            AND
            destination = '$sessionId'
            ";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if query executed successfully
    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }

    // Fetch data as an associative array
    $notifications = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Free result set
    mysqli_free_result($result);

    // Close the connection
    // mysqli_close($conn);

    // Return the fetched data
    return $notifications;
}


    $newNotifications = getNotificationsWithin24Hours($conn, $sessionId);
    $newNotifications = count($newNotifications);
