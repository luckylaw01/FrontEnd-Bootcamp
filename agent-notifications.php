<?php
// Include database connection
include "includes/database.php";
include "includes/select.php"; // Assuming this file contains your select functions

session_start();

if (!isset($_SESSION["sessionid"])) {
    header("Location: agent-login.php");
    exit; // Terminate script execution after redirection
}

$agentSessionId = $_SESSION["sessionid"];

// Select approval agent's name
$approvalAgents = selectApprovalAgents($conn, 'name', $agentSessionId);
$currentAgent = $approvalAgents[0]['name'];

// Count the number of patents approved and pending for the agent
$agentPatentsApproved = count(selectSpecificPatents($conn, 'patent_approval_agent_id', 1 , 'patent_approval_status', 'approved'));
$agentPatentsPending = count(selectSpecificPatents($conn, 'patent_approval_agent_id', '1', 'patent_approval_status', 'empty'));
$allUsers = count(selectUsers($conn, 'field_of_specialization', 'General'));


// Select notifications with destination 9999999998 (approval agent)
$agentNotifications = selectNotifications($conn, 'destination', 2147483647);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UWDPS - Agent Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="homepage-menus.css">
    <script src="homepage-script.js" defer></script>
    <link rel="stylesheet" href="agent-dashboard.css">
    <script src="agent-dashboard-script.js" defer></script>
    <link rel="stylesheet" href="animated-alert.css">
    <link rel="stylesheet" href="notifications.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="menu-and-search">
                <div id="menu-bar" class="hamburger-menu"><i class="fa-solid fa-bars"></i></div>
                <div class="search-bar">
                    <input type="text" placeholder="Search patents">
                    <button class="search-button"><img src="images/search.png" alt=""></button>
                </div>
            </div>
            <a href="index.php"><img src="images/uwdps logo.png" alt="" class="logo"></a>
            <div class="header-buttons">
                <a href="agent-notifications.php"><button class="login-btn notifications-button"><i class="fa-solid fa-bell"></i><p>1</p></button></a>
                <button class="login-btn" type="button"><a href="agent-logout.php"><span>Log Out</span><img src="images/logout1.png" alt=""></a></button>
            </div>
        </div>
    </header>

    <div class="page-title"><p>UWDPS / Agent Dashboard/ Notifications</p></div>
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

    <div class="ocontainer">
        <main id="notificationMain">
            <h1>Your Notifications</h1>
            <div id="notificationContainer" class="notification-list">
                <?php
                if ($agentNotifications) {
                    foreach ($agentNotifications as $agentNotification) {
                        echo '
                        <div class="notification" id="notification_' . $agentNotification['notification_id'] . '">
                            <h3>' . $agentNotification['subject'] . '</h3>
                            <p>' . $agentNotification['message'] . '</p>
                            <small>Sent at ' . $agentNotification['time_stamp'] . '</small>
                            <button class="dismiss-btn" onclick="dismissNotification(' . $agentNotification['notification_id'] . ')">Dismiss</button>
                        </div>';
                    }
                } else {
                    // No notifications found
                    echo '<p>You have no notifications at the moment.</p>';
                }
                ?>
            </div>
        </main>
    </div>

    <?php
    // Include footer
    include 'includes/footer.php';

    // Close database connection
    $conn->close();
    ?>
</body>
</html>
