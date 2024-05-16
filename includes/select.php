<?php
// Include your database connection file
include 'database.php';

// Function to select notifications based on field and value
function selectNotifications($conn, $field, $value) {
    $notifications = array();
    $sql = "SELECT * FROM notifications WHERE $field = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $value);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Check if there are any notifications
    if (mysqli_num_rows($result) > 0) {
        // Loop through each notification and store them in an array
        while ($row = mysqli_fetch_assoc($result)) {
            $notifications[] = $row;
        }
    }
    
    return $notifications;
}

// Function to select patents based on field and value
function selectPatents($conn, $field, $value) {
    global $patents;
    $patents = array();
    $sql = "SELECT * FROM patents WHERE $field = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $value);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row in the result set and store them in an array
        while ($row = mysqli_fetch_assoc($result)) {
            $patents[] = $row;
        }
    }
    
    return $patents;
}

$specificPatents = [];
function selectSpecificPatents($conn, $field1, $value1, $field2, $value2) {
    global $specificPatents;
    $patents = array();
    $sql = "SELECT * FROM patents WHERE $field1 = ? AND $field2 = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        // If there's an error in preparing the statement, handle it here
        die('Error preparing statement: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'ss', $value1, $value2);
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        // If there's an error in executing the statement, handle it here
        die('Error executing statement: ' . mysqli_stmt_error($stmt));
    }

    $result = mysqli_stmt_get_result($stmt);
    
    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row in the result set and store them in an array
        while ($row = mysqli_fetch_assoc($result)) {
            $specificPatents[] = $row;
        }
    }
    
    return $specificPatents;
}


// Function to select users based on field and value
function selectUsers($conn, $field, $value) {
    global $users;
    $users = array();
    $sql = "SELECT * FROM users WHERE $field = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $value);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row in the result set and store them in an array
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }
    
    return $users;
}




// Include your database connection file


// Function to select records from the approval_agent table based on field and value
function selectApprovalAgents($conn, $field, $value) {
    $agents = array();

    // Prepare SQL statement
    $sql = "SELECT * FROM approval_agent WHERE $field = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameter
    mysqli_stmt_bind_param($stmt, 's', $value);

    // Execute statement
    mysqli_stmt_execute($stmt);

    // Get result
    $result = mysqli_stmt_get_result($stmt);

    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($result)) {
            // Store each row in the agents array
            $agents[] = $row;
        }
    }

    // Return the array of agents
    return $agents;
}





// Example usage
// $notifications = selectNotifications($conn, 'destination', $currentUserId);
// $patents = selectPatents($conn, 'patent_applicant_id', $currentUserId);
// $users = selectUsers($conn, 'user_id', $currentUserId);
// $specificPatents = selectSpecificPatents($conn, 'patent_approval_status', 'approved', 'patent_country', 'Kenya');


// Close the database connection
// mysqli_close($conn);





