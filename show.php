<?php
require_once "config.php";

// Fetch booking data from the database
$sql = "SELECT * FROM booking_data";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Data</title>
</head>
<body>
    <h2>Booking Data</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Father's Name</th>
            <th>Adhar Card Number</th>
            <th>Mobile Number</th>
            <th>Email</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Lab Tests</th>
            <th>Lab Visit Date</th>
            <th>Slot</th>
            <th>Prescription</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["father_name"]."</td>";
                echo "<td>".$row["adhar_card"]."</td>";
                echo "<td>".$row["mobile_number"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["age"]."</td>";
                echo "<td>".$row["gender"]."</td>";
                echo "<td>".$row["labTests"]."</td>";
                echo "<td>".$row["lab_visit_date"]."</td>";
                echo "<td>".$row["slot"]."</td>";
                echo "<td>".html_entity_decode($row["prescription"])."</td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No bookings found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
