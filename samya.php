<?php
require_once "config.php";
session_start();
error_reporting(E_ALL);

if (isset($_SESSION['username'])) {
  // Select the username from the profile table
  $query = "SELECT username FROM  patient_offline_appointment WHERE username = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);
  mysqli_stmt_execute($stmt);

  // Store the result
  mysqli_stmt_store_result($stmt);

  if (mysqli_stmt_num_rows($stmt) == 1) {
      // The username exists in the profile table

      // You don't need a separate query for the users table
      // Just check if the username exists in the users table
      $query = "SELECT slot FROM patient_offline_appointment WHERE slot = ?";
      mysqli_stmt_prepare($stmt, $query);
      mysqli_stmt_bind_param($stmt, "s", $_SESSION['slot']);
      mysqli_stmt_execute($stmt);

      // Store the result
      mysqli_stmt_store_result($stmt);

      if (mysqli_stmt_num_rows($stmt) == 1) {
          // Redirect to profile_output.php if the username exists in both tables
          header("location: samya_output.php");
          exit;
      }
  }
}



// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_department = $p_a_date = $slot = "";
    $errors=array();

    // Check if the array keys are set before accessing them
    if (isset($_POST['patient_department'])) {
      $patient_department = trim($_POST['patient_department']);
  } else {
      $errors[] = "Please enter patient department";
  }

  if (isset($_POST['p_a_date'])) {
      $p_a_date = trim($_POST['p_a_date']);
  } else {
      $errors[] = "Please enter Appointment date";
  }

  if (isset($_POST['slot'])) {
      $slot = trim($_POST['slot']);
  } else {
      $errors[] = "Slot information missing";
  }
    
    // Check if there are any errors before proceeding
    if (empty($errors)) {
        // For demonstration purposes, I assume you have a user session where you store the username
        
        $username = $_SESSION['username'];

        // Retrieve email, gender, name, and age from the profile table based on the username
        $select = "SELECT username, gender, name, age FROM profile WHERE username = ?";
        $stmt = mysqli_prepare($conn, $select);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $email, $gender, $name, $age);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);


        $select1 = "SELECT mobile FROM users WHERE username = ?";
        $stmt1 = mysqli_prepare($conn, $select1);
        mysqli_stmt_bind_param($stmt1, "s", $username);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_bind_result($stmt1, $mobile);
        mysqli_stmt_fetch($stmt1);
        mysqli_stmt_close($stmt1);

        // Insert data into the destination table
        $sql_insert = "INSERT INTO patient_offline_appointment (username, p_a_date, slot, patient_department, gender, name, age,mobile) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt2 = mysqli_prepare($conn, $sql_insert);
        mysqli_stmt_bind_param($stmt2,"ssssssss", $username, $p_a_date, $slot, $patient_department, $gender, $name, $age, $mobile);
        mysqli_stmt_execute($stmt2);

        // Redirect to the desired page after successful submission
        header("location: samya_output.php");
        exit(); // Terminate script execution after redirection
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
    .head{
      margin-left: 10%;
      height: 50%;
      width: 80%;
      padding:20px;
      border-radius: 10px;
        background-color: transparent;
        backdrop-filter:blur(5px);
        border:2px solid rgb(21, 20, 20);
  position: relative;
  align-items: center;
  }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-image: url(https://img.freepik.com/free-vector/appointment-booking-with-calendar_52683-39831.jpg?w=996&t=st=1711367953~exp=1711368553~hmac=38823611d47e628959ab366e2183d12e10c8ca7e60eb6c35a6707755e5a50e40);
    background-blend-mode: normal;
      background-size: cover;
    background-repeat: no-repeat;
    }
    
    h2 {
      text-align: center;
    }
    
    .head {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }
    
    #dateForm {
      text-align: center;
    }
    
    #dateForm h1 {
      margin-bottom: 10px;
    }
    
    #AppointmentDate {
      height: 40px;
      padding: 0 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    
    #btn11 {
      height: 40px;
      padding: 0 20px;
      margin-top: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    
    #btn11:hover {
      background-color: #45a049;
    }
    
    #btn11:disabled {
      background-color: #ccc;
      cursor: not-allowed;
    }
    
  </style>
