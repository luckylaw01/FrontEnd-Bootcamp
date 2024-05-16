<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-top: 0;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .btn-container {
            text-align: center;
        }
        .btn-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-container button:hover {
            background-color: #0056b3;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="images/uwdps logo.png" alt="Logo" style="width: 150px;">
        </div>
        <h2>Contact Us</h2>
        <form action="" method="post">
            <input type="hidden" name="destination" value="99999999999">
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <div class="btn-container">
                <button type="submit"><i class="fas fa-paper-plane"></i> Send</button>
                <button id="backBtn"><i class="fas fa-arrow-left"></i></i> Back</button>
            </div>
        </form>

        <script>
            const backBtn = document.getElementById("backBtn");           

            backBtn.addEventListener("click", function() {
                window.history.back();
});

            
        </script>

        <?php
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Insert into notifications table
            $destination = $_POST['destination'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            // Your database connection logic here
            include "includes/database.php";

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and bind statement
            $stmt = $conn->prepare("INSERT INTO notifications (destination, source, type, subject, message) VALUES (?, 'admin', 'announcement', ?, ?)");
            $stmt->bind_param("iss", $destination, $subject, $message);

            // Execute statement
            if ($stmt->execute()) {
                echo "<p style='color: green; text-align: center;'>Message sent successfully!</p>";
            } else {
                echo "<p style='color: red; text-align: center;'>Error sending message.</p>";
            }

            // Close connection
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
