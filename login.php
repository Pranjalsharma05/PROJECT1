<?php
//This script will handle login
session_start();

// check if the user is already logged in
// if(isset($_SESSION['username']))
// {
//     header("location: PROJECT1/trial1.html");
//     exit;
// }
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            // echo 'done';
                            header("location: PROJECT1/trial1.html");
                            
                        }
                     
                    }
                } else {
                    $err = "Invalid username or password";
                }
            } else {
                $err = "Something went wrong. Please try again later.";
            }
        }
    }
    ?>
               

               <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>its_login page</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            background-color: rgb(215, 215, 221);
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .container{
            background-color: white;
            height: 80vh;
            width: 60%;
            border-radius: 10px;
            display: flex;
            flex-direction: row-reverse;
        }
        .right-box{
            height: 80vh;
            width: 50%;
          padding: 10%;
          
            display: flex;
            flex-direction: column;
            justify-content: center;
           
        }
        .left-box{
            height: 80vh;
            width: 50%;
            background-color: blue;
           
            border-radius: 10px;
            border-top-right-radius: 70%;
            border-bottom-right-radius: 70%; /* Push to the right */
            color: white;
            display: flex;
           align-items: center;
            justify-content: center;
            flex-direction: column;
            
        }
        a{
            color: red;
        }
       
        h1, p .right-box{
           
             /* Reset default margins */
            padding: 0;
            margin: 0;/* Adjust the multiplier as needed */
        }
        @media (max-width:730px) {
            h1, p{
            font-size: 2vw;
        }
        }
        .left-box h1{
            /* background-color: rgb(215, 208, 208); */
        }
        input{
            background-color: rgb(218, 237, 237);
            border-radius: 4px;
        }
        button{
            background-color: aqua;
            color: white;
           
        }
        button:hover{
            background-color: chartreuse;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="right-box">
     <h1>SIGN IN</h1>
     <form action="" method="POST">
        <p>Username *:</p>
        <input placeholder="Enter email id" type="email" name="username" required>
        <p>Password *:</p>
        <input placeholder="Enter Password" type="text" name="password" required>
      <br><br>
        <button>Submit</button>
        <?php if (!empty($err)) { echo "<p style='color: red;'>$err</p>"; } ?>
     </form>
        </div>

        <div class="left-box">
          
<h1>Welcome Back!!!</h1>

<p> Login Here</p>
<br><br>
<p>Not Registered?? Then </p>
    <a href="register.php">Register here</a>
    
        </div>
      

    </div>
    
</body>
</html>
