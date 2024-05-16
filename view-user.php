<?php
    include 'includes/database.php'; // Include the database connection file

    // Check if user_id is sent via POST method
    if(isset($_POST['user_id'])) {
        // Sanitize the user_id to prevent SQL injection
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

        // Query to fetch user details based on user_id
        $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Fetch user details
            $row = $result->fetch_assoc();

            // Extract user details
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $date_registered = $row['date_registered'];
            $country = $row['country'];
            $field_of_specialization = $row['field_of_specialization'];

            // You can fetch additional details like profile photo, number of patents, etc. if needed
        } else {
            // No user found with the provided user_id
            // You can handle this scenario accordingly, e.g., redirect to an error page
            echo "No user found with the provided user ID.";
            exit(); // Stop further execution
        }
    } else {
        // If user_id is not provided, handle the scenario accordingly, e.g., redirect to an error page
        echo "User ID not provided.";
        exit(); // Stop further execution
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
    <!-- Include any additional stylesheets or scripts needed for this page -->
    <style>

        .all-wrapper{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;

        }
        /* Custom styling for user profile page */
        .user-card {
            display: flex;
            background-color: #f0f0f0;
            border-radius: 15px;
            overflow: hidden;
            width: 80%;
            margin: auto;
        }

        .user-card-cover-photo {
            flex: 1;
            max-height: 300px;
            object-fit: cover;
        }

        .user-card-profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-top: 75px; /* Adjust to center vertically */
            margin-left: -75px; /* Adjust to create space between cover photo and profile photo */
            border: 5px solid #fff; /* Add border around profile photo */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Add shadow to profile photo */
        }

        .user-card-content {
            flex: 2;
            padding: 20px;
        }

        .user-card-content h2 {
            margin-top: 0;
            color: #333;
        }

        .user-card-content p {
            color: #666;
        }

        .user-card-content .user-details {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .user-card-content .user-details p {
            margin: 5px 0;
        }

        .user-card-content .user-details .button-container {
            text-align: center;
        }

        .user-card-content .user-details .button-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 5px;
            transition: background-color 0.3s ease;
        }

        .user-card-content .user-details .button-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="all-wrapper">
        <div class="user-card">
            <!-- Cover Photo -->
            <img src="images/writting.jpg" alt="Cover Photo" class="user-card-cover-photo">
            <!-- Profile Photo -->
            <img src="images/user-1.png" alt="Profile Photo" class="user-card-profile-photo">
            <div class="user-card-content">
                <!-- Display User's Name -->
                <h2><?php echo $first_name . " " . $last_name; ?></h2>
                <div class="user-details">
                    <!-- Display User Details -->
                    <p><strong>Field of Specialization:</strong> <?php echo $field_of_specialization; ?></p>
                    <p><strong>Date Registered:</strong> <?php echo $date_registered; ?></p>
                    <p><strong>Country:</strong> <?php echo $country; ?></p>
                    <!-- Add more user details as needed -->

                    <!-- Add the button container -->
                    <div class="button-container">
                        <button onclick="window.history.back();">Back</button> <!-- Back button to go back to the previous page -->
                        <!-- Add Edit and Delete buttons as needed -->
                        <!-- Example: -->
                        <!-- <button>Edit User</button> -->
                        <!-- <button>Delete User</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
