<?php
    session_start();
    if(!isset($_SESSION['sessionid'])){
        header("Location: login.php");
    }
    include 'includes/create-notification.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UWDPS - Apply for a patent</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="homepage-menus.css">
    <script src="homepage-script.js" defer></script>
    <link rel="stylesheet" href="patent-application.css">
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
                    <p><?php echo $newNotifications ?></p></a>
                </button>
                <button class="login-btn" type="button"><a href="log-out.php"><span>Log out</span><img src="images/logout1.png" alt=""></a></button>
            </div>
        </div>
    </header>


    <div class="page-title"><p>UWDPS / My UWDPS / Apply for a patent </p></div>
    <div class="left-side-bar menu-toggle menu-toggler" id="left-side-bar">
        <div class="profile-preview">
            <img src="images/user-1.png" alt="user-1">
            <div class="profile-preview-details">
                <p class="profile-user-name">Lucky Law</p>
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
                <a href="patent-application.php">Apply now</a>
            </li>
            <li>
                <a href="index.php">Back To Home</a>
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

    <div class="ocontainer">
    <form action="includes/patent-application-inc.php" method="post" id="patent-application-form" >
    <h1 class="form-heading">Apply for a patent</h1>
    
    <!-- Applicant Information -->
    <h2><i class="fas fa-user"></i> Applicant Information</h2>
    <div class="form-group">
        <label for="patent-applicant-full-name"><i class="fas fa-signature"></i> Full Name:</label>
        <input type="text" id="applicant-name" name="patent-applicant-full-name" required>
    </div>
    <div class="form-group">
        <label for="patent-applicant-email"><i class="fas fa-envelope"></i>Your Email</label>
        <input type="email" id="patent-applicant-email" name="patent-applicant-email" required>
    </div>

    <!-- Applicants Information -->
    <h2><i class="fas fa-user"></i>Other Applicants Information</h2>
    <div class="form-group">
        <label for="patent-applicant-email"><i class="fas fa-envelope"></i>Second Applicant Email</label>
        <input type="email" id="patent-applicant2-email" name="patent-applicant2-email" >
    </div>
    <div class="form-group">
        <label for="patent-applicant-email"><i class="fas fa-envelope"></i>Third Applicant Email</label>
        <input type="email" id="patent-applicant3-email" name="patent-applicant3-email" >
    </div>
    <div class="form-group">
        <label for="patent-applicant-email"><i class="fas fa-envelope"></i>Fourth Applicant Email</label>
        <input type="email" id="patent-applicant4-email" name="patent-applicant4-email" >
    </div>
    
    <!-- <div class="form-group">
        <label for="patent-applicant-country"><i class="fas fa-globe"></i> Country:</label>
        <input type="text" id="patent-applicant-country" name="patent-applicant-country" required>
    </div> -->

    <!-- Title and Description of the Invention -->
    <h2><i class="fas fa-file-alt"></i> Title and Description of the Invention</h2>
    <div class="form-group">
        <label for="patent-title"><i class="fas fa-heading"></i> Title:</label>
        <input type="text" id="patent-title" name="patent-title" required>
    </div>
    <div class="form-group">
        <label for="patent-description"><i class="fas fa-align-left"></i> Description:</label>
        <textarea id="patent-description" name="patent-description" rows="4" required></textarea>
    </div>

    <!-- Claims -->
    <h2><i class="fas fa-gavel"></i> Classification</h2>
    <div class="form-group">
    <label for="patent-field"><i class="fas fa-puzzle-piece"></i> Patent Field:</label>
    <select id="patent-claims" name="patent-claims" required>
        <option value="" disabled selected>Select Patent Field</option>
        <option value="Science">Science</option>
        <option value="Mathematics">Mathematics</option>
        <option value="Mechanics">Mechanics</option>
        <option value="Electricity">Electricity</option>
        <option value="Biology">Biology</option>
        <option value="Chemistry">Chemistry</option>
        <option value="Physics">Physics</option>
        <option value="Computer Science">Computer Science</option>
        <option value="Engineering">Engineering</option>
        <option value="Medicine">Medicine</option>
        <option value="Psychology">Psychology</option>
        <option value="Sociology">Sociology</option>
        <option value="Geology">Geology</option>
        <option value="Astronomy">Astronomy</option>
        <option value="Economics">Economics</option>
        <option value="Political Science">Political Science</option>
        <option value="History">History</option>
        <option value="Philosophy">Philosophy</option>
        <option value="Linguistics">Linguistics</option>
    </select>
</div>


    <!-- Drawings or Diagrams -->
    <h2><i class="fas fa-paint-brush"></i> Drawings or Diagrams</h2>
    <div class="form-group">
        <label for="patent-drawings"><i class="fas fa-image"></i> Upload Drawings:</label>
        <input type="file" id="patent-drawings" name="patent-drawings" accept="image/*">
    </div>

    <!-- Prior Art References -->
    <h2><i class="fas fa-book-open"></i> Abstract and References</h2>

    <div class="form-group">
        <label for="prior-art"><i class="fas fa-file-alt"></i> Abstract:</label>
        <textarea id="patent-abstract" name="patent-abstract" rows="4"></textarea>
    </div>

    <div class="form-group">
        <label for="prior-art"><i class="fas fa-file-alt"></i> References:</label>
        <textarea id="prior-art" name="prior-art" rows="4"></textarea>
    </div>

    <!-- Video link -->
    <h2><i class="fas fa-video"></i> Video link</h2>
    <div class="form-group">
        <label for="video-link"><i class="fas fa-link"></i> Video link:</label>
        <input type="text" id="video-link" name="video-link">
    </div>

    <!-- Patent Country -->
    <h2><i class="fas fa-globe"></i> Patent Country</h2>
    <div class="form-group">
        <label for="patent-country"><i class="fas fa-globe"></i> Patent Country:</label>
        <input type="text" id="patent-country" name="patent-country" required>
    </div>

    <!-- Additional Information -->
    <h2><i class="fas fa-info-circle"></i> Additional Information</h2>
    <div class="form-group">
        <label for="additional-info"><i class="fas fa-comment"></i> Additional Info:</label>
        <textarea id="additional-info" name="additional-info" rows="4"></textarea>
    </div>

    <!-- Submit Button -->
    <button type="submit" name="patent-application-submit"><i class="fas fa-paper-plane"></i> Submit Application</button>
    </form>

        
    </div>
    


    <?php
        include "includes/footer.php";
    ?>

</body>
</html>