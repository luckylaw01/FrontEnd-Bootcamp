<?php
     include 'includes/database.php';
     include 'includes/select.php';
     session_start();
     

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UWDPS - SUCESS</title>
    <style>
                    /* Centering the container */
            .success-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            /* Styling the h1 */
            .success-container h1 {
            color: #24788f;
            }

            /* Styling the button */
            .success-container button {
            background-color: #24788f;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            }

            /* Styling the button hover effect */
            .success-container button:hover {
            background-color: #313335;
            }

    </style>
</head>
<body>
    <div class="success-container">
        <h1>SUCCESS</h1>
        <p><?php
            if(!isset($_SESSION['message'])){
                 echo "Hello, WIPO The action was successful.";
                }
                else{
                    echo $_SESSION['message'];
                }
        
        ?></p>
        <a href="agent-dashboard.php"><button>Back to home</button></a> 
    </div>
</body>
</html>


