<?php
// Connect to MySQL database
$conn = mysqli_connect("localhost", "root", "", "login");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch data from the database
$query = "SELECT * FROM users";

// Execute query
$result = mysqli_query($conn, $query);

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-image: url('https://media.istockphoto.com/id/1161898151/photo/close-up-of-calendar-and-alarm-clock-on-the-green-background-planning-for-business-meeting-or.jpg?s=1024x1024&w=is&k=20&c=8czACQwkxiEZmbXxpSi0Me_Kjj7nrAaFB_by2SWyjuE=');
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        button:hover {
            background-color: #45a049;
        }

        </style>

</head>
<body>
    <h1>WELCOME DOCTOR WISHES YOU ALL THE BEST</h1>
    <table border="2">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>MOBILE</th>
            <th>PASSWORD</th>
            <th>Father name</th>
            <th>Adhar card number</th>
            <th>Photo</th>
            <td>
            <a href=PFORM1.php>
            <button>Prescribe</button></a></td>
            
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
            echo "<td>" . $row['mobile'] . "</td>";
            echo "<td>" . $row['mobile'] . "</td>";
            echo "<td>" . $row['mobile'] . "</td>";
            // Add other columns here
            
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
