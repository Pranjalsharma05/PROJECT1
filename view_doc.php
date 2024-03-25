<!--  -->

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

        </style>

</head>
<body>
    <h1>WELCOME DOCTOR WISHES YOU ALL THE BEST</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>MOBILE</th>
            <th>PASSWORD</th>
            <th>Father name</th>
            <th>Adhar card number</th>
            <th>Photo</th>
            <td>
            <a href=PFORM1.html>
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
