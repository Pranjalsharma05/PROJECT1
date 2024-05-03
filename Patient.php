<?php


require_once "config.php";

// Initialize error message
$em= $username = "";

// Start the session
session_start();






// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the username of the currently logged-in user from the session
$loggedInUsername = $_SESSION['username'] ?? '';

// Check if the username is available
if (empty($loggedInUsername)) {
    die("Username not available");
}


$loggedInUsername = $_SESSION['username'] ?? '';

// Check if the username is available
if (empty($loggedInUsername)) {
    die("Username not available");
}

// Check if the username exists in both tables
// $query = "SELECT * FROM users WHERE username = ?";
// $stmt_ = mysqli_prepare($conn, $query);
// mysqli_stmt_bind_param($stmt_, "s", $loggedInUsername);
// mysqli_stmt_execute($stmt_);
// mysqli_stmt_store_result($stmt_);

    // Username exists in the users table
    // Now check if it exists in the patient_appointment table
    // $query = "SELECT * FROM patient_offline_appointment WHERE username = ?";
    // $stmtt_ = mysqli_prepare($conn, $query);
    // mysqli_stmt_bind_param($stmtt_, "s", $loggedInUsername);
    // mysqli_stmt_execute($stmtt_);
    // mysqli_stmt_store_result($stmtt_);

    // if (mysqli_stmt_num_rows($stmtt_)==1) {
    //     // Username exists in both tables, redirect to samya_output.php
    //     header("Location: samya_output.php");
    //     exit;
    // }



// Prepare SQL query to check if the username exists in the database
$query = "SELECT * from patient_offline_appointment WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);

// Bind parameters and execute the statement
mysqli_stmt_bind_param($stmt, "s", $loggedInUsername);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
mysqli_stmt_num_rows($stmt);

// Check if the username exists
if (mysqli_stmt_num_rows($stmt) > 0) {
    // Username exists in the database, redirect to samya_output.php
    header("Location: samya_output.php");
    exit;
}














// Retrieve data from the database using a prepared statement
$sql = "SELECT * FROM profile
        INNER JOIN users ON profile.username = users.username
        WHERE profile.username = ?";
$stmt = mysqli_prepare($conn, $sql);

// Bind the parameter
mysqli_stmt_bind_param($stmt, "s", $loggedInUsername);

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result set
$result = mysqli_stmt_get_result($stmt);

// Check if the query was successful
if ($result) {
    // Use a conditional check to see if there are any rows returned
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Process each row
            $base64_image = $row['profileimage'];
            $name = $row['name'];
            $username = $row['username'];
            $age = $row['age'];
            $gender = $row['gender'];
            $fathername = $row['fathername'];
            $adharcard = $row['adharcard'];
            $city = $row['city']; // Assuming 'name' is the column for the user's name
           
        }
    } else {
        // No matching profile found
        echo "No profile found for the logged-in user.";
    }
} else {
    $em = "Error retrieving data from the database: " . mysqli_error($conn);
}
// if(isset($_POST['bookAppointment'])) {
// 	// $output = exec("python3 samyaa.py");

//     // // Output the HTML content
//     // echo $output;
// header("Location:samya.php");
// }


 $sql1 = "SELECT mobile FROM users INNER JOIN profile ON profile.username = users.username WHERE profile.username = ?";

$stmt1 = mysqli_prepare($conn, $sql1);

// Bind the parameter
mysqli_stmt_bind_param($stmt1, "s", $loggedInUsername);

// Execute the statement
mysqli_stmt_execute($stmt1);

// Get the result set
$result1 = mysqli_stmt_get_result($stmt1);

// Check if the query was successful
if ($result1) {
    // Use a conditional check to see if there are any rows returned
    if(mysqli_num_rows($result1) > 0) {
        while ($row1 = mysqli_fetch_assoc($result1)) {
            // Process each row
			$mobile = $row1['mobile'];
			

		}}}

// Close the statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>







