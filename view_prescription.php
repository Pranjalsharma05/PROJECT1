<?php
require_once "config.php";

// Query to select all PDF data from the database
$query = "SELECT pdf_data FROM patient_offline_appointment";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if query executed successfully
if ($result) {
    // Fetch and display each PDF in an iframe
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf_data = $row['pdf_data'];
        echo "<iframe src='data:application/pdf;base64," . base64_encode($pdf_data) . "' width='800px' height='600px'></iframe>";
    }
} else {
    // Display an error message if query fails
    echo "Error fetching PDF data: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
