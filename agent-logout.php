<?php
    session_start();

    if(!isset($_SESSION["sessionid"])){
        header("Location: agent-login.php");
    }

    $agentSessionId = $_SESSION["sessionid"];

    include 'includes/database.php';
    include 'includes/select.php';

    $approvalAgents = selectApprovalAgents($conn, 'name', $agentSessionId);
    $currentAgent = $approvalAgents[0]['name'];

    $agentPatentsApproved = count(selectSpecificPatents($conn, 'patent_approval_agent_id', 1 , 'patent_approval_status', 'approved'));
    $agentPatentsPending = count(selectSpecificPatents($conn, 'patent_approval_agent_id', '1', 'patent_approval_status', 'empty'));
    $allUsers = count(selectUsers($conn, 'field_of_specialization', 'General'));


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UWDPS - Agent Dashbord</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="homepage-menus.css">
    <script src="homepage-script.js" defer></script>
    <link rel="stylesheet" href="agent-dashboard.css">
    <script src="agent-dashboard-script.js" defer></script>
    <link rel="stylesheet" href="log-out.css">
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
                    <p>1</p></a>
                </button>
                <button class="login-btn" type="button"><a href="log-out.php"><span>Log Out</span><img src="images/logout1.png" alt=""></a></button>
            </div>
        </div>
    </header>


    <div class="page-title"><p>UWDPS / Agent / Accounts / Logout</p></div>
    <div class="left-side-bar menu-toggle menu-toggler" id="left-side-bar">
        <div class="profile-preview">
            <img src="images/wipo.png" alt="user-1">
            <div class="profile-preview-details">
                <p class="profile-user-name"><?php echo $currentAgent; ?></p>
                <a href="profile.php">view profile</a>
            </div>
        </div>
        <div class="menu agent-dashboard-menu">
            <ul>
                <li>
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
                </li>
            </ul>

            <div class="actions">
                <i class="fa-solid fa-gear"></i>
                <i class="fa-brands fa-accessible-icon"></i>
                <i class="fa-solid fa-download"></i>
            </div>
        </div>
    </div>

    

    <div class="log-out-message container">
        <a href="agent-dashboard.php"><button class="login-btn back-btn"><span>← Back</span></button></a>
        <p>Are you sure you want to log out?</p>
        
        <form action="includes/logout-auth.php" method="post">
            <button class="logout-btn home-btn" name="logout-btn" id="logout-btn">Log out</button>
        </form>
    </div>

    <footer class="uwdps-footer">
        <div class="container">
            <div class="footer-column">
                <h3>About UWDPS</h3>
                <ul>
                    <li><a href="#">Mission</a></li>
                    <li><a href="#">Team</a></li>
                    <li><a href="#">Partnerships</a></li>
                </ul>
            </div>
        
            <div class="footer-column">
                <h3>Patenting Process</h3>
                <ul>
                    <li><a href="#">How it Works</a></li>
                    <li><a href="#">Guidelines</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
        
            <div class="footer-column">
                <h3>Resources</h3>
                <ul>
                    <li><a href="#">Documentation</a></li>
                    <li><a href="#">Tutorials</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
        
            <div class="footer-column">
                <h3>Connect with Us</h3>
                <ul class="social-media-icons">
                    <li><a href="#" class="fa-brands fa-facebook"></a></li>
                    <li><a href="#" class="fa-brands fa-twitter"></a></li>
                    <li><a href="#" class="fa-brands fa-linkedin"></a></li>
                    <li><a href="#" class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    
        <div class="copyright-message">
            <p>&copy; 2024 UWDPS. All rights reserved.</p>
        </div>
    </footer>

    </body>
    </html>

