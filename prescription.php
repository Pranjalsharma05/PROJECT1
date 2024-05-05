<?php
require_once "config.php";
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit; // Terminate script execution after redirect
}

$loggedInUsername = $_SESSION['username'] ?? '';

// Prepare the SQL query
$query = "SELECT pdf_data FROM patient_offline_appointment WHERE username=?";
$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    // Handle query preparation error
    die("Error: " . mysqli_error($conn));
}

// Bind the parameter
mysqli_stmt_bind_param($stmt, "s", $loggedInUsername);

// Execute the statement
mysqli_stmt_execute($stmt);

// Bind the result variables
mysqli_stmt_bind_result($stmt, $pdf);

// Fetch the data
if (mysqli_stmt_fetch($stmt)) {
    // Output PDF content in an iframe
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Your Prescription</title>
    </head>
    <body>
    <h1>YOUR PRESCRIPTION</h1>
    <iframe src="data:application/pdf;base64,<?php echo base64_encode($pdf); ?>" width="800px" height="600px"></iframe>
    </body>
    </html>
    <?php
} else {
    // Handle case where no prescription found for the user
    echo "No prescription found.";
}

// Close statement
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($conn);
?>
