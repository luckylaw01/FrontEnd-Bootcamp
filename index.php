<?php
     include 'includes/database.php';
     //include 'includes/login-auth.php';
    session_start();
    

    if (isset($_SESSION['sessionid']))
    {
        $sessionId = $_SESSION['sessionid'];
        include 'includes/select.php';
        $currentUser = selectUsers($conn, 'user_id', $sessionId);
        $currentUserName = $currentUser[0]['first_name'] . " " . $currentUser[0]['last_name'];
        $dateRegistered = $currentUser[0]['date_registered'];
        $email = $currentUser[0]['email'];
        $country = $currentUser[0]['country'];
        $fieldOfSpecialization = $currentUser[0]['field_of_specialization'];
        $profilePhotoUrl = $currentUser[0]['profile_photo'];
    }

    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UWDPS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="homepage-menus.css">
    <script src="homepage-script.js" defer></script>
    <script src="app.js" defer></script>
</head>
<body>

<?php

    if (isset($_SESSION['sessionid']))
    {
        include 'includes/create-notification.php';

        echo '
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
                        <p>'.$newNotifications.'</p></a>
                    </button>
                    <button class="login-btn" type="button"><a href="log-out.php"><span>Log out</span><img src="images/logout1.png" alt=""></a></button>
                </div>
            </div>
        </header>
        ';
    



    echo '
    <div class="left-side-bar menu-toggle menu-toggler" id="left-side-bar">
     <div class="profile-preview">
        <img src="<?php echo $profilePhotoUrl; ?>" alt="user-1">
        <div class="profile-preview-details">
            <p class="profile-user-name"><?php echo $currentUserName; ?></p>
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
    ';

    }

    else{

        echo '
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
                        </a>
                    </button>
                    <button class="login-btn" type="button"><a href="log-out.php"><img src="images/logout1.png" alt=""><span>Log In</span></a></button>
                </div>
            </div>
        </header>
        ';

        echo'
        <div class="left-side-bar menu-toggle menu-toggler" id="left-side-bar">
        <!-- <div class="profile-preview">
            <img src="images/user-1.png" alt="user-1">
            <div class="profile-preview-details">
                <p class="profile-user-name">Lucky Law</p>
                <a href="">view profile</a>
            </div>
        </div> -->

        <div class="profile-preview">
            <div class="profile-preview-details">
                <p class="profile-user-name">
                    You are not Logged In
                </p>
            </div>
        </div>

        <div class="menu">
            <ul>
                <!-- <li>
                    <a href="">View Patents</a>
                </li>
                <li>
                    <a href="">Blog</a>
                </li>
                <li>
                    <a href="">Patnerships</a>
                </li>
                <li>
                    <a href="">Applications</a>
                </li> -->

                <li>
                    <a href="login.php">Log in</a>
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
        ';
    }
