<?php

    include 'includes/header.php';

    if(!isset($_SESSION['sessionid'])){
        header("Location: login.php");
    }

    include 'includes/select.php';
    

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>


<div class="left-side-bar menu-toggle menu-toggler" id="left-side-bar">
        <div class="profile-preview">
            <img src="<?php echo $profilePhotoUrl; ?> " alt="user-1">
            <div class="profile-preview-details">
                <p class="profile-user-name"><?php echo $firstName . " " . $lastName; ?></p>
                <a href="">view profile</a>
            </div>
        </div>
        <div class="menu">
            <ul>
            <li>
                <a href="homepage.php">User Dashboard</a>
            </li>
            <li>
                <a href="patents.php">View Patents</a>
            </li>
            <li>
                <a href="all-patents.php">Blog</a>
            </li>
            <li>
                <a href="patners.php">Patnerships</a>
            </li>
            <li>
                <a href="patent-application.php">Apply now</a>
            </li>
            <li>
                <a href="contact-us.php">Contact us</a>
            </li>
            </ul>

            <div class="actions">
                <i class="fa-solid fa-gear"></i>
                <i class="fa-brands fa-accessible-icon"></i>
                <i class="fa-solid fa-download"></i>
            </div>
        </div>
    </div>

<div class="page-title"><p>UWDPS / Home / pages / profile</p></div>

<div class="profile-card">
    <div class="profile-card-heading">
        <p>You are logged in as <span><?php echo $firstName . ' ' . $lastName ?></span></p>
        <img src="<?php echo $profilePhotoUrl ?>" alt="">
    </div>
    <div class="profile-card-body">
        <div class="profile-cover-photo">
            <img src="images/lightbulb-explode-innovation_1240.jpg" alt="">
        </div>
        <div class="profile-details">
            <div class="profile-detail-wrapper">
                <p class="profile-label"><i class="fas fa-user"></i> Name</p>
                <p class="profile-name"><?php echo $firstName . ' ' . $lastName ?></p>
            </div class="profile-detail-wrapper">
            <div class="profile-detail-wrapper">
                <p class="profile-label"><i class="fas fa-envelope"></i> Email</p>
                <p class="profile-email"><?php echo $email ?></p>
            </div>
            <div class="profile-detail-wrapper">
                <p class="profile-label"><i class="fas fa-globe"></i> Country</p>
                <p class="profile-country"><?php echo $country ?></p>
            </div>
            <div class="profile-detail-wrapper">
                <p class="profile-label"><i class="fas fa-graduation-cap"></i> Field of specialization </p>
                <p class="profile-specialization-field"><?php echo $fieldOfSpecialization ?></p>
            </div>
            <div class="profile-detail-wrapper">
                <p class="profile-label"><i class="fas fa-calendar-alt"></i> Registered On</p>
                <p class="profile-date-registered"><?php echo $dateRegistered ?></p>
            </div>
        </div>
        <form action="" method="post">
            <div class="profile-footer">
                <a href="homepage.php"><button><i class="fas fa-home"></i> Back Home</button></a>
                <button type="button" id="edit-profile"><i class="fas fa-edit"></i> Edit Profile</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>