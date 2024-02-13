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
        }
        .left-box{
            height: 80vh;
            width: 50%;
          padding: 10%;
            margin-right: auto;
            display: block;
           
        }
        .right-box{
            height: 80vh;
            width: 50%;
            background-color: blue;
            margin-left: auto;
            border-radius: 10px;
            border-top-left-radius: 70%;
            border-bottom-left-radius: 70%; /* Push to the right */
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
            font-size: 3vw;
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

    </style>
</head>
<body>
    <div class="container">
        <div class="left-box">
     <h1>SIGN UP</h1>
     <form action="" method="POST">
        <p>Username *:</p>
        <input placeholder="Enter email id" type="email" name="username" required>
        <p>Password *:</p>
        <input placeholder="Enter Password" type="password" name="password" required>
        <p>Confirm Password *:</p>
        <input placeholder="Confirm Password" type="password" name="confirm_password" required>
        <p>Mobile No. *: </p>
        <input placeholder="Enter Mobile no." type="tel" name="mobile" required>
        <br><br>
        <button>Register</button>

     </form>
        </div>

        <div class="right-box">
          
<h1>Welcome Users</h1>

<p>kindly register Yourself</p>
<br><br>
<p>Already Registered?? Then </p>
    <a href="login.php">Login here</a>
    
        </div>
      

    </div>
    

<?php
// Your PHP code here...

if (!empty($username_err) || !empty($password_err) || !empty($mobile_err) || !empty($wrong)) {
    echo "<script>";
    if (!empty($username_err)) {
        echo "alert('{$username_err}');";
    } elseif (!empty($password_err)) {
        echo "alert('{$password_err}');";
    } elseif (!empty($mobile_err)) {
        echo "alert('{$mobile_err}');";
    }   echo "</script>";
}

    ?>
    
        <?php if (!empty($param_username) && !empty($param_password) && !empty($param_mobile))
         { echo "<p style='color: red;'>$username_err</p>"; } ?>
    
  



</body>
</html>
