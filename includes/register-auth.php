<?php
session_start();

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

    $fullName = $firstName . $lastName;

    // defaults
    $dateRegistered = date('Y-m-d H:i:s');
    $country = "Kenya";
    $fieldOfSpecialization = "General";
    $profilePhoto = "images/network.png";

    // Validation
    if(!$termsAndConditions){
        header("Location: ../fail.php?error=notagreedtermsandconditions&name=".$fullName);

        exit();
    } elseif(empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPass)){

        header("Location: ../fail.php?error=emptyfields&name=".$firstName);

        exit();
    } elseif(preg_match("/[^a-zA-Z0-9]/", $fullName)){
        header("Location: ../fail.php?error=invalidusernames&name=".$fullName);
        exit();
    } elseif(strlen($password) < 6){
        header("Location: ../fail.php?error=passwordtooshort&name=".$fullName);
        exit();
    } elseif($password !== $confirmPass){
        header("Location: ../fail.php?error=passwordsdonotmatch&name=".$fullName);
        exit();
    } else {
        $sql = "SELECT email from users WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../fail.php?error=sqlerror&name=".$fullName);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);

            if($rowCount > 0){
                header("Location: ../fail.php?error=emailalreadyexists&name=".$fullName);
                exit();
            } else {
                $sql = "INSERT INTO users(first_name, last_name, date_registered, email, password, country, field_of_specialization, profile_photo) VALUES (?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
            }
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../sign-up.php?error=sqlerror&name=".$fullName);
                exit();
            } else {
                $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ssssssss" , $firstName, $lastName, $dateRegistered, $email, $hashedPass, $country, $fieldOfSpecialization, $profilePhoto);
                mysqli_stmt_execute($stmt);
                header("Location: ../homepage.php?success=registered");
                exit();
            }
        }
    }
}

