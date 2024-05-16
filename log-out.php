<?php
     include 'includes/header.php';

     if(!isset($_SESSION['sessionid'])){
        header("Location: login.php");
    }
?>

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
                    <a href="all-patents.php">Blockchain</a>
                </li>
                
                <li>
                    <a href="patent-application.php">Applications</a>
                </li>
            </ul>

            <div class="actions">
                <i class="fa-solid fa-gear"></i>
                <i class="fa-brands fa-accessible-icon"></i>
                <i class="fa-solid fa-download"></i>
            </div>
        </div>
    </div>

    <div class="page-title"><p>UWDPS / Home / Pages/ Log out </p></div>
    <div class="log-out-message container">
        <a href="homepage.php"><button class="back-btn"><span>← Back</span></button></a>
        <p>Are you sure you want to log out?</p>
        
        <form action="includes/logout-auth.php" method="post">
            <button class="logout-btn home-btn" name="logout-btn" id="logout-btn">Log out</button>
        </form>
    </div>

    <?php 
        include 'includes/footer.php';
    ?>