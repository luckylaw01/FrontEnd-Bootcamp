<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Sign Up - UWDPS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="signup-login.css">
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="homepage-menus.css">
    <script src="homepage-script.js" defer></script>
</head>
<body>
    <header>
        <div class="container">
            <div class="menu-and-search">
                <img id="menu-bar" src="images/hamburger-menu-icon-png-white-8.jpg" alt="" class="hamburger-menu">
                <div class="search-bar">
                    <input type="text" placeholder="Search patents">
                    <button class="search-button"><img src="images/search.png" alt=""></button>
                </div>
            </div>
            
            <img src="images/logo.png" alt="" class="logo">
            <div class="welcome-message"><p>Welcome / Agent Sign up</p></div>
        </div>
    </header>

    <div class="left-side-bar menu-toggle menu-toggler" id="left-side-bar">
        <div class="profile-preview">
            <div class="profile-preview-details">
                <p class="profile-user-name">
                    You are not Logged In
                </p>
            </div>
        </div>

        <div class="menu">
            <ul>
                <li>
                    <a href="">Log in</a>
                </li>
                <li>
                    <a href="">Contact us</a>
                </li>
            </ul>

            <div class="actions">
                <i class="fa-solid fa-gear"></i>
                <i class="fa-brands fa-accessible-icon"></i>
                <i class="fa-solid fa-download"></i>
            </div>
        </div>
    </div>

    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container form-container" >
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Agent Sign up</h2>
                        <form action="includes/agent-register-auth.php" method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="firstname"><i class="fas fa-user"></i></label>
                                <input type="text" name="firstname" id="firstname" placeholder="First Name"/>
                            </div>
                            <div class="form-group">
                                <label for="lastname"><i class="fas fa-user"></i></label>
                                <input type="text" name="lastname" id="lastname" placeholder="Last Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="fas fa-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="fas fa-lock"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="signup-image center-div">
                    <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                    <a href="agent-login.php" class="signup-image-link">I am already an agent</a>
                </div>
            </div>
        </section>
    </div>

</body>
</html>
