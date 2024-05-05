<?php
require_once "config.php";
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
}

$query = "SELECT * FROM patient_offline_appointment";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$pdf = $row['pdf_data'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
</head>
<body>
<h1>YOUR PRESCRIPTION</h1>
<iframe src="data:application/pdf;base64,<?php echo base64_encode($pdf); ?>" width="800px" height="600px"></iframe>
</body>
</html>
