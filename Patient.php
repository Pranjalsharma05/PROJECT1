<?php


require_once "config.php";

// Initialize error message
$em = "";

// Start the session
session_start();


if($_POST['bookAppointment'])
{
	if (isset($_SESSION['username'])) {
		// Select the username from the profile table
		$query = "SELECT username FROM profile WHERE username = ?";
		$stmt = mysqli_prepare($conn, $query);
		mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);
		mysqli_stmt_execute($stmt);
	
		// Store the result
		mysqli_stmt_store_result($stmt);
	
		if (mysqli_stmt_num_rows($stmt) == 1) {
			// The username exists in the profile table
	
			// You don't need a separate query for the users table
			// Just check if the username exists in the users table
			$query = "SELECT username FROM users WHERE username = ?";
			mysqli_stmt_prepare($stmt, $query);
			mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);
			mysqli_stmt_execute($stmt);
	
			// Store the result
			mysqli_stmt_store_result($stmt);
	
			if (mysqli_stmt_num_rows($stmt) == 1) {
				// Redirect to profile_output.php if the username exists in both tables
				header("location: Patientbook.php");
				exit;
			}
		}
	}
   
}

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
if(isset($_POST['bookAppointment'])) {
	// $output = exec("python3 samyaa.py");

    // // Output the HTML content
    // echo $output;
header("Location:samya.html");
}


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
<<<<<<< HEAD
	<link rel="stylesheet" href="style.css">
	<style>
		button:hover{
cursor:pointer;
		}
	</style>
=======
	<link rel="stylesheet" href="Patient.css">
>>>>>>> ea0c56a0506830af6bc3cf2c7606b120eec4660e
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/font-awesome.min.css">
</head>
<body><h1 style="font-size:34px;line-height: 24px;padding: 2px;text-align: center;">Welcome</h1>
	<div class="Head">
			<div class="input-name1">
				
					<fieldset><div>
						<h2>Registration Process For Patient Details</h2><br>
	<div class="input-name">
<form method= "Post" action="samya.html">
		<label for="Department">Choose a Department:</label>
			<select id="Department">
			<option value=""></option>
  			<option value="Cardiology Department">Cardiology Department</option>
  			<option value="Orthopedics Departmen">Orthopedics Departmen</option>
  			<option value="Oncology Department">Oncology Department</option>
  			<option value="Neurology Department">Neurology Department</option>
  			<option value="Gynecology/Obstetrics Department">Gynecology/Obstetrics Department</option>
  			
			</select>
	</div><br>
				<h2>Patient Name:</h2><?php echo $name ?>
				<div>
				<h2>Father Name:</h2><?php echo $fathername ?>
				
			</div>
				<div><br>
			    	<h2>Patient age:</h2><?php echo $age ?>
					<h2>Patient Gender:</h2><?php echo $gender ?>
			        
					<h2>Patient Mobile no.:</h2><?php echo $mobile ?>
					<h2>Patient Email Id:</h2><?php echo $username ?>
			 

					<h2>Patient Aadhar no.:</h2><?php echo $adharcard ?>
			
				
        <button type="submit" name="bookAppointment" value="Book Appointment">Date</button>



			        			    
			     <input type="reset" value="Reset">
			    <button type="button" onclick="">Submit</button></fieldset>

   
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
