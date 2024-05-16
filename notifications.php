<?php

include 'includes/header.php';

// Check if the user is logged in
if (!isset($_SESSION['sessionid'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit(); // Stop script execution
}

// Include header
include 'includes/menu.php';

// Include your database connection file
include 'includes/database.php';


// Retrieve session ID
$sessionId = $_SESSION['sessionid'];

// Retrieve notifications for the current session ID
$sql = "SELECT * FROM notifications WHERE destination = 0 OR destination = ? ORDER BY notification_id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $sessionId);
$stmt->execute();
$result = $stmt->get_result();

?>

<div class="page-title"><p>UWDPS / My UWDPS / Notifications </p></div>
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
                <a href="index.php">Back To Home</a>
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
<main id="notificationMain">
    <h1>Your Notifications</h1>
    <div id="notificationContainer" class="notification-list">
        <?php
        // Check if notifications exist
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Output each notification
                ?>
                <div class="notification" id="notification_<?php echo $row['notification_id']; ?>">
                    <h3><?php echo $row['subject']; ?></h3>
                    <p><?php echo $row['message']; ?></p>
                    <small>Sent at <?php echo $row['time_stamp']; ?></small>
                    <button class="dismiss-btn" onclick="dismissNotification(<?php echo $row['notification_id']; ?>)">Dismiss</button>
                </div>
            <?php
            }
        } else {
            // No notifications found
            ?>
            <p>You have no notifications at the moment.</p>
        <?php
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
