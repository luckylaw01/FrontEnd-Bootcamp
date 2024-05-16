<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UWDPS - FAIL</title>
    <style>

        *{
            font-family: Arial, Helvetica, sans-serif;
        }
        /* Centering the container */
        .fail-container {
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
        .fail-container h1 {
        color: #24788f;
        }

        /* Styling the button */
        .fail-container button {
        background-color: #24788f;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
        }

        /* Styling the button hover effect */
        .fail-container button:hover {
        background-color: #313335;
        }


    </style>
</head>
<body>
    <div class="fail-container">
    <h1>ERROR!</h1>
    <p>Oops! Something went wrong with the action. Please <b>check your inputs</b> and try again.
       
    </p>
    <a href="javascript:history.back()"><button>Retry</button></a>
    </div>

</body>
</html>