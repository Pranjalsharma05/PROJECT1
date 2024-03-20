

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
</head>
<body>
    <h1>Admin Page</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>MOBILE</th>
            <th>PASSWORD</th>
            <!-- Add other column headers here -->
        </tr>
        <?php
        // Loop through the fetched data and display it in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['mobile'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            // Add other columns here
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
