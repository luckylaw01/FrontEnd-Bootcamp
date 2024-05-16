<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UWDPS - Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="homepage-menus.css">
    <script src="homepage-script.js" defer></script>
    <link rel="stylesheet" href="agent-dashboard.css">
    <link rel="stylesheet" href="admin-dashboard.css">
    <script src="admin-dashboard-script.js"></script>
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
                    <h2>Agent Dasboard</h2>
                </div>
            </div>
            
            <a href="index.php"><img src="images/uwdps logo.png" alt="" class="logo"></a>
            <div class="header-buttons">
                <a href="notifications.php"><button class="login-btn notifications-button"><i class="fa-solid fa-bell"></i>
                    <p>1</p></a>
                </button>
                <button class="login-btn" type="button"><a href="agent-logout.php"><span>Log Out</span><img src="images/logout1.png" alt=""></a></button>
            </div>
        </div>
    </header>



    <div class="left-side-bar menu-toggle menu-toggler" id="left-side-bar">
        <div class="profile-preview">
            <img src="images/user-1.png" alt="user-1">
            <div class="profile-preview-details">
                <p class="profile-user-name">Admin</p>
                <a href="">Edit</a>
            </div>
        </div>
        <div class="menu">
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
