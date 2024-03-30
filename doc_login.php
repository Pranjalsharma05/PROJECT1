<?php
session_start();

if(isset($_SESSION['username']))
{
    header("location:docinterface.html");
    exit;
}
require_once "config.php";
$username = $password = "";
$err = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST['doc_email'])) || empty(trim($_POST['doc_password']))) {
        $err = "Please enter email and password";
    } else {
        $username = trim($_POST['doc_email']);
        $password = trim($_POST['doc_password']);

        $sql = "SELECT doc_id, doc_email, doc_password FROM doc_reg WHERE doc_email=?";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $doc_email, $hashed_password);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        session_start();
                        $_SESSION["username"] = $doc_email;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;
                        header("location: docinterface.html");
                    } else {
                        $err = "Invalid username or password";
                    }
                }
            } else {
                $err = "Invalid username or password";
            }
        } else {
            $err = "Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     
    
     <link rel="icon" type="image/x-icon" href="ps.png">
     <style>
         *{
             padding: 0;
             margin: 0%;
             box-sizing: border-box;
             font-family: sans-serif;
         }
         body {
             display: flex;
             align-items: center;
             justify-content: center;
             min-height: 100vh; /* Set minimum height to fill the viewport */
             background-image: url('https://img.freepik.com/free-vector/medical-team-design_1232-3215.jpg?t=st=1710982746~exp=1710986346~hmac=269b4f6f6027ee62dfca84d5740f3125a020aad74eba1c9c16e1d54e4db7431f&w=740');
             background-repeat: no-repeat;
             background-position: center;
             background-size: cover;
              /* Ensure the background image covers the entire area */
         }
         .right{
             margin-left: 10%;
             height: 50%;
             width: 250px;
             padding:20px;
             border-radius: 10px;
               background-color: transparent;
               backdrop-filter:blur(25px);
               border:2px solid white;
         position: relative;
         align-items: center;
         }
         
         
         .right img {
             width: 100%;
             height: 100%;
             opacity: 0.7; /* Adjust the opacity as needed */
         }
         
         .right h2 {
             position: absolute;
             top: 50%;
             left: 50%;
             transform: translate(-50%, -50%);
             text-align: center;
             color: white;
             font-size: 24px;
             font-weight: bold;
             text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Optional: Add shadow to text */
         }
         

         
         main{
             margin-right: 15%;
             margin-left: 10%;
             height: 50%;
             width: 250px;
             padding:20px;
             border-radius: 10px;
               background-color: transparent;
               backdrop-filter:blur(25px);
               border:2px solid white;
         position: relative;
         align-items: center;
         }
         header{
            position: absolute;
            top: 10px;
            left: 75PX;
            padding: 10px;
         background-color: rgb(20, 134, 234);
         border-radius: 10px;
         }
         form{
             margin: 60px;
             display: flex;
             gap:20px;
             
         }
         input[type="text"],
         input[type="password"]
         {
             padding: 10px;
             width: 200px;
             border: 2px solid black;
             border-radius: 10px;
             background-color: transparent;
             background filter:blur(20px);
             color:black
             }
         
         button{
             padding: 10px;
             width: 200px;
             position: center;
             position:inherit;
             border-radius: 100px;
         cursor: pointer;
         }
         .Form base
         {
         position: relative;
         display: flex;
         align-items: center;
         }
         label{
             position: absolute;
             left: 30px;
             font-size:13;
             transition: .2s;
         }
         
         input:valid+label,
         input:focus+label
         {
         
         color: black;
         transform: translate(10px,-15px);
         }
         .checkbox
         {
             margin-top: 10px;
             padding: 10px;
             position:relative
         }
         
         .remember
         {
             padding: auto;
             margin-top: 20%;
             margin-bottom: 10;
         }
         
         
         
     </style>

<body>
        <div class="right">
            <img src="https://cdn.pixabay.com/photo/2015/12/15/23/32/universal-health-care-1095124_640.png" alt="Welcome Image" style="width: 100%; height: 100%;">
            <h2>
                <b>WELCOME DOCTOR</b>  
            </h2>
        </div>
        <main>
       <header>
        
            <h2>
              <b>LOGIN</b>  
            </h2></header>
            <form></form>
        <div class="Form_base">
<input id="username" type="text" required>
<label for="input"><B>USER NAME</B></label>
        </div>
        
            
            
            <br>
<input id="password" type="password" required>
<label for="input"><B>Enter Your  PASSWORD</B></label>
        </div>
    <br>
    <br>
    <div>
        <button>Login</button>
    </div>

        </form>
       </main>
        
    </body>
</html>
