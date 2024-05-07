<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if doc_id is set and not empty
    if (isset($_POST['doc_id']) && !empty($_POST['doc_id'])) {
        // Sanitize the doc_id to prevent SQL injection
        $doc_id = $_POST['doc_id'];
        
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "login");
        
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // Prepare a delete statement
        $sql = "DELETE FROM doc_reg WHERE doc_id = ?";
        
        // Prepare the statement
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind the variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $doc_id_param);
            
            // Set parameters
            $doc_id_param = $doc_id;
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to the admin page after successful deletion
                header("location: welcomeadmin.html");
                exit();
            } else {
                echo "Error deleting doctor.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($conn);
    } else {
        echo "Invalid request.";
    }
} else {
    // Redirect to the admin page if accessed directly without POST method
    header("location: admin_page.php");
    exit();
}
?>
