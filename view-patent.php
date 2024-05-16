<?php
    include 'includes/database.php'; // Include the database connection file

    // Check if patent_id is sent via POST method
    if(isset($_POST['patent_id'])) {
        // Sanitize the patent_id to prevent SQL injection
        $patent_id = mysqli_real_escape_string($conn, $_POST['patent_id']);

        // Query to fetch patent details based on patent_id
        $sql = "SELECT * FROM patents WHERE patent_id = '$patent_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Fetch patent details
            $row = $result->fetch_assoc();

            // Extract patent details
            $patent_title = $row['patent_title'];
            $filing_date = $row['patent_filing_date'];
            $applicant_full_name = $row['patent_applicant_full_name'];
            $status = $row['patent_approval_status'];
            $description = $row['patent_description'];
            $drawings = $row['patent_drawings'];
            $video_link = $row['patent_video_link'];
            $abstract = $row['patent_abstract'];
            $claims = $row['patent_claims'];
            $references = $row['patent_references'];
            $country = $row['patent_country'];
            $rejection_reasons = $row['patent_rejection_reasons'];
            $approval_notes = $row['patent_approval_notes'];
            // You can fetch additional details like patent_applicant_id, patent_blockchain_id, etc. if needed
        } else {
            // No patent found with the provided patent_id
            // You can handle this scenario accordingly, e.g., redirect to an error page
            echo "No patent found with the provided patent ID.";
            exit(); // Stop further execution
        }
    } else {
        // If patent_id is not provided, handle the scenario accordingly, e.g., redirect to an error page
        echo "Patent ID not provided.";
        exit(); // Stop further execution
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patent Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .all-wrapper{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
        }
        /* Custom styling for patent details page */
        .patent-card {
            display: flex;
            background-color: #f0f0f0;
            border-radius: 15px;
            overflow: hidden;
            width: 80%;
            margin: auto;
        }

        .patent-card-content {
            flex: 2;
            padding: 20px;
        }

        .patent-card-content h2 {
            margin-top: 0;
            color: #333;
        }

        .patent-card-content p {
            color: #666;
        }

        .patent-card-content .patent-details {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .patent-card-content .patent-details p {
            margin: 5px 0;
        }

        .patent-card-content .patent-details .button-container {
            text-align: center;
        }

        .patent-card-content .patent-details .button-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 5px;
            transition: background-color 0.3s ease;
        }

        .patent-card-content .patent-details .button-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="all-wrapper">
        <div class="patent-card">
            <div class="patent-card-content">
                <h2>Patent Details</h2>
                <div class="patent-details">
                    <p><strong>Patent Title:</strong> <?php echo $patent_title; ?></p>
                    <p><strong>Filing Date:</strong> <?php echo $filing_date; ?></p>
                    <p><strong>Applicant Full Name:</strong> <?php echo $applicant_full_name; ?></p>
                    <p><strong>Status:</strong> <?php echo $status; ?></p>
                    <p><strong>Description:</strong> <?php echo $description; ?></p>
                    <p><strong>Drawings:</strong> <?php echo $drawings; ?></p>
                    <p><strong>Video Link:</strong> <?php echo $video_link; ?></p>
                    <p><strong>Abstract:</strong> <?php echo $abstract; ?></p>
                    <p><strong>Claims:</strong> <?php echo $claims; ?></p>
                    <p><strong>References:</strong> <?php echo $references; ?></p>
                    <p><strong>Country:</strong> <?php echo $country; ?></p>
                    <p><strong>Rejection Reasons:</strong> <?php echo $rejection_reasons; ?></p>
                    <p><strong>Approval Notes:</strong> <?php echo $approval_notes; ?></p>
                    <!-- Add more patent details as needed -->

                    <!-- Add the button container -->
                    <div class="button-container">
                        <button onclick="window.history.back();">Back</button> <!-- Back button to go back to the previous page -->
                        <!-- Add Edit and Delete buttons as needed -->
                        <!-- Example: -->
                        <!-- <button>Edit Patent</button> -->
                        <!-- <button>Delete Patent</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
