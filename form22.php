<?php
require_once "config.php";
session_start();
error_reporting(E_ALL);

// Define variables to prevent undefined variable errors
$name_err = $father_name_err = $adhar_card_err = $mobile_number_err = $email_err = $age_err = $gender_err = $labTests_err = $lab_visit_date_err = $slot_err = $prescription_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process image upload
    if (isset($_FILES['prescription'])) {
        $img_name = $_FILES['prescription']['name'];
        $img_size = $_FILES['prescription']['size'];
        $tmp_name = $_FILES['prescription']['tmp_name'];
        $error = $_FILES['prescription']['error'];

        if ($error === UPLOAD_ERR_OK) {
            if ($img_size > 1250000) {
                $em = "Sorry, the file is too large";
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpeg", "jpg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $image_data = file_get_contents($tmp_name);
                    $base64_image = base64_encode($image_data);
                    $base64_image = str_replace(array("\r", "\n"), '', $base64_image);
                } else {
                    $em = "Sorry, only JPG, JPEG, and PNG files are allowed";
                }
            }
        } else {
            $em = "Sorry, there was an error uploading your file";
        }
    } else {
        $em = "Please select a file to upload";
    }

    // Process other form data
    $name = $father_name = $adhar_card = $mobile_number = $email = $age = $gender = $labTests = $lab_visit_date = $slot = "";
    $name_err = $father_name_err = $adhar_card_err = $mobile_number_err = $email_err = $age_err = $gender_err = $labTests_err = $lab_visit_date_err = $slot_err = $prescription_err = "";

    // Validate form inputs
    if (empty(trim($_POST["name"]))) {
        $name_err = "Name cannot be blank";
    } else {
        $name = trim($_POST['name']);
    }

    // Validate other fields similarly...

    if (empty($name_err) && empty($age_err) && empty($father_name_err) && empty($adhar_card_err) && empty($mobile_number_err) && empty($email_err) && empty($gender_err) && empty($labTests_err) && empty($lab_visit_date_err) && empty($slot_err) && empty($prescription_err)) {
        $sql = "INSERT INTO booking_data (name, father_name, age, gender, email, slot, prescription, adhar_card, mobile_number, lab_visit_date, labTests) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssssssss", $name, $father_name, $age, $gender, $email, $slot, $base64_image, $adhar_card, $mobile_number, $lab_visit_date, $labTests);

            // Assign values to parameters
            $name = $_POST['name'];
            $father_name = $_POST['father_name'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $labTests = $_POST['labTests'];
            $lab_visit_date = $_POST['lab_visit_date'];
            $slot = $_POST['slot'];
            $adhar_card = $_POST['adhar_card'];
            $mobile_number = $_POST['mobile_number'];

            if (mysqli_stmt_execute($stmt)) {
               
                echo "<script>alert('YOUR LAB APPOINTMENT IS SUCCESSFULLY REGISTERED...KINDLY CHECK YOUR MAIL FOR FURTHER NOTIFICATIONS');</script>";
                exit();
            } else {
                echo "Something went wrong... cannot redirect!";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Date selection</title>
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
    <form action="" method="post" enctype="multipart/form-data">
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
        <input type="file" id="profileImage" name="prescription" accept="image/*" required>

       <button>Book</button>
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





