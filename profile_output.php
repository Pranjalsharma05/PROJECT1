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

if (isset($_POST['reset'])) {
    // Prepare and execute the SQL query to delete the profile data
    $sql = "DELETE profile FROM profile
    INNER JOIN users ON profile.username = users.username
    WHERE profile.username = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $loggedInUsername);
    mysqli_stmt_execute($stmt);
    
    // Check if the query was successful
    if (mysqli_affected_rows($conn) > 0) {
        // Profile reset successful, redirect to the same page to regenerate content
        header("Location: profile.php");
        exit();
    } else {
        echo "Failed to reset profile.";
    }
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


mysqli_close($conn);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-image: url(https://img.freepik.com/free-photo/copy-space-bowl-with-fruits-breakfast_23-2148571051.jpg?t=st=1711343043~exp=1711346643~hmac=10433a0f4139644d26efe6ffb21880d94706c60cb0926d3d3b8604da478c448c&w=740);
        background-repeat: no-repeat;
        background-size: cover;
            background-color: whitesmoke;
            color: black;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
           
        }

    

        h1 {
            margin: auto;
            flex-wrap: wrap;
            font-family:monospace;
            color:black;
            font-size:2vw;
        }

        img {
            height: 180px;
            width: 160px;
            border-radius: 10px;
            box-shadow: 2px 3px 3px 2px;
            margin-top: 2%;
        }

        .container {
            display: flex;
            margin-top: 4%;
            justify-content:space-around;
            width:60%;
           margin:auto;
           margin-top:5%;
           border:2px solid black;
           border-left: 5px solid black;
           border-bottom: 5px solid black;
           padding:3%;
           border-radius:4px;
           
        }

        .one {
            /* width: 40%; */
            /* background-color: aqua; */
            border: 4px;
            padding: 2%;
            color:red;
            font-weight:900;
        }

        .two {
            /* width: 30%; */
            margin-top: -2%;
            /* background-color: rgb(110, 190, 25); */
            padding: 2%;
        }

        /* Responsive layout adjustments */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                text-align: center;
            }

            .one,
            .two {
                width: 100%;
                margin-top: 2%;
            }
        }
        .box h1{
            color:#667272;
            font-size:3vw;
        }
        .box {
            background-color: #83F1F3;
            display: flex;
            color:white;
            margin-top:2%;
            padding: 1%;
            border-radius: 8px;
           margin-left:20%;
           margin-right:20%;
        }
        
    </style>
</head>

<body>
    <div class="box">
        <h1>PROFILE DETAILS</h1>
    </div>
    <div class="container">
    <div class="two">
            <img src="data:image/jpeg;base64,<?php echo $base64_image; ?>" alt="Profile Image">
        </div>
        <div class="one">
   
          PATIENT NAME :<h1> <?php echo $name; ?></h1>
         AGE:<h1> <?php echo $age; ?></h1>
         GENDER: <h1> <?php echo $gender; ?></h1>
         EMAIL: <h1> <?php echo $username; ?></h1>
         CITY:   <h1> <?php echo $city; ?></h1>
         ADHAR CAR NO.:   <h1> <?php echo $adharcard; ?></h1>
          FATHER NAME:  <h1> <?php echo $fathername; ?></h1>
   
        </div>
      
    </div>
    <style>
  #reset{
    background-color:red;
    color:white;
    align-items: center;
  }
  button:hover{
    cursor:pointer;
  }
    </style>
<form action="" method="Post">
<h4>Want to Reset Your Profile?</h4>
    <button id="reset" name="reset" onclick="alt()">Reset Profile</button>
</form>
<script>
    function alt(){
        alert("PROFILE IS RESETTING!")
    }
    </script>

</body>

</html>
