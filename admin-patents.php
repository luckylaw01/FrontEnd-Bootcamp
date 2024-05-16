<?php
    include 'includes/admin-header.php';
    include 'includes/database.php'; // Include the database connection file
?>

<div class="recent-applications ocontainer table-wrapper">
    <div class="recent-applications-title">Patents</div>
        
    <div class="applications-div">
        <table>
            <thead>
                <tr>
                    <th>Patent Title</th>
                    <th>Filing Date</th>
                    <th>Applicant Full Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Fetch patents from the database and display them in the table
                    $sql = "SELECT * FROM patents";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row['patent_title']."</td>";
                            echo "<td>".$row['patent_filing_date']."</td>";
                            echo "<td>".$row['patent_applicant_full_name']."</td>";
                            echo "<td>".$row['patent_approval_status']."</td>";
                            echo "<td>";
                            echo "<form action='view-patent.php' method='post'>";
                            echo "<input type='hidden' name='patent_id' value='".$row['patent_id']."'>";
                            echo "<button type='submit' name='view_patent'>View</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No patents found</td></tr>";
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
