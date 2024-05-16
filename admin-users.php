<?php
    include 'includes/admin-header.php';
    include 'includes/database.php'; // Include the database connection file
?>

<div class="recent-applications ocontainer table-wrapper">
    <div class="recent-applications-title">Users</div>
        
    <div class="applications-div">
        <table>
            <thead>
                <tr>
                    <th>Date Registered</th>
                    <th>User Country</th>
                    <th>User Name</th>
                    <th>No of Patents</th>
                    <th>Field of specialization</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Fetch users from the database and display them in the table
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row['date_registered']."</td>";
                            echo "<td>".$row['country']."</td>";
                            echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
                            echo "<td>Number of patents</td>"; // You need to fetch this from another table
                            echo "<td>".$row['field_of_specialization']."</td>";
                            echo "<td>";
                            echo "<form action='view-user.php' method='post'>";
                            echo "<input type='hidden' name='user_id' value='".$row['user_id']."'>";
                            echo "<button type='submit' name='view_user'>View</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No users found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
        
    <div class="bottom-of-table-wrapper"><button class="hideOrshowAll">Show All</button></div>        
</div>

<div class="animated-alert">Success! Your query has been successfully executed!</div>

<footer class="uwdps-footer">
    <!-- Footer content -->
</footer>

</body>
</html>
