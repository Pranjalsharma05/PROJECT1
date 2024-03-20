<?php
require_once "config.php";

$doc_name = $password = $confirm_password = $mobile = "";
$doc_name_err = $password_err = $confirm_password_err = $mobile_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if doctor name is empty
    if (empty(trim($_POST["doc_name"]))) {
        $doc_name_err = "Doctor Name cannot be blank";
    } else {
        // Validate doctor name
        $doc_name = trim($_POST["doc_name"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST["password"])) < 4) {
        $password_err = "Password must be at least 4 characters";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check if confirm password matches
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Passwords did not match";
        }
    }

    // Check if mobile number is empty
    if (empty(trim($_POST["mobile"]))) {
        $mobile_err = "Mobile number cannot be blank";
    } elseif (strlen(trim($_POST["mobile"])) < 10) {
        $mobile_err = "Mobile number must be at least 10 characters";
    } else {
        $mobile = trim($_POST["mobile"]);
    }

    // If no errors, insert into database
    if (empty($doc_name_err) && empty($password_err) && empty($confirm_password_err) && empty($mobile_err)) {
        $sql = "INSERT INTO users (doc_name, password, mobile) VALUES (?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $param_doc_name, $param_password, $param_mobile);
            $param_doc_name = $doc_name;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_mobile = $mobile;

            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "Something went wrong... cannot redirect!";
            }
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
}
?>


<html lang="en">

<head>
    <title>DOCTOR REGISTRATION PAGE</title>
    <link rel="stylesheet" href="login1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="icon" type="image/x-icon" href="ps.png">
 <style>
input[type="text"],
input[type="password"],
input[type="email"],
select {
    padding: 10px;
    width: 200px;
    border: 2px solid #3498db;
    border-radius: 10px;
    background-color: transparent;
    transition: all 0.3s ease;
}

input[type="text"]:focus,
input[type="password"]:focus,
input[type="email"]:focus,
select:focus {
    transform: scale(1.05);
    border-color: #e74c3c;
}

/* Button Styles */
button {
    display: block; /* Ensure the button takes up the full width */
    margin: 0 auto; /* Center the button horizontally */
    background-color: #2ecc71;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    transition: all 0.3s ease;
    cursor: pointer;
}


button:hover {
    background-color: #1abc9c;
}

/* Text Color Styles */
body {
    color: #2c3e50;
}

/* Background and Container Styles */
body {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background: linear-gradient(45deg, #6bff90, #7562ff, #d8e344, #118AB2);
    font-family: 'Arial', sans-serif;
    background-size: 400% 400%;
    animation: gradientAnimation 15s ease infinite;
}

@keyframes gradientAnimation {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

main {
    width: 60%;
    
    padding: 20px;
    border-radius: 10px;
    background-color: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.upper,.lower{
    width: 100%;
    height: 80px;
    display: contents;
    justify-content: space-evenly;
    
    
}
.middle{
    height: 100px;
    width: 100%;
    display: contents;
    justify-content: space-evenly;
    
}
strong{
    text-align: center;
    display: block;
        margin: 0 auto;
}

</style>
</head>

<body>
  
    
    <main>
        <form action="register_doctor.php" method="post">
            <strong>REGISTER A DOCTOR</strong>
        <hr>

        <div class="upper">
            <label for="doc_name">Doctor Name:</label>
            <input type="text" id="doc_name" name="doc_name" required>


            <label for="image">Image:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>
        <hr>
        <div class="middle">


            <label for="email">Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="email" id="email" name="email" required>

            <label for="mobile">&nbsp;&nbsp;&nbsp;&nbsp;Mobile:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" id="mobile" name="mobile" required>
<br>
<br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>


            
        </div>
        <hr>
        <div class="lower">

            <label for="department">Department:</label>
            <select id="depaetment" name="department" required>
                <option value="dept1">DEPT1</option>
                <option value="dept2">DEPT2</option>
                <option value="dept3">DEPT3</option>
            </select>

            <label for="qualification">Qualification:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" id="qualification" name="qualification" required>

            <hr>
            <label for="gender">Gender:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>

            <label for="aadhar_no">Aadhar Card N0.</label>
            <input type="text" id="aadhar_no" name="aadhar_no" required>
        </div>
        <hr>
        <button type="submit">Submit</button>
    </form>
    </main>
    <script src="" async defer></script>
    
</body>

</html>
