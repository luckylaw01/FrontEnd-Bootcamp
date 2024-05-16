<?php
    if(isset($_POST["submit"])){
        require 'database.php';

        $email = $_POST['email'];
        $password = $_POST['pass'];

        if(empty($email) || empty($password)){
            header('Location: ../fail.php?error=emptyfields&email='.$email);
        }
        else{
            $sql = "SELECT * FROM users WHERE email = ?";

            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../fail.php?error=sqlerror");
            }
            else{
                mysqli_stmt_bind_param($stmt,"s", $email);
                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);

                if($row = mysqli_fetch_assoc($result)){
                    $passCheck = password_verify($password, $row["password"]);

                    if($passCheck == false){
                        header("Location: ../fail.php?error=wrongpass");
                        exit();
                    }
                    else{
                        session_start();
                        $_SESSION["sessionid"] = $row['user_id'];

                        header("Location: ../homepage.php?success=successfullyloggedin");
                    }
                }
                else{
                    header("Location: ../fail.php?error=usernotfound");
                    exit();
                }
            }
        }


    }
    else{
        header("Location: ../index.php?error=accessforbidden");
    }