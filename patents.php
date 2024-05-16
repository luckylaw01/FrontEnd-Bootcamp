<?php
    include 'includes/database.php';
    include 'includes/header.php';
    include 'includes/select.php';

    
    if(!isset($_SESSION['sessionid'])){
        header("Location: login.php");
    }

?>

<div class="page-title"><p>UWDPS / Pages / My patents </p></div>
<div class="left-side-bar menu-toggle menu-toggler" id="left-side-bar">
        <div class="profile-preview">
            <img src="<?php echo $profilePhotoUrl; ?> " alt="user-1">
            <div class="profile-preview-details">
                <p class="profile-user-name"><?php echo $firstName . " " . $lastName; ?></p>
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


    <div class="ocontainer">


        <div class="patent-certificates">
            <!-- <div class="patent-certificate">
                <div class="top-left">
                    <img src="images/logo3.png" alt="UWDPS Logo">
                </div>
                <div class="top-right">
                    <img src="images/wipo.png" alt="Owner's Image">
                </div>
                <div class="heading">
                    <h1><i class="fas fa-certificate"></i>INTERNATIONAL PATENT CERTIFICATE</h1>
                </div>
                <div class="details">
                    <p><strong>International Patent Chain Code</strong><span>56774Y688858YR67TRE884</span></p>
                    <p><strong>Date of Issue</strong> <span>November 15, 2024</span> </p>
                </div>
                <hr>
                <div class="title-wrapper">
                    <p class="title-heading">Title</p>
                </div>
                <div class="title">
                    <h2>AQUADUCT FILTRATION SYSTEM</h2>
                </div>
                <div class="details">
                    <p><strong>On the Field of</strong> <span>STRING THEORY</span></p>
                </div>
                <div class="details awarded-to">
                    <p><strong>Awarded to</strong> Lucky Law, Kenya</p>
                </div>
                <div class="details together-with">
                    <p><strong>Together with</strong> Kimani M, Ishmael K, Emannuel Q</p>
                </div>
                <div class="approval">
                    <p>This patent was issued with the approval of WIPO to the inventors named above</p>
                </div>
            </div> -->

           <?php
                $specificPatents = selectSpecificPatents($conn, 'patent_applicant_id', $userId,'patent_approval_status', 'approved');
                $specificPatents = array_reverse($specificPatents);
                
                if(count($specificPatents) == 0){
                    echo '<h2>You do not have any approved patents yet</h2>';
                }
                
            foreach ($specificPatents as $patent) {
                ?>
                    <div class="patent-certificate">
                    <div class="top-left">
                        <img src="images/logo3.png" alt="UWDPS Logo">
                    </div>
                    <div class="top-right">
                        <img src="images/wipo.png" alt="Owner's Image">
                    </div>
                    <div class="heading">
                        <h1><i class="fas fa-certificate"></i>INTERNATIONAL PATENT CERTIFICATE</h1>
                    </div>
                    <div class="details">
                        <p><strong>International Patent Chain Code</strong><span><?php echo $patent['patent_blockchain_id']; ?></span></p>
                        <p><strong>Date of Issue</strong> <span><?php echo date('F j, Y', strtotime($patent['patent_approval_date'])); ?></span> </p>
                    </div>
                    <hr>
                    <div class="title-wrapper">
                        <p class="title-heading">Title</p>
                    </div>
                    <div class="title">
                        <h2><?php echo $patent['patent_title']; ?></h2>
                    </div>
                    <div class="details">
                        <p><strong>On the Field of</strong> <span><?php echo $patent['patent_claims']; ?></span></p>
                    </div>
                    <div class="details awarded-to">
                        <p><strong>Awarded to</strong> <?php echo $patent['patent_applicant_full_name']; ?>, <?php echo $patent['patent_country']; ?></p>
                    </div>
                    <div class="details together-with">
                        <p><strong>Individual</strong></p>
                    </div>
                    <div class="approval">
                        <p>This patent was issued with the approval of WIPO to the inventors named above</p>
                    </div>
                </div>
        <?php
    }
    ?>

           
            

        </div>
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