<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewpoint" content="width=device-width, initial-scale=1">
	<title></title>

	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/font-awesome.min.css">
	<style>
		/* Global styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image:url(https://img.freepik.com/free-photo/copy-space-bowl-with-fruits-breakfast_23-2148571051.jpg?t=st=1711343043~exp=1711346643~hmac=10433a0f4139644d26efe6ffb21880d94706c60cb0926d3d3b8604da478c448c&w=740);
	background-repeat: no-repeat;
	background-size: cover;

}


/* Headings */
h1{
    text-align: center;
    font-size: 34px;
    line-height: 24px;
    padding: 2px;
}

/* Form container */
.Head {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	background-image: url(https://www.shutterstock.com/shutterstock/photos/615708752/display_1500/stock-vector-medical-report-line-flat-vector-icon-for-mobile-application-button-and-website-design-615708752.jpg);
    background-size: cover;
    background-repeat: no-repeat;
	image-opacity: 0.7;
}

/* Input fields */
.input-name, .input-name1 {
    margin-bottom: 10px;
}

/* Buttons */
/* Buttons */


/* Note paragraph */
p {
    margin-left: 160px;
    color: red;
    font-size: 18px;
}

/* Form container */
.input-name {
    margin-bottom: 10px;
}

/* Label for select */
label {
    display: block;
    margin-bottom: 5px;
}

/* Select dropdown */
select {
    width: 100%;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

/* Patient details */
h2 {
    margin-top: 20px;
    font-size: 20px;
}

/* Buttons */
button[type="submit"],
input[type="reset"],
button[type="button"] {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    margin-right: 10px;
}

button[type="submit"]:hover,
input[type="reset"]:hover,
button[type="button"]:hover {
    background-color: #45a049;
}


		</style>
</head>
<body>
	<h1 style="font-size:34px;line-height: 24px;padding: 2px;text-align: center;">Welcome</h1>

	<div class="Head">
			<div class="input-name1">
				
					<fieldset><div>
						<h2>Registration Process For Patient Details</h2><br>
	
						<div class="input-name">
						<form method="post" action="samya.php">
    <div class="input-name">
        
    </div><br>
    <h2>Patient Name:</h2><br><?php echo $name ?>
    <div>
        <h2>Father Name:</h2><?php echo $fathername ?>
    </div>
    <div><br>
        <h2>Patient Age:</h2><?php echo $age ?>
        <h2>Patient Gender:</h2><?php echo $gender ?>
        <h2>Patient Mobile no.:</h2><?php echo $mobile ?>
        <h2>Patient Email Id:</h2><?php echo $username ?>
        <h2>Patient Aadhar no.:</h2><?php echo $adharcard ?>
    </div>
    <hr>
    <button type="submit"  name="bookAppointment">SELECT APPOINTMENT DATE:</button>
    <hr>			    
    <input type="reset" value="Reset">
    <button type="button" onclick="">Submit</button>
</form>


					<script>
						    function submitOption() {
						        var ageOption = document.getElementById('ageOption');
						        var dobOption = document.getElementById('dobOption');
						        var ageInput = document.getElementById('ageInput');
						        var dobInput = document.getElementById('dobInput');

						        if (ageOption.checked) {
						            // Age option is selected
						            alert('Selected Age: ' + ageInput.value);
						        } else if (dobOption.checked) {
						            // Date of Birth option is selected
						            alert('Selected Date of Birth: ' + dobInput.value);
						        } else {
						            // Neither option is selected
						            alert('Please choose an option.');
						        }
						    }function myFunction() {
								  var x = document.getElementById("myInput");
								  if (x.type === "password") {
								    x.type = "text";
								  } else {
								    x.type = "password";
								  }
								}
						</script>
			</div>
		</div>
		<p style="margin-left: 160px;color: red;font-size:18px">Note: You must fill all boxes And
         This facility is only for Online Pre-Registration and not for Online Appointment for a specific Consultant/Unit</p>
</body>
</html>
