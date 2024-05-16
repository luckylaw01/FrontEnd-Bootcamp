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
    $newNotifications = getNotificationsWithin24Hours($conn, 2147483647);
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
                    <!-- <input type="text" placeholder="Search patents">
                    <button class="search-button"><img src="images/search.png" alt=""></button> -->
                    <h2>Agent Dashboard</h2>
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
                    <a href="admin-users.php">View Users</a>
                </li>
                <li>
                    <a href="admin-patents.php">View Patents</a>
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
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Applicant Id</th>
                    <th>Applicant Name</th>
                    <th>Patent Title</th>
                    <th>Patent field</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Your PHP code to fetch patents from the database and populate the table goes here
                include "includes/database.php"; // Include the database connection file

                // Fetch patents from the database
                $sql = "SELECT * FROM patents WHERE patent_approval_status = 'empty' ORDER BY patent_filing_date DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["patent_filing_date"] . "</td>";
                        echo "<td>" . $row["patent_applicant_id"] . "</td>";
                        echo "<td>" . $row["patent_applicant_full_name"] . "</td>";
                        echo "<td>" . $row["patent_title"] . "</td>";
                        echo "<td>" . $row["patent_claims"] . "</td>";
                        echo "<td>";
                        echo "<form method='post' action='agent-patent-review.php'>";
                        echo "<input type='hidden' name='patent_id' value='" . $row["patent_id"] . "'>";
                        echo "<button type='submit'>Review</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No patents found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="recent-applications" class="container ocontainer">
    <div class="recent-applications-title">Cases</div>
</div>

<div class="cases-wrapper">
    
</div>

<div class="animated-alert">Success! Your query has been successfully executed!</div>

<footer>
    <?php include "includes/footer.php" ?>
</footer>

</body>
</html>
