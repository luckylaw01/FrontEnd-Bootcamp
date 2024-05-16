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
    <title>Agent Dashboard</title>
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
                <h2>Agent Dashboard</h2>
            </div>
        </div>
        
        <a href="index.php"><img src="images/uwdps logo.png" alt="" class="logo"></a>
        <div class="header-buttons">
            <a href="agent-notifications.php" class="login-btn notifications-button"><i class="fa-solid fa-bell"></i><p>1</p></a>
            <button class="login-btn" type="button"><a href="log-out.php"><span>Log out</span><img src="images/logout1.png" alt=""></a></button>
        </div>
    </div>
</header>

<div class="page-title"><p>UWDPS / My UWDPS / Explore UWDPS Blockchain </p></div>
<div class="left-side-bar menu-toggle menu-toggler" id="left-side-bar">
    <div class="profile-preview">
        <img src="images/wipo.png" alt="user-1">
        <div class="profile-preview-details">
            <p class="profile-user-name">WIPO</p>
            <a href="profile.php">view profile</a>
        </div>
    </div>
    <div class="menu">
        <ul>
            <li><a href="agent-dashboard.php">Agent Dashboard</a></li>
            <li><a href="agent-view-patents.php">View Patents</a></li>
            <li><a href="agent-announcement.php">Announce</a></li>
            <li><a href="#">Applications</a></li>
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
                    <?php foreach($allPatents as $patent) { ?>
                        <div class="block">
                            <p class="ipc-id"><?= $patent['patent_blockchain_id'] ?></p>
                            <p class="block-patent-title"><?= $patent['patent_title'] ?></p>
                            <p class="block-patent-owner"><?= $patent['patent_applicant_full_name'] ?>, <span><?= $patent['patent_country'] ?></span></p>
                            <p class="chain-date">Authenticated on <span><?= $patent['patent_approval_date'] ?></span></p>
                            <p class="approval-agent">World Intellectual Property Organization</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <button class="prev-btn">&lt;</button>
            <button class="next-btn">&gt;</button>
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
                    <tbody>
                    <?php
                    // Fetch patents from the database and display them in the table
                    $sql = "SELECT * FROM patents WHERE patent_approval_status = 'approved' ORDER BY patent_filing_date DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row['patent_filing_date']."</td>";
                            echo "<td>".$row['patent_blockchain_id']."</td>";
                            echo "<td>".$row['patent_applicant_full_name']."</td>";
                            echo "<td>".$row['patent_title']."</td>";
                            echo "<td>".$row['patent_approval_status']."</td>";
                            echo "<td>";
                            echo "<form action='view-patent.php' method='post'>";
                            echo "<input type='hidden' name='patent_id' value='".$row['patent_id']."'>";
                            echo "<button type='submit' name='view_patent'>View</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No patents found</td></tr>";
                    }
                ?>
                    </tbody>
                </table>
                <!-- Form for viewing specific patent -->
                <form action="view-specific-patent.php" method="post">
                    <!-- Insert form elements here if needed -->
                </form>
            </div>
        </div>
    </div>
</main>

<?php
    include "includes/footer.php";
?>

</body>
</html>