?>

    


    


    <main class="main-content">
        
        <div class="welcome">

                <div class="welcome-content">
                    <h1>File your Patent with ease</h1>
                    <p>With the Universal Web-3 Open-source Digital Patenting system. Track your patenting progress and get full proof protection from patent trolling through blockchain integration</p>

                    <?php
                        if (isset($_SESSION['sessionid'])){
                            echo'<button type="button"><a href="homepage.php">Get started <img src="images/right-arrow.png" alt=""></a></button>';
                        }
                        else{
                            echo'<button type="button"><a href="login.php">Get started <img src="images/right-arrow.png" alt=""></a></button>';
                        }
                    ?>

                </div>
                <div class="welcome-image">
                    <img src="images/31ad4c76244561.5c90a7fe64754.gif" alt="Welcome">
                </div>

        </div>

   

        <div class="section-header">
            <h2>Complete your Patent Application Anywhere</h2>

            <button class="login-btn">Apply now <img src="images/right-arrow.png" alt=""></button>
        </div>

        <div class="home-card">
            <div class="home-card-image">
                <img src="images/writting.jpg" alt="Apply">
            </div>
            <div class="home-card-content">    
                <h2>An application you can complete anywere, a review that get's back to you in no time! Patent your life</h2>
                <p>Enjoy a seamless application from the   palm of your hand,
                    Let the world recognize your invention because you deserve it.
                    With every tap and swipe, you'll be in command,
                    And your app will be the talk of the town, every bit.
                    
                    From the first line of code to the final release,
                    You've poured your heart and soul into this creation.
                    Now it's time to let your app take center stage,
                    And show the world your innovation.  
                </p>
                <div class="home-card-buttons">
                    <button class="home-btn"><a href="">Learn more</a></button>
                    <button class="home-btn"><a href="">Apply now</a> </button>
                </div>
            </div>
        </div>


        <div class="section-header">
            <h2>Worldwide Penetration for all Applicants</h2>
            <button class="login-btn">Apply now <img src="images/right-arrow.png" alt=""></button>
        </div>

        <div class="home-card">
            <div class="home-card-content">    
                <h2>It's Open source, It's Free</h2>
                <p>It's open source, free and accessible to everyone,
                    Let the world benefit from your innovation because you share it.
                    With every line of code and every contribution, you'll make a difference,
                    And your project will be the source of inspiration, every bit.
                    
                    From the first commit to the final release,
                    You've collaborated with others in this creation.
                    Now it's time to let your project shine in the open,
                    And show the world your vision.    
                </p>
                <div class="home-card-buttons">
                    <button class="home-btn"><a href="">Learn more</a></button>
                </div>
            </div>
            <div class="home-card-image">
                <img src="images/scientist.jpg" alt="Apply">
            </div>
        </div>

        <div class="section-header">
            <h2>Select from different services</h2>
            <button class="login-btn">Apply now <img src="images/right-arrow.png" alt=""></button>
        </div>

        <div class="service-box">
            <div class="service-card">
                <img src="images/1027-scaled.jpg" alt="">
                <div class="service-content">
                    <h2>Apply For a Patent</h2>
                    <p >Make your application easy and now</p>
                    <button class="home-btn"><a href=""><span>Apply Now</span> → </a></button>
                </div>
            </div>

            <div class="service-card">
                <img src="images/chem.jpg" alt="">
                <div class="service-content">
                    <h2>Apply For a Patent</h2>
                    <p >Make your application easy and now</p>
                    <button class="home-btn"><a href=""><span>Apply Now</span> → </a></button>
                </div>
            </div>

            <div class="service-card">
                <img src="images/idea.jpg" alt="">
                <div class="service-content">
                    <h2>Apply For a Patent</h2>
                    <p >Make your application easy and You get to make the call</p>
                    <button class="home-btn"><a href=""><span>Apply Now</span> → </a></button>
                </div>
            </div>

            <div class="service-card">
                <img src="images/huge database.jpg" alt="">
                <div class="service-content">
                    <h2>Apply For a Patent</h2>
                    <p >Make your application easy and now</p>
                    <button class="home-btn"><a href=""><span>Apply Now</span> → </a></button>
                </div>
            </div>
        </div>

        <div class="section-header">
            <h2>Explore our patners</h2>
            <button class="login-btn"> view all <img src="images/right-arrow.png" alt=""></button>
        </div>

        <div class="patners-box">
            <div class="patners-box-group">
                <div class="patner-card">
                    <img src="images/microsoft logo.png" alt="">
                    <p class="patner-name">Microsoft Co.</p>
                    <a href="">www.microsoft.com</a>
                </div>
                <div class="patner-card">
                    <img src="images/Google-Symbol.png" alt="">
                    <p class="patner-name">Google LLC</p>
                    <a href="">www.patent360.com</a>
                </div>
                <div class="patner-card">
                    <img src="images/mmu.png" alt="">
                    <p class="patner-name">Multimedia University</p>
                    <a href="">www.mmu.ac.ke</a>
                </div>
                <div class="patner-card">
                    <img src="images/logo.png" alt="">
                    <p class="patner-name">Patent 360</p>
                    <a href="">www.patent360.com</a>
                </div>
            </div>

            <div class="patners-box-group">
                <div class="patner-card">
                    
                </div>
                <div class="patner-card">
                    <img src="images/wipo.png" alt="">
                    <p class="patner-name">WIPO Organization</p>
                    <a href="">www.wipo.org</a>
                </div>
                <div class="patner-card">
                    <img src="images/binance.png" alt="">
                    <p class="patner-name">binance</p>
                    <a href="">www.binance.com</a>
                </div>
                <div class="patner-card">
                </div>
            </div>            
        </div>
    </main>



    <?php
        include 'includes/footer.php';
    ?>