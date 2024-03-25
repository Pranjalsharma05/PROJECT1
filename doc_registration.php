<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "config.php";

// image_doc

$em="";
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process image upload
    if (isset($_FILES['doc_image'])) {
        // Retrieve file details
        $img_name = $_FILES['doc_image']['name'];
        $img_size = $_FILES['doc_image']['size'];
        $tmp_name = $_FILES['doc_image']['tmp_name'];
        $error = $_FILES['doc_image']['error'];

        // Check if there was no error during file upload
        if ($error === UPLOAD_ERR_OK) {
            // Check file size
            if ($img_size > 1250000) {
                $em = "Sorry, the file is too large";
            } else {
                // Get file extension
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                // Allowed file extensions
                $allowed_exs = array("jpeg", "jpg", "png");

                // Check if the file has an allowed extension
                if (in_array($img_ex_lc, $allowed_exs)) {
                    // Read image data and encode as base64
                    $image_data = file_get_contents($tmp_name);
                    $base64_image = base64_encode($image_data);

                    // Remove line breaks from the base64 string
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

$doc_id = $doc_name = $doc_email = $doc_password = $doc_confirm_password = $doc_aadhar = $doc_gender =$doc_qualification = $doc_mobile =$doc_department = "";
$doc_id_err = $doc_name_err = $doc_email_err = $doc_password_err = $doc_confirm_password_err = $doc_aadhar_err = $doc_gender_err = $doc_qualification_err  = $doc_mobile_err =$doc_department_err = "";

if (empty(trim($_POST["doc_id"]))) {
    $doc_id_err = "ID cannot be blank";
} else {
    $doc_id = trim($_POST['doc_id']);
}


if (empty(trim($_POST["doc_name"]))) {
    $doc_name_err = "Name cannot be blank";
} else {
    $doc_name = trim($_POST['doc_name']);
}

if (empty(trim($_POST['doc_gender']))) {
    $doc_gender_err = "doc_gender can't be empty";
} else {
    $doc_gender = trim($_POST['doc_gender']);
}

if (empty(trim($_POST['doc_email']))) {
    $doc_email_err = "doc_email name can't be empty";
} else {
    $doc_email = trim($_POST['doc_email']);
}

if (empty(trim($_POST['doc_aadhar']))) {
    $doc_aadhar_err = "Adhar card number can't be empty";
} elseif (strlen(trim($_POST['doc_aadhar'])) < 12) {
    $doc_aadhar_err = "Adoc_aadhar number cannot be less than 12 characters";
} else {
    $doc_aadhar = trim($_POST['doc_aadhar']);
}

if (empty(trim($_POST['doc_qualification']))) {
    $doc_qualification_err = "Qualification can't be empty";
} else {
    $doc_qualification = trim($_POST['doc_qualification']);
}

// check mobile
if(empty(trim($_POST['doc_mobile']))){
    $doc_mobile_err="mobile can't empty";
  }
  elseif(strlen(trim($_POST['doc_mobile']))<10){
    $doc_mobile_err = "doc_mobile no. cannot be less than 10 characters";
  }
  else{
    $doc_mobile = trim($_POST['doc_mobile']);
  }

// Check for password
// Check for password
if (empty(trim($_POST['doc_password']))) {
    $doc_password_err = "Password cannot be blank";
} elseif (strlen(trim($_POST['doc_password'])) < 4) {
    $doc_password_err = "Password cannot be less than 4 characters";
} else {
    $doc_password = trim($_POST['doc_password']);
}

// Check for confirm password field
if (trim($_POST['doc_password']) != trim($_POST['doc_confirm_password'])) {
    $doc_confirm_password_err = "Passwords should match";
}




    if (empty(trim($_POST['doc_department']))) {
        $doc_department_err = "Department can't be empty";
    } else {
        $doc_department = trim($_POST['doc_department']);
    }

if(empty($doc_id_err) && empty($doc_name_err) && empty($doc_email_err) && empty($doc_mobile_err) && empty($doc_department_err) && empty($doc_qualification_err) && empty($doc_password_err) && empty($doc_confirm_password_err) && empty($doc_gender_err) && empty($doc_aadhar_err)){

$sql="INSERT INTO doc_reg(doc_id,doc_name,doc_image,doc_email,doc_password,doc_mobile,doc_department,doc_qualification,doc_gender,doc_aadhar) VALUES(?,?,?,?,?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);

    if($stmt){
        mysqli_stmt_bind_param($stmt,"ssssssssss",$param_doc_id,$param_doc_name,$base64_image,$param_doc_email,$param_doc_password,$param_doc_mobile,$param_doc_department,$param_doc_qualification,$param_doc_gender,$param_doc_aadhar);

        $param_doc_id=trim($doc_id);
        $param_doc_name=trim($doc_name);
        $param_doc_email=trim($doc_email);
        $param_doc_password = password_hash($doc_password, PASSWORD_DEFAULT);
        $param_doc_mobile=$doc_mobile;
        $param_doc_department=trim($doc_department);
        $param_doc_qualification=trim($doc_qualification);
        $param_doc_gender=trim($doc_gender);
        $param_doc_aadhar=$doc_aadhar;
        if (mysqli_stmt_execute($stmt)) {
            header("location: view_doc.php");
        } else {
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
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
                background-size: cover;}

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
  
    

<h1>REGISTER A DOCTOR</h1>
<style>
    form{
        display:flex;
        flex-direction:column;
    }
    </style>
   
<div class="inputs">
      <form action="" method="POST" enctype="multipart/form-data">
        <label>Doctor Id:</label>
        <input type="number" name="doc_id">
        <label>Doctor Name:</label>
        <input type="text" name="doc_name">
        <label>Doctor Image</label>
        <!-- <img src="https://i.pinimg.com/474x/16/18/20/1618201e616f4a40928c403f222d7562.jpg"> -->
        <input type="file"  name="doc_image" accept="image/*" required>
        <label>Doctor Email:</label>
        <input type="email" name="doc_email">
        <label>Doctor Mobile:</label>
        <input type="tel" name="doc_mobile">

        <label>Doctor password:</label>
        <input type="password" name="doc_password">
        <label>Doctor Confirm password:</label>
        <input type="password" name="doc_confirm_password">
        <label>Doctor Qualification:</label>
        <input type="text" name="doc_qualification" >
        <label>Doctor Gender:</label>
        <input type="text" name="doc_gender">
        <label>Doctor Adhar</label>
        <input type="number" name="doc_aadhar">
        <label>Doctor Department</label>
        <input type="text" name="doc_department">

        <button>SUBMIT</button>
      </form>

    <?php if (!empty($doc_id_err)) { echo "<p style='color: red;'>$doc_id_err</p>"; } ?>
     <?php if (!empty($doc_name_err)) { echo "<p style='color: red;'>$doc_name_err</p>"; } ?>
     <?php if (!empty($doc_password_err)) { echo "<p style='color: red;'>$doc_password_err</p>"; } ?>
     <?php if (!empty($doc_email_err)) { echo "<p style='color: red;'>$doc_email_err</p>"; } ?>
     <?php if (!empty($doc_aadhar_err)) { echo "<p style='color: red;'>$doc_aadhar_err</p>"; } ?>
     <?php if (!empty($doc_gender_err)) { echo "<p style='color: red;'>$doc_gender_err</p>"; } ?>
     <?php if (!empty($em)) { echo "<p style='color: red;'>$em</p>"; } ?>
     <?php if (!empty($doc_qualification_err)) { echo "<p style='color: red;'>$doc_qualification_err</p>"; } ?>
     <?php if (!empty($doc_department_err)) { echo "<p style='color: red;'>$doc_department_err</p>"; } ?>
     <?php if (!empty($doc_mobile_err)) { echo "<p style='color: red;'>$doc_mobile_err</p>"; } ?>
     <?php if (!empty($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
     <?php if (!empty($doc_confirm_password_err)) { echo "<p style='color: red;'>$doc_confirm_password_err</p>"; } ?>
    </main>

    
    
</body>

</html>
