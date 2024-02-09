<?php
require_once "config.php";

$username = $password = $confirm_password = $mobile = "";
$username_err = $password_err = $confirm_password_err = $mobile_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 4){
    $password_err = "Password cannot be less than 4 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}
// check mobile
if(empty(trim($_POST['mobile']))){
  $mobile_err="mobile can't empty";
}
elseif(strlen(trim($_POST['mobile']))<10){
  $mobile_err = "mobile no. cannot be less than 10 characters";
}
else{
  $mobile = trim($_POST['mobile']);
}

// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err) &&empty($mobile_err))
{
    $sql = "INSERT INTO users (username, password,mobile) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password,$param_mobile);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_mobile=$mobile;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
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
    <title>REGISTRATION</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            
        }
        .page{
            display: flex;
            
            align-items: center;
            flex-direction: column;
            height: 100vh;
           
            background:linear-gradient(aqua,white,rgb(11, 210, 210));
         
        }
        .box{
            background-color: rgb(235, 11, 18);
            border:1.5px solid black;
            color:white;
            font-weight: 900;
            padding: 20px;
            border-radius: 15px;
            margin: 3%;
             
            font-family: 'Times New Roman', Times, serif;
            
        }
        @media screen and (max-width:380px) {
            .box{
                font-size: x-small;
            }
           input{
            width: 80%;
           }
        }
        .label{
            padding: 20px;
            
            width: 50%;
         
            background-color: rgb(134, 124, 124);
            background: linear-gradient(black,blue,blue,black);
            display: flex;
            justify-content: center;
            margin-top: 5%;
            border: 2px solid blue;
            border-radius: 9px;
            color:white;
            flex-wrap: wrap;
        

        }
        button{
           background-color:rgb(71, 136, 216);
           border-radius: 4px;
        }
        button:hover{
            background-color: rgb(221, 52, 52);
            color: white;
        }
    </style>
</head>
<body>
    <div class="page">
    <div class="box"><h1>REGISTRATION FORM</h1></div>
    <div class="label">
    <form action="" method="POST">
       <h3>Email</h3>
        <input type="email" class="email" id="username" name="username" placeholder=" Enter Email">
        <h3>Password</h3>
        <input type="password" class="password" id="password" name="password" placeholder="Password" >
<h3>Confirm Password</h3>
<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" >
  <h3>Mobile number</h3> 
  <input type="tel" class="form-control" name="mobile" placeholder="Enter mobile no." size="10"  >
<br><br>
<button>Register</button>
</form>
</div>
</div>
</body>
</html>