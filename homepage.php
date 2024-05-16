<?php
    include 'includes/header.php';
    if(!isset($_SESSION['sessionid'])){
        header("Location: login.php");
    }

    include 'includes/select.php';

    $allPatents = selectPatents($conn, 'patent_applicant_id', $sessionId);
    $allPatents = count($allPatents);

    $onTheBlockchain = selectSpecificPatents($conn, 'patent_applicant_id', $sessionId, 'patent_approval_status', 'approved');
    $onTheBlockchain = count($onTheBlockchain);

    $scientific = selectSpecificPatents($conn, 'patent_applicant_id', $sessionId, 'patent_claims', 'Science');
    $scientific = count($scientific);

    $pendingPatents = count(selectPatents($conn, 'patent_approval_status', 'pending'));
?>



<div class="page-title"><p>UWDPS / Home </p></div>
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
                <a href="patent-application.php">Apply now</a>
            </li>
            <li>
                <a href="index.php">Back to Home</a>
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
        <div class="home-banner">
            <div class="account-details">
                <div class="profile-and-id">
                    <img src="images/network.png" alt="">
                    <p class="user-id"><?php echo $firstName; ?></p>
                </div>
                <div class="profile-details">
                    <div class="detail-item">
                        <div class="detail-stat"><h1><?php echo $patentsToDate; ?></h1></div>
                        <div class="detail-stat-desc"><p>patents to date</p></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-stat"><h1><?php echo $pendingPatents; ?></h1></div>
                        <div class="detail-stat-desc"><p>pending approval</p></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-stat"><h1>0</h1></div>
                        <div class="detail-stat-desc"><p>Patners</p></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-stat"><h1><?php echo $onTheBlockchain; ?></h1></div>
                        <div class="detail-stat-desc"><p>On the Blockchain</p></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-stat"><h1><?php echo $scientific; ?></h1></div>
                        <div class="detail-stat-desc"><p>Scientific</p></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-stat"><h1>1</h1></div>
                        <div class="detail-stat-desc"><p>Patner Institutions</p></div>
                    </div>
                </div>
                <div class="edit-profile profile-and-id" id="edit-profile">
                    <h1> > </h1>
                    <p class="edit user-id">Edit profile</p>
                </div>
            </div>
        </div>
        
        <div class="banner2">
            <hr>
            <div class="home-section-header">
                <p>What do you want tot do today?</p>
            </div>

            <div class="objective-buttons">
                <div class="obj-button-group">
                    <button class="obj-button">
                    <a href="patent-application.php"><p><span><i class="fa-solid fa-square-plus"></i></span> Apply for a patent</p>
                    </button></a>
                
                    <button class="obj-button">
                        <a href="patents.php"><p><span><i class="fa-solid fa-envelope"></i></span>View my Patents</p></a>
                    </button>
                </div>

                <div class="obj-button-group">
                    <button class="obj-button">
                    <a href="track-progress.php"><p><span><i class="fa-solid fa-forward-fast"></i></span>Track application progress</p></a>
                    </button>
                
                    <button class="obj-button">
                    <a href="all-patents.php"><p><span><i class="fa-solid fa-dice-d6"></i></span>Explore UWDPS blockchain</p></a>
                    </button>
                </div>
            </div>
        </div>

        <div class="banner2">
            <hr>
            <div class="home-section-header">
                <p>Patent News</p>
            </div>

            <div class="activity-cards">
    <div class="activity-card">
        <p class="activity-icon"><i class="fa-solid fa-star"></i></p>
        <p class="activity-title">Breakthrough Patent Achieved</p>
        <p class="activity-details">A revolutionary patent has been granted after years of research, marking a significant milestone in technological advancement.</p>
        <p class="time-stamp">2024/4/19 &middot; 19:14</p>
        <a href="https://www.msn.com">more ...</a>
    </div>

    <div class="activity-card">
        <p class="activity-icon"><i class="fa-solid fa-trophy"></i></p>
        <p class="activity-title">Patent Excellence Award</p>
        <p class="activity-details">An esteemed award has been conferred upon an innovator for outstanding contributions to the field of patents.</p>
        <p class="time-stamp">2024/05/12 &middot; 14:30</p>
        <a href="https://www.msn.com">more ...</a>
    </div>

    <div class="activity-card">
        <p class="activity-icon"><i class="fa-solid fa-graduation-cap"></i></p>
        <p class="activity-title">Landmark Patent Milestone</p>
        <p class="activity-details">A significant milestone has been reached in patent history, paving the way for future innovations.</p>
        <p class="time-stamp">2024/06/05 &middot; 09:45</p>
        <a href="https://www.msn.com">more ...</a>
    </div>

    <div class="activity-card">
        <p class="activity-icon"><i class="fa-solid fa-lightbulb"></i></p>
        <p class="activity-title">Innovation Spotlight</p>
        <p class="activity-details">An inventive patent has garnered attention for its creative solutions, illuminating the path of innovation.</p>
        <p class="time-stamp">2024/07/22 &middot; 16:55</p>
        <a href="https://www.msn.com">more ...</a>
    </div>

    <div class="activity-card">
        <p class="activity-icon"><i class="fa-solid fa-check-circle"></i></p>
        <p class="activity-title">Quality Assurance Certification</p>
        <p class="activity-details">Patents have been rigorously reviewed and certified for their exceptional quality and precision.</p>
        <p class="time-stamp">2024/08/10 &middot; 11:20</p>
        <a href="https://www.msn.com">more ...</a>
    </div>
</div>

        </div>
    </main>

    <div class="animated-alert">Success! Your query has been successfully executed!</div>

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