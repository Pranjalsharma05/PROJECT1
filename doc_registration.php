<?php
require_once "config.php";

$doc_name = $doc_email = $doc_password = $confirm_password = $doc_mobile = $doc_department = $doc_qualification = $doc_gender = $doc_aadhar = "";
$doc_name_err = $doc_email_err = $doc_password_err = $confirm_password_err = $doc_mobile_err = $doc_department_err = $doc_qualification_err = $doc_gender_err = $doc_aadhar_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if doctor name is empty
    if (empty(trim($_POST["doc_name"]))) {
        $doc_name_err = "Doctor Name cannot be blank";
    } else {
        // Validate doctor name
        $doc_name = trim($_POST["doc_name"]);
    }

    // Check if doctor email is empty
    if (empty(trim($_POST["doc_email"]))) {
        $doc_email_err = "Email cannot be blank";
    } else {
        // Validate doctor email
        $doc_email = trim($_POST["doc_email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["doc_password"]))) {
        $doc_password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST["doc_password"])) < 4) {
        $doc_password_err = "Password must be at least 4 characters";
    } else {
        $doc_password = trim($_POST["doc_password"]);
    }

    // Check if confirm password matches
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($doc_password_err) && ($doc_password != $confirm_password)) {
            $confirm_password_err = "Passwords did not match";
        }
    }

    // Check if mobile number is empty
    if (empty(trim($_POST["doc_mobile"]))) {
        $doc_mobile_err = "Mobile number cannot be blank";
    } elseif (strlen(trim($_POST["doc_mobile"])) < 10) {
        $doc_mobile_err = "Mobile number must be at least 10 characters";
    } else {
        $doc_mobile = trim($_POST["doc_mobile"]);
    }

    // Check if department is empty
    if (empty(trim($_POST["doc_department"]))) {
        $doc_department_err = "Please select a department";
    } else {
        $doc_department = trim($_POST["doc_department"]);
    }

    // Check if qualification is empty
    if (empty(trim($_POST["doc_qualification"]))) {
        $doc_qualification_err = "Qualification cannot be blank";
    } else {
        $doc_qualification = trim($_POST["doc_qualification"]);
    }

    // Check if gender is empty
    if (empty(trim($_POST["doc_gender"]))) {
        $doc_gender_err = "Please select a gender";
    } else {
        $doc_gender = trim($_POST["doc_gender"]);
    }

    // Check if Aadhar card number is empty
    if (empty(trim($_POST["doc_aadhar"]))) {
        $doc_aadhar_err = "Aadhar Card number cannot be blank";
    } else {
        $doc_aadhar = trim($_POST["doc_aadhar"]);
    }

    // If no errors, insert into database
    if (empty($doc_name_err) && empty($doc_email_err) && empty($doc_password_err) && empty($confirm_password_err) && empty($doc_mobile_err) && empty($doc_department_err) && empty($doc_qualification_err) && empty($doc_gender_err) && empty($doc_aadhar_err)) {
        $sql = "INSERT INTO doctors (doc_name, doc_email, doc_password, doc_mobile, doc_department, doc_qualification, doc_gender, doc_aadhar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_doc_name, $param_doc_email, $param_doc_password, $param_doc_mobile, $param_doc_department, $param_doc_qualification, $param_doc_gender, $param_doc_aadhar);
            $param_doc_name = $doc_name;
            $param_doc_email = $doc_email;
            $param_doc_password = password_hash($doc_password, PASSWORD_DEFAULT);
            $param_doc_mobile = $doc_mobile;
            $param_doc_department = $doc_department;
            $param_doc_qualification = $doc_qualification;
            $param_doc_gender = $doc_gender;
            $param_doc_aadhar = $doc_aadhar;

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
    background-image: url('https://img.freepik.com/free-vector/medical-team-design_1232-3215.jpg?t=st=1710982746~exp=1710986346~hmac=269b4f6f6027ee62dfca84d5740f3125a020aad74eba1c9c16e1d54e4db7431f&w=740');
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;

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
            <label for="doc_email">Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="email" id="doc_email" name="doc_email" required>

            <label for="doc_mobile">&nbsp;&nbsp;&nbsp;&nbsp;Mobile:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" id="doc_mobile" name="doc_mobile" required>
            <br><br>

            <label for="doc_password">Password:</label>
            <input type="password" id="doc_password" name="doc_password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <hr>
        <div class="lower">
            <label for="doc_department">Department:</label>
            <select id="doc_department" name="doc_department" required>
                <option value="dept1">DEPT1</option>
                <option value="dept2">DEPT2</option>
                <option value="dept3">DEPT3</option>
            </select>

            <label for="doc_qualification">Qualification:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" id="doc_qualification" name="doc_qualification" required>

            <hr>
            <label for="doc_gender">Gender:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select id="doc_gender" name="doc_gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>

            <label for="doc_aadhar">Aadhar Card N0.</label>
            <input type="text" id="doc_aadhar" name="doc_aadhar" required>
        </div>
        <hr>
        <button type="submit">Submit</button>
    </form>
</main>

    <script src="" async defer></script>
    
</body>

</html>
