<?php
// Database connection
require_once "config.php";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare data for insertion
    $name = $_POST["name"];
    $father_name = $_POST["father_name"];
    $adhar_card = $_POST["adhar_card"];
    $mobile_number = $_POST["mobile_number"];
    $email = $_POST["email"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $labTests = $_POST["labTests"];
    $lab_visit_date = $_POST["lab_visit_date"];
    $slot = $_POST["slot"];
    $prescription = $_FILES["prescription"]["name"]; // Assuming you're storing the filename only, not the file itself

    // Insert data into database
    $sql = "INSERT INTO booking_data (name, father_name, adhar_card, mobile_number, email, age, gender, labTests, lab_visit_date, slot, prescription) VALUES ('$name', '$father_name', '$adhar_card', '$mobile_number', '$email', '$age', '$gender', '$labTests', '$lab_visit_date', '$slot', '$prescription')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
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
        margin left: 30px;
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
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="father_name">Father's Name:</label>
        <input type="text" id="father_name" name="father_name" required>

        <label for="adhar_card">Adhar Card Number:</label>
        <input type="text" id="adhar_card" name="adhar_card" required>

        <label for="mobile_number">Mobile Number:</label>
        <input type="text" id="mobile_number" name="mobile_number" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

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
<select id="labTests" name="labTests">
    <option value="">Choose a test...</option>
    <option value="IMG">Blood Related Test:</option>
    <option value="BPT">Comprehensive Testing Alongside Swab Tests:</option>
    <option value="GMP">Urine Tests:</option>
    <option value="STL">All in one Tests:</option>
    
    
  </select>
  
        <label for="lab_visit_date"> Date of Booking :</label>
        <input type="date" id="lab_visit_date" name="lab_visit_date" required>

        <label for="slot">Select Time of Your Awilability:</label>
        <select id="slot" name="slot" required>
            <option value="morning">Morning</option>
            <option value="afternoon">Afternoon</option>
            <option value="evening">Evening</option>
        </select>
<hr>
        <label for="prescription">Upload Your Prescription:</label>
        <input type="file" id="prescription" name="prescription" accept=".pdf, .doc, .docx" required>

        <input type="submit" value="Book Slot">
    </form>
    <h4>NOTE:</h4>
    <p>Morning slots are in between 9AM-12NOON.<br>
             Afternoon slots are in between 12noon-3pm.<br>
             Evening slots are in between 3pm-6pm.<br>
    </p>
    <h4>SPECIAL INSTRUCTIONS:</h4>
    <p>You need to bring your ID prrof with you.<br>
        Need to bring Prescribed prescription which you have uploaded <br>
        If you unable to raech at your desried selected time,your slot will automatically delete after 2 hours.
    </p>
</body>
</html>
