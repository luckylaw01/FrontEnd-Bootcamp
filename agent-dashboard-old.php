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

    include "includes/create-notification.php";
    $newNotifications = getNotificationsWithin24Hours($conn, 9999999998);
    $newNotifications = count($newNotifications);

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
                <a href="agent-notifications.php"><button class="login-btn notifications-button"><i class="fa-solid fa-bell"></i>
                    <p><?php echo $newNotifications ?></p></a>
                </button>
                <button class="login-btn" type="button"><a href="agent-logout.php"><span>Log Out</span><img src="images/logout1.png" alt=""></a></button>
            </div>
        </div>
    </header>



    <div class="page-title"><p>UWDPS / Agent Dashboard</p></div>
    <div class="left-side-bar menu-toggle menu-toggler" id="left-side-bar">
        <div class="profile-preview">
            <img src="images/wipo.png" alt="user-1">
            <div class="profile-preview-details">
                <p class="profile-user-name"><?php echo $currentAgent; ?></p>
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

    <div class="recent-applications">
        <div class="">
            <div class="agent-welcome-banner">
                <div class="agent-logo">
                    <img src="images/wipo.png" alt="">
                </div>
                <div class="agent-message-and-details">
                    <p class="welcome-message">Welcome</p>
                    <p class="agent-name"><?php echo $currentAgent; ?></p>
                    <div class="session">
                        <p class="agent-level"> <span>Current session</span></p>
                        <p class="current-manager"><span>Friendrick Von Holstock</span></p>
                    </div>
                </div>
                <div class="agent-statistics">
                    <div class="agent-stat">
                        <div class="agent-stat-stat">
                            <h1><?php echo $agentPatentsApproved ?></h1>
                        </div>
                        <div class="agent-stat-desc">
                            <p>Patents Approved</p>
                        </div>
                    </div>
                    <div class="agent-stat">
                        <div class="agent-stat-stat">
                            <h1><?php echo $agentPatentsPending ?></h1>
                        </div>
                        <div class="agent-stat-desc">
                            <p>Patents Pending</p>
                        </div>
                    </div>
                    <div class="agent-stat">
                        <div class="agent-stat-stat">
                            <h1><?php echo $allUsers ?></h1>
                        </div>
                        <div class="agent-stat-desc">
                            <p>Patent Applicants</p>
                        </div>
                    </div>
                    <div class="agent-stat">
                        <div class="agent-stat-stat">
                            <h1>1844</h1>
                        </div>
                        <div class="agent-stat-desc">
                            <p>Year established</p>
                        </div>
                    </div>
                </div>
                <div class="more-button">
                    <div class="more-btn">
                        <h1>></h1>
                    </div>
                    <div class="more">
                        <p>More</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="recent-applications" class="container ocontainer">
        <div class="recent-applications-title">Recent Applications</div>
        <div class="applications-div">
            <?php
// Assuming $conn is your database connection established earlier

// Fetch patents with status "empty"
$sql = "SELECT * FROM patents WHERE patent_approval_status = 'empty' ORDER BY patent_id DESC";

$result = mysqli_query($conn, $sql);

// Check if the query was executed successfully
if ($result) {
    // Check if there are any rows returned
    $rowCount = mysqli_num_rows($result);

    if($rowCount > 0) {
        // Output the table header
        echo '<table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Country</th>
                        <th>Applicant Name</th>
                        <th>Patent Title</th>
                        <th>Patent field</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';

        // Loop through each row in the result set
        while($row = mysqli_fetch_assoc($result)) {
            // Retrieve data from the row
            $date = $row['patent_filing_date'];
            $applicantId = $row['patent_applicant_id'];
            $patentCountry = $row['patent_country'];
            $applicantName = $row['patent_applicant_full_name'];
            $patentTitle = $row['patent_title'];
            $patentField = $row['patent_claims'];
            $patentId = $row['patent_id'];
            $patentBlockchainID = $row['patent_blockchain_id'];
            $patentApplicant2Email = $row['patent_applicant2_email'];
            $patentApplicant3Email = $row['patent_applicant3_email'];
            $patentApplicant4Email = $row['patent_applicant4_email'];
            $patentApprovalDate = $row['patent_approval_date'];
            $patentApprovalAgentId = $row['patent_approval_agent_id'];
            $patentApprovalStatus = $row['patent_approval_status'];
            $patentDescription = $row['patent_description'];
            $patentDrwawings = $row['patent_drawings'];
            $patentVideoLink = $row['patent_video_link'];
            $patentAbstract = $row['patent_abstract'];
            $patentReferences = $row['patent_references'];


            
        echo "<tr>
        <td>$date</td>
        <td>$patentCountry</td>
        <td>$applicantName</td>
        <td>$patentTitle</td>
        <td>$patentField</td>
        <td><button onclick=\"openModal('$date', '$patentCountry', '$applicantName', '$patentTitle', '$patentField', '$patentId', '$patentBlockchainID', '$patentApplicant2Email', '$patentApplicant3Email', '$patentApplicant4Email', '$patentApprovalDate', '$patentApprovalAgentId', '$patentApprovalStatus', '$patentDescription', '$patentDrwawings', '$patentVideoLink', '$patentAbstract', '$patentReferences')\">View</button></td>
        </tr>";


        }

        // Close the table body and table
        echo '</tbody></table>';
        } 
        else {
                // No rows found, handle accordingly
                echo "No patents found with status 'empty'.";
            }
        } 
        else {
            // Handle the case where the SQL query failed
            echo "Error executing SQL query: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
        ?>

    </div>
</div>

            <!-- Modal HTML -->
    <div id="myModal" class="modal">
        <div class="modal-content">
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
            <p class="request">This is a request to review this patent. Approval will allow the Intellectual Property commission to add it to the International blockchain-based Registry</p>
            <div id="modalContent" class="patent-application-details">
                
            </div>

            <div class="agent-review">
                <div id="agentChecklist"  class="agent-checklist">
                    <h3>Approval Checklist</h3>
                    <p>Does the patent satisfy the WIPO standards <span><input type="checkbox"></span></p>
                    <p>Does the patent operate without infringing other patents <span><input type="checkbox"></span></p>
                    <p>Does the patent applicant hold correct certifications <span><input type="checkbox"></span></p>
                    <p>Does the patent solve a global problem <span><input type="checkbox"></span></p>
                    <p>Does the patent veer out completely of public domain <span><input type="checkbox"></span></p>
                </div>
                <div class="agent-notes" id="agentNotes">
                    <h3>Notes</h3>
                    <textarea id="rejectionReason" placeholder="Reason for rejection"></textarea>
                    <textarea id="reviewNotes" placeholder="Review notes"></textarea>
                </div>
            </div>
        </div>
        
        <div class="approval-buttons">
            <button id="rejectButton" onclick="reject()">Reject</button>
            <button id="approveButton" onclick="approve()">Approve</button>
        </div>
    </div>
</div>


    <div class="recent-applications" class="container ocontainer">
        <div class="recent-applications-title">Cases</div>
    </div>

    <div class="cases-wrapper">
        
    </div>

    <div class="animated-alert">Success! Your query has been successfully executed!</div>
<?php
    include "includes/footer.php";
?>

    </body>
    </html>