<?php 
    // if(!isset($sessionId)){
    //     header("Location: login.php");
    // }
    // else{
    //     $sessionId = $_SESSION['sessionid'];
    // }
    

    include 'includes/header.php';
    include 'includes/select.php';

    $patents = selectPatents($conn, 'patent_applicant_id', $sessionId);
?>
<div class="page-title"><p>UWDPS / Track Application Progress </p></div>
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

    <div class="progress-container">
        
        <h2>Track Patent Application Progress</h2>
        <form action="" method="post">
            <div class="select-container">
                <label for="patent-select">Select Patent:</label>
                <select id="patent-select" name="patent-select">
                    <?php
                        foreach($patents as $patent){
                            echo '
                                <option value="'.$patent['patent_title'].'">'.$patent['patent_title'].'</option>
                            ';
                        }
                        echo '
                            <input type="text" hidden value="'.$patent['patent_id'].'" name="patent-id">
                            <input type="submit" name="view-progress" class="view-curent-patent-button">
                        ';
                        
                    ?>
                    <!-- Add more patents as needed -->
                    
                </select>
            </div>
        </form>

        <?php
            if(!isset($_POST['view-progress'])){
                echo '<h2> Select a Patent to track progress';
            }
            else{

                $currentPatentName = $_POST['patent-select'];
                
                $currentPatent = selectPatents($conn, 'patent_title', $currentPatentName);

                $approvalMessage = "";
                if ($currentPatent[0]['patent_approval_status'] != 'approved') {
                    $approvalMessage = 'Not yet Approved';
                } else if ($currentPatent[0]['patent_approval_status'] == 'approved') {
                    $approvalMessage = 'Approved on ' . $currentPatent[0]['patent_approval_date'];
                }


                echo '

                    <h2 class="current-patent-title">'.$currentPatent[0]['patent_title'].'</h2>

                    <ul class="progress-steps">
                        <li class="progress-step">
                            <span class="step-icon"><i class="fas fa-file-alt"></i></span>
                            <div class="step-details">
                                <p class="step-status complete">Submitted on '.$currentPatent[0]['patent_filing_date'].'</p>
                                <p>Application Submitted for Review</p>
                            </div>
                        </li>
                        <li class="progress-step">
                            <span class="step-icon"><i class="fas fa-check-circle"></i></span>
                            <div class="step-details">
                                <p class="step-status complete">'.$approvalMessage.'</p>
                                <p>'.$currentPatent[0]['patent_approval_status'].'</p>
                            </div>
                        </li>
                        <li class="progress-step">
                            <span class="step-icon"><i class="fas fa-globe"></i></span>
                            <div class="step-details">
                                <p class="step-status">Pending</p>
                                <p>Patent '.$currentPatent[0]['patent_approval_status'].'</p>
                            </div>
                        </li>
                    </ul>
                ';
            }
        ?>
        


    </div>

    <?php 
        include 'includes/footer.php';
    ?>
</body>
</html>