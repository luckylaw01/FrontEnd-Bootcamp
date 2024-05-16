<?php
    include 'includes/select.php';

    $allPatents = selectPatents($conn, 'patent_approval_status', 'approved');
    $allPatents = array_reverse($allPatents);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patent Certificate</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="patents.css">
    <link rel="stylesheet" href="all-patents.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-DigdvgWB8+eqtGYyMZ1FVnTg2O7jFUdyBbKQbK9HvyqSeYqF2EdrDneFQb2zmyYkTLxHTHkQNoTgAVDREzdC2g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="homepage-menus.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="agent-dashboard.css">
    <script src="homepage-script.js" defer></script>
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
                <button class="login-btn" type="button"><a href="log-out.php"><span>Log out</span><img src="images/logout1.png" alt=""></a></button>
            </div>
        </div>
    </header>

    <div class="page-title"><p>UWDPS / My UWDPS / Explore UWDPS Blockchain </p></div>
    <div class="left-side-bar menu-toggle menu-toggler" id="left-side-bar">
        <div class="profile-preview">
            <img src="images/user-1.png" alt="user-1">
            <div class="profile-preview-details">
                <p class="profile-user-name">Lucky Law</p>
                <a href="profile.php">view profile</a>
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

    <main>
        <div class="ocontainer">
            
            <div class="section-header">
                <div class="cert-page-nav">
                    <button>All</button>
                    <button>Scientific</button>
                    <button>Matematics</button>
                    <button>Computing</button>
                    <button>Other</button>
                </div>
            </div>
        

        

            <h2 class="blockchain-header recent-applications-title">Blockchain</h2>
        <div class="blockchain-wrapper">
            <div class="blockchain-container">
                <div class="blockchain">

                    <?php foreach($allPatents as $patent){
                        echo '
                        
                        <div class="block">
                            <p class="ipc-id">'. $patent['patent_blockchain_id'] .'</p>
                            <p class="block-patent-title">' . $patent['patent_title'] . '</p>
                            <p class="block-patent-owner">' . $patent['patent_applicant_full_name'] . ', <span>' . $patent['patent_country'] . '</span></p>
                            <p class="chain-date">Authenticated on <span>' . $patent['patent_approval_date'] . '</span></p>
                            <p class="approval-agent">World Intellectual Property Organization</p>
                        </div>
                                                
                        ';
                    } ?>

                    
        
                    
                    
                </div>
            </div>
            <button class="prev-btn">&lt;</button>
            <button class="next-btn">&gt;</button>
        </div>
    </div>
        

    <div class="recent-applications" class="container ocontainer">
        <div class="recent-applications-title">Recent Publications</div>
        <div class="applications-div">


            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Publication Id</th>
                        <th>Publisher Name</th>
                        <th>Patent Title</th>
                        <th>Patent Field</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <?php 

        foreach($allPatents as $patent) {
            echo '
                <tr>
                    <td>'. $patent['patent_approval_date'] .'</td>
                    <td>'. $patent['patent_blockchain_id'] .'</td>
                    <td>'. $patent['patent_applicant_full_name'] .'</td>
                    <td>'. $patent['patent_title'] .'</td>
                    <td>'. $patent['patent_claims'] .'</td>
                    <td><button>View</button></td>
                </tr>';
}
            

                    
                    
                ?>
                
                
            </table>
            
        </div>
    </div>

    </main>

    

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