</head>
<body>
<form action="" method="POST" id="dateForm">

<label for="Department"><h2>Choose a Department:</h2></label>
        <select id="Department" name="patient_department">
            <option value=""></option>
            <option value="Cardiology Department" >Cardiology Department</option>
            <option value="Orthopedics Department" >Orthopedics Department</option>
            <option value="Oncology Department" >Oncology Department</option>
            <option value="Neurology Department" >Neurology Department</option>
            <option value="Gynecology/Obstetrics Department" >Gynecology/Obstetrics Department</option>
        </select>


  <h2>Appointment Booking</h2>
  <hr>
  <div class="head">
    
      <h1>Select Date:</h1>
      <input placeholder="Enter Appointment Date" name="p_a_date" type="date" id="AppointmentDate" min="{{a}}" max="{{b}}" 
    >
      <br><button type="button" onclick="btn()" id="btn11" disabled>BOOK</button>
    
   
  </div>
 




<!-- time



-->







<style>
  .time{
    margin-left: 10%;
    height: 50%;
    width: 80%;
    padding:20px;
    border-radius: 10px;
      background-color: transparent;
      backdrop-filter:blur(25px);
      border:2px solid rgb(16, 15, 15);
position: relative;
align-items: center;
}


  
h1 {
  text-align: center;
  color: #4CAF50;
  margin-left: 10%;
  height: 5%;
  width: 80%;
  padding: 20px;
  border-radius: 10px;
  background-color: transparent;
  backdrop-filter: blur(25px);
  border: 2px solid rgb(22, 21, 21);
  position: relative;
}

  
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
  }
  
  th {
    background-color: #f2f2f2;
  }
  
  button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    margin-right: 10px;
  }
  
  button:hover {
    background-color: #45a049;
    cursor: pointer;
  }
  
  #slot1, #slot2, #slot3 {
    background-color: rgb(73, 198, 73);
    font-weight: bold;
    color: green;
  }
  
  .confirm {
    display: flex;
    justify-content: center;
  }
  
  .confirm button {
    background-color: red;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    margin-right: 10px;
  }
  
  
  
  
  .confirm button:hover {
    cursor: pointer;
  }
  
  
  
  .disable {
    background-color: #ccc;
    cursor: not-allowed;
  }
  
</style>

<!--  -->
<hr>
<h1>Select Appointment Booking Time--(4)booking</h1>
<div class="time">
    <table>
        <tr>
            <th>Time</th>
            <th>Availability</th>
            <th>Booking</th>
        </tr>
        <tr>
            <td>Select Time</td>
            <td id="slot1">Available</td>
            <td>
              <select  id="time" onchange="checkSelection()"class="disable" disabled>
              <option value="" id="blank" ></option>
                <option value="9:00-10:00" >9:00 - 10:00 AM</option>
                <option value="10:00-11:00" >10:00 - 11:00 AM</option>
                <option value="2:00-3:00"  >2:00 - 3:00 PM</option>
              </select>
<<<<<<< HEAD
              <input id="hide" name="slot" type="hidden">
=======
              <input  type="hidden" id="hide" name="slot">
>>>>>>> d351d705382cc233c9e778ba3c7db102666a24aa
            </td>
            <td><button  id="btn22" onclick="timebook(event)" disabled>Book</button></td>
        </tr>
    </table>
</div>
<hr>
  <div class="confirm">
    <button onclick="reset()" >Reseeet</button>
  <button style="background-color: green;" onclick="submit()" id="submit">Submit</button>
  
  </div>
  </form>
<!-- <\Asli logic!!! -->


<?php if (!empty($errors)) { 
    // Convert the array of errors into a string
    $errorString = implode('<br>', $errors);
    echo "<p style='color: red;'>$errorString</p>"; 
}  ?>
<script src="Patientt.js"></script>
</body>
</html>
