<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UWDPS - Agent Patent Review</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="homepage-menus.css">
    <link rel="stylesheet" href="agent-dashboard.css">
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
                <button class="login-btn notifications-button"><i class="fa-solid fa-bell"></i>
                    <p>3</p></button>
                <button class="login-btn" type="button"><a href="agent-logout.php"><span>Log Out</span><img src="images/logout1.png" alt=""></a></button>
            </div>
        </div>
    </header>



    <div class="page-title"><p>UWDPS / Agent Patent Review</p></div>
    <div class="left-side-bar menu-toggle menu-toggler" id="left-side-bar">
        <div class="profile-preview">
            <img src="images/wipo.png" alt="user-1">
            <div class="profile-preview-details">
                <p class="profile-user-name">John Doe</p>
                <a href="">view profile</a>
            </div>
        </div>
        <div class="menu agent-dashboard-menu">
            <ul>
                <li>
                    <a href="agent-dashboard.php">Agent Dashboard</a>
                </li>
                <li>
                    <a href="agent-view-patents.php">View Patents</a>
                </li>

                <li>
                    <a href="agent-announcement.php">Announce</a>
                </li>
                <li>
                    <a href="#">Applications</a>
                </li>
            </ul>

            <div class="actions">
                <i class="fa-solid fa-gear"></i>
                <i class="fa-brands fa-accessible-icon"></i>
                <i class="fa-solid fa-download"></i>
            </div>
        </div>
    </div>

    

    <!-- Modal HTML -->
    
        <div style="z-index: 0; margin-top: 5px" class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="agent-modal-header">
                <div>
                    <p>UWDPS/ Agent Dashbord / CriticalAction</p>
                    <p>World Intellectual Property Organization</p>
                </div>
                <p class="review-patent">Review Patent</p>
                <div></div>
            </div>

            <div class="agent-modal-body">
                <?php
                // Fetch patent information and display it accordingly
                include "includes/database.php"; // Include the database connection file

                // Assuming you have retrieved the patent ID from the form submission
                if(isset($_POST['patent_id'])) {
                    $patent_id = $_POST['patent_id'];
                    
                    // Fetch patent information from the database
                    $sql = "SELECT * FROM patents WHERE patent_id = '$patent_id'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                ?>
                        <div id="modalContent" class="patent-application-details">
                        <h3>Basic Details</h3>
                        <div class="basic-details">
                            <p>Patent Application Date <span><?php echo $row["patent_filing_date"]; ?></span></p>
                            <p>Patent Field<span><?php echo $row["patent_claims"]; ?></span></p>
                            <p>Country of Application <span><?php echo $row["patent_country"]; ?></span></p>
                            <p>Applicant Full Name <span><?php echo $row["patent_applicant_full_name"]; ?></span></p>
                        </div>
                        <div class="patent-title">
                            <p>Patent title</p>
                            <h2><?php echo $row["patent_title"]; ?></h2>
                        </div>
                        <div class="desc">
                            <p class="desc-head">Patent Description</p>
                            <p class="desc-details"><?php echo $row["patent_description"]; ?></p>
                            </div>
                        <!-- Other information display goes here -->
                        <div class="other-info">
                            <h3>Other Information</h3>
                            <div class="other-applicants">
                                <h4>Other Applicants</h4>
                                <p class="other-applicant-name"><?php echo $row["patent_applicant2_email"]; ?>, <span><?php echo $row["patent_country"]; ?></span></p>
                                <p class="other-applicant-name"><?php echo $row["patent_applicant3_email"]; ?>, <span><?php echo $row["patent_country"]; ?></span></p>
                                <p class="other-applicant-name"><?php echo $row["patent_applicant4_email"]; ?>, <span><?php echo $row["patent_country"]; ?></span></p>
                            </div>
                            <div class="patent-abstract">
                                <h3>Abstract</h3>
                                <p><?php echo $row["patent_abstract"]; ?></p>
                            </div>
                            <div class="patent-drawings">
                                <h4>Diagrams and drawings</h4>
                                <img src="<?php 
                                if($row["patent_drawings"] != NULL){
                                    echo $row["patent_drawings"];
                                }
                                else{
                                    echo "images/writting.jpg";
                                }

                                  
                                
                                ?>" alt="Drawings">
                            </div>
                            <div class="patent-video">
                                <h3>Watch the video</h3>
                                <iframe id="iframe-video" width="1257" height="707" src="<?php echo $row["patent_video_link"]; ?>" title="Patent Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>

                <?php
                    } else {
                        echo "<p>No patent found with the given ID.</p>";
                    }
                } else {
                    echo "<p>Patent ID not provided.</p>";
                }

                $conn->close();
                ?>
            </div>
            
            <!-- Form to submit review details -->
            <form method="post" action="patent-update.php">
                <div class="agent-review">
                    <div id="agentChecklist" class="agent-checklist">
                        <h3>Approval Checklist</h3>
                        <p>Does the patent satisfy the WIPO standards <span><input type="checkbox"></span></p>
                        <p>Does the patent operate without infringing other patents <span><input type="checkbox"></span></p>
                        <p>Does the patent applicant hold correct certifications <span><input type="checkbox"></span></p>
                        <p>Does the patent solve a global problem <span><input type="checkbox"></span></p>
                        <p>Does the patent veer out completely of public domain <span><input type="checkbox"></span></p>
                    </div>
                    <div class="agent-notes" id="agentNotes">
                        <h3>Notes</h3>
                        <textarea id="rejectionReason" name="rejectionReason" placeholder="Reason for rejection"></textarea>
                        <textarea id="reviewNotes" name="reviewNotes" placeholder="Review notes"></textarea>
                    </div>
                </div>
            
                <div class="approval-buttons">
                    <button type="submit" name="rejectButton">Reject</button>
                    <button type="submit" name="approveButton">Approve</button>
                </div>
                <input type="hidden" name="patent_id" value="<?php echo $patent_id; ?>"> <!-- Hidden input to submit the patent ID -->
            </form>
        </div>
    

    

    

    <div class="animated-alert">Success! Your query has been successfully executed!</div>

    <footer>
        <?php
            include "includes/footer.php";
        ?>
    </footer>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("openModalBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        function openModal() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        function closeModal() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
