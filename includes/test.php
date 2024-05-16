<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests - UWDPS</title>
    <link rel="stylesheet" href="test.css">
</head>
<body>

<form action="test.php" method="post">
    <button type="submit" name="button">
        Alert
    </button>
</form>

    <?php

    $myVariable = 'bigg juicy ass';



     if(isset($_POST['button'])){
        echo '
        <div id="alert" class="alert">
        <h2>You are already logged in</h2>
        </div>
        ';
    } 
    ?>
    
</body>
</html>


