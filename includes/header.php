<?php

    session_start();
    require_once 'database.php';

    if (isset($_SESSION['sessionid'])){
        $sessionId = $_SESSION['sessionid'];



       $sql = "SELECT * FROM users WHERE user_id = " . $sessionId;
       $result = mysqli_query($conn, $sql);

       $rowCount = mysqli_num_rows($result);
       
       if($rowCount > 0){

        while($row = mysqli_fetch_assoc($result))
        {
            $userId = $row['user_id']; // Display user_id
            $firstName =  $row['first_name']; // Display firstname
            $lastName = $row['last_name'];
            $dateRegistered = $row['date_registered'];
            $email = $row['email'];
            $country = $row['country'];
            $fieldOfSpecialization = $row['field_of_specialization'];
            $profilePhotoUrl = $row['profile_photo'];     
        }
        
        }
        else {
            echo 'Error Fetcing user data';
        }
    }

 
// Assuming $conn is your database connection established earlier

// Fetch data from the patents table based on some condition, like user_id
$sql = "SELECT * FROM patents WHERE patent_applicant_id = " . $sessionId;
$result = mysqli_query($conn, $sql);

// Check if the query was executed successfully
if ($result) {
    // Check if there are any rows returned
    $rowCountPatent = mysqli_num_rows($result);
    $patentsToDate = $rowCountPatent;

    if($rowCountPatent > 0) {
        // Loop through each row in the result set
        while($row = mysqli_fetch_assoc($result)) {
            // Retrieve data from the row and assign it to variables
            $patentId = $row['patent_id'];
            $applicantFullName = $row['patent_applicant_full_name'];
            //$applicantEmail = $row['patent_applicant_email'];
            $patentTitle = $row['patent_title'];
            $patentDescription = $row['patent_description'];
            $patentClaims = $row['patent_claims'];
            // Add more fields as needed

            /*
            echo "Patent ID: $patentId <br>";
            echo "Applicant Full Name: $applicantFullName <br>";
            //echo "Applicant Email: $applicantEmail <br>";
            echo "Patent Title: $patentTitle <br>";
            echo "Patent Description: $patentDescription <br>";
            echo "Patent Claims: $patentClaims <br>";
            */
        }
    } else {
        
        // echo "No patents found for the user.";
    }
} else {
    // Handle the case where the SQL query failed
    echo "Error executing SQL query: " . mysqli_error($conn);
}

include "includes/create-notification.php";

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UWDPS - HOME</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="homepage-menus.css">
    <script src="homepage-script.js" defer></script>
    <link rel="stylesheet" href="log-out.css">
    <link rel="stylesheet" href="notifications.css">
    <link rel="stylesheet" href="patents.css">
    <link rel="stylesheet" href="animated-alert.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="menu-and-search">
            <div id="menu-bar" class="hamburger-menu"><i class="fa-solid fa-bars"></i></div>
            <!-- <img  src="images/hamburger-menu-icon-png-white-8.jpg" alt="" class="hamburger-menu"> -->
                <div class="search-bar">
                    <input type="text" placeholder="Search patents">
                    <button class="search-button"><img src="images/search.png" alt=""></button>
                </div>
            </div>
            
            <a href="index.php"><img src="images/uwdps logo.png" alt="" class="logo"></a>
            <div class="header-buttons">
                <a href="notifications.php"><button class="login-btn notifications-button"><i class="fa-solid fa-bell"></i>
                    <p><?php echo $newNotifications; ?></p></a>
                </button>
                <button class="login-btn" type="button"><a href="log-out.php"><span>Log out</span><img src="images/logout1.png" alt=""></a></button>
            </div>
        </div>
    </header>