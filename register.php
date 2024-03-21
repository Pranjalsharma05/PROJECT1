<?php
require_once "config.php";

$username = $password = $confirm_password = $mobile = "";
$username_err = $password_err = $confirm_password_err = $mobile_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["doc_name"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM doc_reg WHERE doc_name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['doc_name']);

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
        $param_username = trim($username);
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_mobile=$mobile; 
       
       

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            $python = shell_exec("python email1.py $param_username");
            // echo $python;
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
                        background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAMAAzAMBIgACEQEDEQH/xAAcAAEAAgMBAQEAAAAAAAAAAAAABgcBBQgEAwL/xAA+EAABAwMBBQUFBgILAQAAAAAAAQIDBAURBgcSITFBFFFhcYETIpGhsTJCUnLB8DNEFiMkJUNigqLR4fEV/8QAGgEBAAMBAQEAAAAAAAAAAAAAAAIDBAEFBv/EACIRAQACAgIBBAMAAAAAAAAAAAABAgMREjEhBCIyUQVBYf/aAAwDAQACEQMRAD8AuMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMKAAAAAAAAAAAAAAAAAAAAAAAAAAAAAGHKjUVVXCJzA8F9vVDYbdJX3Kb2UDOCYTLnO6NanVVKev+1m8VsjmWmNlBAnBrlTfkVPHoh4domt3anm7HTQsjt9PKro3LxdIqcM+Cc+BCiytWPLm86q3r9Zame5XOvVXle5yJ+hsLbtI1RQvar7h2pic2TsR2foRIE9Qpi9vtfGjdplBfpmUNxjShr38GZXMUq9yL0XzJ59TkxOCoqLhUVFTwL+2V6nk1BY1grH71bRKjJHfjav2Xfp5ldq66asOXfiU1ABBoAAAAAAAAAAAAAAAAAAAAAA0+sal9JpK81MS4lioZnNXx3Fwbgi+0q6QWnR9c6pgfM2qatIjGrjjIiplfBOKiHJ6c5oiNaiImERMIAnBAXw8wAAcCwdiM72avqIE+xLQvc7/S9mPqpXxMdk90jtesqdJKd0q1reyNc1f4e+5Fz4p7qHJ6WYvk6DBhOWfgZKXogAAAAAAAAAAAAAAAAAAAAAaTWViTUem6y2byNkkajoXLySRq5bn1Q3YBrblKspZ6GplpauJ0VRC7dkjdzap8CztuVs9ldKC5xsTcnjWJ7kTm5vLPopWJdXp5uSvG2gAHUGUJ9sh05VV+ooLu+JzaKhVz0evKSTCoiInXGckCYx0jkjjRVe9Ua1E6qp1Bpu2stFhoaBjUT2MLUdj8WOPzI3nUL8FNztsgAVNwAAAAAAAAAAAAAAAAAAAAAAHkuVyobVT9ouVXDTQ/jlejf/AH0DkzENTrzT/wDSXTlRRRInamoklM5eW+nRfPl6nN8kckUj4po3RysVUexyYVq9UUue87XbbT1kUVppX1kPtE9tM73U3eu4nf5no1Tou163pI75YqmKOpnajkmanuTfmROpOJmGfJWL/HtRoJHWaF1TSTLHJZKmTC4R8OJGuTvTC/XC+BudNbLr5cZ0fd41t1Jn3t9WrI5PBEVcevwJ8meMdpl89k+mpLzqFlfOzNDQYe5VThJJ91qfNV8vEvxe/vK/1Hqi07PKSjs1ppWTSphZIGuwrI+rlXq5Tcaf17p6+KyOGtZTVLv5epXcdnwVeCldty14+NPCUAftARXAAAAAAAAAAAAAAAAAAAHludxpLXRyVlfUMggj4q568F7kTxPvNLHBDJNK5GRxtVz3L0RDnPXOrKnVN3fL7R7aCF27SwZwiJ+Je9y/JDsRtVkycYSfVO1muqnPp9OxpSQ8U7TK3ekd+VOSeuSua2qqK6pdUV08lTUO5yzPVzvifIwWxGmO2SbT5CRaP1fctK1CrTKk1JKuZqZ6+67xTuXx69SOg7raMWmOl/23ahpmsgR9RVPopce9HMxefmnMj2rNrMSQvptMxufKqY7XM3DW/lb1X5FQgjwWzntMafSomlqZ5J6iV8s0rt58kjsucvep81RFRUVEVF6KmUUAkq5SkOntaX/TytSirXyU6fy1Qqvj9OOW+ilw6N2g23Ujm0sqJRXBf8F7uEi/5V6+Rz8ZY7cc17VVrmrlrmrhWr3oRmu1lMs1dZAguyzV0mobWtFcZEfcqRqI5685o+jvPopOiqYba25RuAABIAAAAAAAAAAAAAQXbFdFt+kX08aqj66RIcov3ea/JChS3tu7v7NaGLyWV6/IqFS2nTDnn3aAASUAAAAzgwAAAAAASHQF0dadXW2dqqjHyexk8Wv4Y+ODpM5RolVtdSuRcKkzFTz3kOrI/wCGzP4UK79tvp/MafoAEGgAAAAAAAAAAAAAVVt4YvZLRJhVakr28E64/wCioFOpb3Z6G+W99DcoEmgf0XgrV70XopS+q9l93tTn1FpR1xo+K4Yn9azzb19PgTrLJmxzM7hAgFw17mOy1zFw5qphWr3Khnu8Sxm1phOfA+1LS1FdUx01HC+eeVcMjjblXL++p8SxdnNC2G01FwTCVFXUto4pPwN4b2F81CN7RSs2lrodn8jI8XG+UdNOn2oYonzq3wVyYTPxNVftKXCyw9q34qygV272qmVVRi9z2rxb9PEkt+1BqKkuc9LYrRUwUdM90bZFt75HTbq4VyuVvJeOEQ31grJbnbY6i52x9G+WZaKsgkidGyZFTKPRqp+1QITOWkRa+tKdB67vR/8Az7rWUWc9nmcz0ReHyPJgLZAOnA22n9OXbUcyMtNI+ZmcOnXhGzzdy9EyomdEVmenls8K1F3oYUT3n1Maf7kOp0TDUTuTBB9EbOaHTzo62uc2ruKJlHY9yJcfdT9VJyVWnbdhpNY8gAIrgAAAAAAAAAAAABjBkADV3nT1nvif3rb4Kh+MJI5uHp5OTiQ25bIbNNlbfWVdIq/dXD2/PiWMPI7uUJpWe4UrWbHbtHvLS3KjnTojmuYv6m/fS1tjtdrtskqxSwU2H+yf7u9vLxLLX9oQvWrHvucO41zsRYVUbnqWY7e7y8n8vj4+mmafx4rdHdrj7VaetnxHxXelXieCStrveR1XPvNymFkVcYPVa62e3pMjaWWRJU3V4OTCfA8KxSqi4hkXOebV/wCC6Nbl8zebTjrx3y/b5an0BdtT3hlxpp6aKB9NE1XSuVXK5G8VUzQbGWYatxvKv48WwRbv1LOtaKltpUcioqRNTC9OB6jNNp2+2w4q8ImURtOzjTFtVH9hSrenJ1Uu+iL5ciWMY1jEYxrWsRMI1qYRPLB+gcaIrEH17wAcdAAAAAAAAAAAAAAAAAAAAAAwqIvNEMgExE9vzhO5PgMJ3J8D9AblHhX6AAEgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAH/9k=);

            margin: 0;
            padding: 0;
            background-color: rgb(215, 215, 221);
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .container{
            background-image: url(data:image/jpeg;base64,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);
            background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
     width: 60%;
            border-radius: 10px;
            display: flex;
        }
        .left-box{
            height: 60vh;
            width: 50%;
          padding: 5%;
            margin-right: auto;
            display: block;
           
        }
        .right-box{
            height: 60vh;
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
        border-radius: 10px;
           
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
     <?php if (!empty($username_err)) { echo "<p style='color: red;'>$username_err</p>"; } ?>
     <?php if (!empty($password_err)) { echo "<p style='color: red;'>$password_err</p>"; } ?>
     <?php if (!empty($mobile_err)) { echo "<p style='color: red;'>$mobile_err</p>"; } ?>
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

// if (!empty($username_err) || !empty($password_err) || !empty($mobile_err) || !empty($wrong)) {
//     echo "<script>";
//     if (!empty($username_err)) {
//         echo "alert('{$username_err}');";
//     } elseif (!empty($password_err)) {
//         echo "alert('{$password_err}');";
//     } elseif (!empty($mobile_err)) {
//         echo "alert('{$mobile_err}');";
//     }   echo "</script>";
// }

    ?>
    
        <?php
        //  if (!empty($param_username) && !empty($param_password) && !empty($param_mobile))
        //  { echo "<p style='color: red;'>$username_err</p>"; }
         
         ?>
    
   
  



</body>
</html>
