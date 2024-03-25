<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "config.php";

// Initialize error message
$em = "";

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

// Retrieve data from the form
$name = $_POST['user_name'] ?? '';
$father_name = $_POST['users_father'] ?? '';
$adhar_card = $_POST['adhar_card'] ?? '';
$mobile_number = $_POST['users_mobile'] ?? '';
$email = $_POST['users_email'] ?? '';
$age = $_POST['age'] ?? '';
$gender = $_POST['gender'] ?? '';
$labTests = $_POST['labTests'] ?? '';
$lab_visit_date = $_POST['lab_visit_date'] ?? '';
$slot = $_POST['slot'] ?? '';

// Upload prescription file
if(isset($_FILES['prescription'])) {
    $prescription_file = $_FILES['prescription']['name'];
    $prescription_temp = $_FILES['prescription']['tmp_name'];
    $prescription_path = "uploads/" . $prescription_file;
    move_uploaded_file($prescription_temp, $prescription_path);
} else {
    $prescription_path = ''; // Set default value if prescription file is not uploaded
}

// Prepare and bind parameters for insertion into the database
$stmt = $conn->prepare("INSERT INTO online_labtest_booking (user_name, father_name, adhar_card, users_mobile, users_email, users_age, users_gender, choosen_test, selected_date, selected_time_slot, prescription_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssss", $name, $father_name, $adhar_card, $mobile_number, $email, $age, $gender, $labTests, $lab_visit_date, $slot, $prescription_path);

// Execute the statement
if ($stmt->execute()) {
    echo "Booking successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Booking Form</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-image: url(https://img.freepik.com/free-vector/green-curve-frame-template-vector_53876-144370.jpg?size=626&ext=jpg);
        background-size: cover;
    
    }
    
    h2 {
        color: #333;
    }
    
    form {
        max-width: 80%;
        margin-left: 30px; /* Corrected margin property */
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    label {
        font-weight: bold;
    }
    
    input[type="text"],
    input[type="email"],
    input[type="number"],
    select,
    textarea,
    input[type="date"],
    input[type="file"] {
        width: 200px; /* Adjust the width as needed */
        padding: px;
        margin: 5px 5px 25px 0; /* Adjust the margins as needed */
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        display: inline-block;
    }
    
    input[type="radio"] {
        margin-right: 5px;
        display: inline-block;
    }
    
    input[type="radio"] + label {
        margin-right: 15px;
        display: inline-block;
    }
    
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        display: block;
        width: 100%;
    }
    
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    
    .error {
        color: red;
        font-size: 0.9em;
    }
    h4 {
        color: red;
    }
</style>
<body>
    <h2>Booking Form</h2>
    <form action="/submit" method="post" enctype="multipart/form-data">
        <!-- Your form fields here -->
        <label for="user_name">Name:</label>
    <input type="text" id="user_name" name="user_name" required>

    <label for="users_father">Father's Name:</label>
    <input type="text" id="users_father" name="users_father" required>

    <label for="adhar_card">Adhar Card Number:</label>
    <input type="text" id="adhar_card" name="adhar_card" required>

    <label for="users_mobile">Mobile Number:</label>
    <input type="text" id="users_mobile" name="users_mobile" required>

    <label for="users_email">Email:</label>
    <input type="email" id="users_email" name="users_email" required>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required>
 

<hr>
        <label for="gender">Gender:</label>
        <input type="radio" id="male" name="gender" value="male" required>
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female" required>
        <label for="female">Female</label>
        <input type="radio" id="other" name="gender" value="other" required>
        <label for="other">Other</label>
<hr>
<select id="choosen_test" name="labTests">
    <option value="">Choose a test...</option>
    <option value="IMG">Imaging Tests:</option>
    <option value="BPT">Blood Tests:</option>
    <option value="GMP">Genetic Tests:</option>
    <option value="STL">Stool Tests:</option>
    <option value="CFT">Cardiac Tests:</option>
    <option value="CST">Cancer Screening Tests:</option>
    <option value="EET">Endocrine Tests:</option>
    <option value="MCT">Microbiological Tests:</option>
    
  </select>
  
        <label for="selected_date">Lab Visit Date:</label>
        <input type="date" id="lab_visit_date" name="lab_visit_date" required>

        <label for="slot">Select Slot:</label>
        <select id="selected_time_slot" name="slot" required>
            <option value="morning">Morning</option>
            <option value="afternoon">Afternoon</option>
            <option value="evening">Evening</option>
        </select>
<hr>
        <label for="prescription">Upload Your Prescription:</label>
        <input type="file" id="prescription_image" name="prescription" accept=".pdf, .doc, .docx" required>

        <input type="submit" value="Book Slot">
    </form>
    <h4>NOTE:</h4>
    <p>Morning slots are in between 9AM-12NOON.<br>
             Afternoon slots are in between 12noon-3pm.<br>
             Evening slots are in between 3pm-6pm.<br>
    </p>
    <h4>SPECIAL INSTRUCTIONS:</h4>
    <p>You need to bring your ID proof with you.<br>
        Need to bring Prescribed prescription which you have uploaded <br>
        If you unable to reach at your desired selected time, your slot will automatically delete after 2 hours.
    </p>
</body>
</html>
