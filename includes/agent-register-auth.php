<?php
if(isset($_POST['submit'])){
    require 'database.php';

    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $confirmPass = $_POST['re_pass'];

    if(isset($_POST['agree-term'])){
        $termsAndConditions = true;
    }

    $fullName = $firstName . ' ' . $lastName;

    // Defaults
    $dateRegistered = date('Y-m-d H:i:s');
    $profilePhoto = "images/network.png";

    if(!$termsAndConditions){
        header("Location: ../fail.php?error=notagreedtermsandconditions&name=".$fullName);
        exit();
    }
    elseif(empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPass)){
        header("Location: ../fail.php?error=emptyfields&name=".$firstName);
        exit();
    }
    // elseif(!preg_match("/^[a-zA-Z0-9]*$/", $fullName)){
    //     header("Location: ../fail.php?error=invalidusernames&name=".$fullName);
    //     exit();
    // }
    elseif($password !== $confirmPass){
        header("Location: ../fail.php?error=passwordsdonotmatch&name=".$fullName);
        exit();
    }
    else {
        $sql = "SELECT email FROM approval_agent WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../fail.php?error=sqlerror&name=".$fullName);
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);

            if($rowCount > 0) {
                header("Location: ../fail.php?error=emailalreadyexists&name=".$fullName);
                exit();
            }
            else {
                $sql = "INSERT INTO approval_agent (name, email, password, profile_image_url, date_registered) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../fail.php?error=sqlerror&name=".$fullName);
                    exit();
                }
                else {
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssss", $fullName, $email, $hashedPass, $profilePhoto, $dateRegistered);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../success-page.php?success=registered");
                    exit();
                }
            }
        }
    }
}
else {
    header("Location: ../index.php?error=accessforbidden");
    exit();
}

