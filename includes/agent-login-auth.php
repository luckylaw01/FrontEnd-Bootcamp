<?php
if(isset($_POST["submit"])){
    require 'database.php';

    $email = $_POST['email'];
    $password = $_POST['pass'];

    if(empty($email) || empty($password)){
        header('Location: ../fail.php?error=emptyfields&email='.$email);
        exit();
    } else {
        $sql = "SELECT * FROM approval_agent WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../fail.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // $password = password_hash($password, PASSWORD_DEFAULT);

            if($row = mysqli_fetch_assoc($result)){

                $passCheck = password_verify($password, $row["password"]);

                if($passCheck == false){
                    header("Location: ../fail.php?error=wrongpass");
                    exit();
                } elseif($passCheck == true) {
                    session_start();
                    $_SESSION["sessionid"] = $row['name'];
                    header("Location: ../agent-dashboard.php?success=successfullyloggedin");
                    include 'includes/mail.php';

                    sendMail('luckylaw95@gmail.com', 'LOGEED IN SUCCESSFULLY', 'Hello, WIPO, You have logged in successfully to WIPO', 'munyakalawrence01@gmail.com');

                    exit();
                }
            } else {
                // header("Location: ../agent-login.php?error=usernotfound");
                header("Location: ../fail.php?error=usernotfound");
                exit();
            }
        }
    }
} else {
    header("Location: ../index.php?error=accessforbidden");
    exit();
}

