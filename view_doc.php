<?php
// Connect to MySQL database
$conn = mysqli_connect("localhost", "root", "", "login");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch data from the database
$query = "SELECT * FROM doc_reg";

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
            background-image: url('https://img.freepik.com/free-vector/medical-team-design_1232-3215.jpg?t=st=1710982746~exp=1710986346~hmac=269b4f6f6027ee62dfca84d5740f3125a020aad74eba1c9c16e1d54e4db7431f&w=740');
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
        /* CSS for the image */
        td img {
    width: 150px; /* Set a fixed width */
    height: 200px; /* Set a fixed height */
    object-fit: cover; /* Ensure the image covers the specified dimensions */
    border-radius: 5px; /* Add rounded corners */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}



        </style>

</head>
<body>
    <h1>VIEW ALL DOCTORS</h1>
    <table border="2">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>MOBILE</th>
            
            <th>Doctor  Department</th>
            <th>Doctor Gender</th>
            <th>Doctor Qualification</th>
            <th>Adhar card number</th>
            <th>Doctor Registration Date</th>
            <th>Photo</th>
            <td>
           
            
            <!-- Add other column headers here -->
        </tr>
        <?php
        // Loop through the fetched data and display it in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['doc_id'] . "</td>";
            echo "<td>" . $row['doc_name'] . "</td>";
            echo "<td>" . $row['doc_mobile'] . "</td>";
           
            echo "<td>" . $row['doc_department'] . "</td>";
            echo "<td>" . $row['doc_gender'] . "</td>";
            echo "<td>" . $row['doc_qualification'] . "</td>";
            echo "<td>" . $row['doc_aadhar'] . "</td>";
            echo "<td>" . $row['doc_reg_date'] . "</td>";
            echo '<td><img src="data:image/jpeg;base64,' . $row['doc_image'] . '" /></td>';

            // Add other columns here
            
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
