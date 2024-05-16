<?php
    $dbHost = 'localhost';
    $dbUser = "root";
    $dbPass = "";
    $dbName = "uwdps";

    // Attempt to establish a connection
    $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

    // Check if the connection was successful
    if(!$conn){
        // If the connection fails, terminate execution and display an error message
        die("Database Connection failed: " . mysqli_connect_error());
    }

    // Optionally, you can uncomment the following line to indicate successful connection
    // echo("Connection successful!");
