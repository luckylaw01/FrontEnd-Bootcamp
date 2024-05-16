<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Announcement</title>
    <link rel="stylesheet" href="style.css">
    <!-- Include any additional stylesheets or scripts needed for this page -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Custom styling for admin announcement page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .announcement-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .announcement-container h2 {
            margin-top: 0;
            color: #333;
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

        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group .fa {
            color: #999;
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
    </style>
</head>
<body>
    <div class="announcement-container">
        <h2>Create Announcement</h2>
        <form action="#">
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="destination">Destination:</label>
                <select id="destination" name="destination">
                    <option value="all">All</option>
                    <option value="specific-user">Specific User</option>
                    <option value="approval-agent">Approval Agent</option>
                </select>
            </div>
            <div class="form-group" id="user-email-group" style="display: none;">
                <label for="user-email">User Email:</label>
                <input type="text" id="user-email" name="user-email">
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <div class="btn-container">
                <button type="submit">Send</button>
                <button type="button" onclick="window.history.back()">Back</button>
                <button type="button" onclick="window.location.href='admin-dashboard.html'">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        // Function to show/hide user email field based on destination selection
        document.getElementById('destination').addEventListener('change', function() {
            var userEmailGroup = document.getElementById('user-email-group');
            if (this.value === 'specific-user') {
                userEmailGroup.style.display = 'block';
            } else {
                userEmailGroup.style.display = 'none';
            }
        });
    </script>
</body>
</html>