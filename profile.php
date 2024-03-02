<?php
require_once "config.php";

$name = $age = $fathername = $gender = $adharcard = "";
$streetaddress = $city = $state = $postalcode = $country = "";
$name_err = $age_err = $fathername_err = $gender_err = $adharcard_err = "";
$streetaddress_err = $city_err = $state_err = $postalcode_err = $country_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST["name"]))) {
        $name_err = "Name cannot be blank";
    } else {
        $name = trim($_POST['name']);
    }

    if (empty(trim($_POST['age']))) {
        $age_err = "Age can't be empty";
    } else {
        $age = trim($_POST['age']);
    }

    if (empty(trim($_POST['fathername']))) {
        $fathername_err = "Father's name can't be empty";
    } else {
        $fathername = trim($_POST['fathername']);
    }

    if (empty(trim($_POST['adharcard']))) {
        $adharcard_err = "Adhar card number can't be empty";
    } elseif (strlen(trim($_POST['adharcard'])) < 12) {
        $adharcard_err = "Adhar card number cannot be less than 12 characters";
    } else {
        $adharcard = trim($_POST['adharcard']);
    }

    if (empty(trim($_POST['gender']))) {
        $gender_err = "Gender can't be empty";
    } else {
        $gender = trim($_POST['gender']);
    }

    if (empty(trim($_POST['streetaddress']))) {
        $streetaddress_err = "Street address can't be empty";
    } else {
        $streetaddress = trim($_POST['streetaddress']);
    }

    if (empty(trim($_POST['state']))) {
        $state_err = "State can't be empty";
    } else {
        $state = trim($_POST['state']);
    }

    if (empty(trim($_POST['city']))) {
      $city_err = "city can't be empty";
  } else {
      $city = trim($_POST['city']);
  }

    if (empty(trim($_POST['postalcode']))) {
        $postalcode_err = "Postal code can't be empty";
    } else {
        $postalcode = trim($_POST['postalcode']);
    }

    if (empty(trim($_POST['country']))) {
        $country_err = "Country can't be empty";
    } else {
        $country = trim($_POST['country']);
    }

    if (empty($name_err) && empty($age_err) && empty($fathername_err) && empty($adharcard_err) && empty($gender_err) && empty($streetaddress_err)
        && empty($city_err) && empty($state_err) && empty($postalcode_err) && empty($country_err)) {
 H
        $sql = "INSERT INTO profile (name,age,fathername,adharcard,gender,streetaddress,city,state,postalcode,country) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssssssss", $param_name, $param_age, $param_fathername, $param_adharcard, $param_gender, $param_streetaddress, $param_city, $param_state, $param_postalcode, $param_country);

            $param_name = trim($name);
            $param_age = $age;
            $param_fathername = trim($fathername);
            $param_adharcard = $adharcard;
            $param_gender = $gender;
            $param_streetaddress = $streetaddress;
            $param_city = $city;
            $param_state = $state;
            $param_postalcode = $postalcode;
            $param_country = $country;

            if (mysqli_stmt_execute($stmt)) {
                header("location: a.html");
            } else {
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
    <title>Profile</title>
   <style>*{
    margin:0;
    padding: 0;
}
body{
    background-image: url("https://img.freepik.com/free-vector/medical-healthcare-blue-color_1017-26807.jpg?size=626&ext=jpg&ga=GA1.1.1078269260.1707474405&semt=ais");
    color: rgb(7, 6, 6);

    width: 100%;
   background-repeat: no-repeat;
   background-size: cover;
   background-position:center;
   
}
.photo{
    display: flex;

    height: 25vh;
    
}
img{
    border-radius: 5px;
    margin: 0.2%;
    height: 20vh;
    width: 100%;
    border: solid white 1px;
    position: relative;
    /* display: flex; */
 
   
}
.info{
   
    position: absolute;
    z-index: 1;
    /* color: rgb(207, 201, 201); */
    margin: 2%;
    color: rgb(248, 248, 249);
   
}
.info1{
position: absolute;
    color:black;
    
display: flex;
flex-direction:column;
flex-wrap: wrap;


margin-left: 80%;


}

.info1 img{
width: 20%;
height:19vh;
border-radius: 50%;
border: 2px solid black;
}
h1{
    text-decoration:underline;
    color: red;

}
h2{
    
    font-family: monospace;
    font-size: 4vw;
    align-self: center;
    z-index: 1;
}

.data{
    
   
    display: flex;
    flex-direction: column;
    padding: 1.5%;
    justify-content: center;
    /* align-items: center; */
    
    border-radius: 3px;
   /* border: solid 2px white; */
    background-color:transparent;
    margin-top: 0px;
}
.data input,select{
    width: 70%;
    
}

button{
color:white;
font-weight: 900;
background-color: rgb(48, 46, 46);
max-width: min-content;
align-self: center;
padding: 2px;
margin: 1%;
border-radius: 3px;
}
button:hover{
   transform:rotateX(50deg) ;
    cursor: pointer;
}</style>
</head>

<body>
    <div class="photo">
        <img src="https://img.freepik.com/free-vector/medical-technology-science-background-vector-blue-with-blank-space_53876-117739.jpg?size=626&ext=jpg&ga=GA1.1.1078269260.1707474405&semt=ais">
        <h1 class="info">Add your Information:</h1>
        <!-- profile image -->
    </div>
    <div class="info1">
        <img src="https://i.pinimg.com/474x/16/18/20/1618201e616f4a40928c403f222d7562.jpg">
        <input type="file" id="profileImage" name="profileImage" accept="image/*" required>
    </div>
    <form action="" method="post">
        <div class="data">
            <h2>Profile</h2>
            <br>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required placeholder="Enter Name">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required placeholder="Enter Age">
            <label for="fatherName">Father's Name:</label>
            <input type="text" id="fatherName" name="fathername" required placeholder="Enter Father name">
            <label>Gender:</label>
            <select name="gender">
                <option>Male</option>
                <option>Female</option>
                <option>Others</option>
            </select>
            <label>Adhar Card number:</label>
            <input type="number" name="adharcard" placeholder="Enter Adhar card number" minlength="12" maxlength="12" required>
            <br><h2>Address Details:</h2>
            <label for="streetAddress">Street Address:</label>
            <input type="text" id="streetAddress" name="streetaddress" required placeholder="Enter Street Address">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" required placeholder="Enter City">
            <label for="state">State/Province:</label>
            <input type="text" id="state" name="state" required placeholder="Enter State">
            <label for="postalCode">Postal/ZIP Code:</label>
            <input type="text" id="postalCode" name="postalcode" required placeholder="Enter ZipCode ">
            <label for="country">Country:</label>
            <select id="country" name="country" required placeholder="Enter ">
                <option value="" disabled selected>Select your country</option>
                <option value="India">INDIA</option>
            </select>
            <button>Save</button>
        </div>
    </form>
    <?php if (!empty($name_err)) { echo "<p style='color: red;'>$name_err</p>"; } ?>
    <?php if (!empty($age_err)) { echo "<p style='color: red;'>$age_err</p>"; } ?>
    <?php if (!empty($fathername_err)) { echo "<p style='color: red;'>$fathername_err</p>"; } ?>
    <?php if (!empty($adharcard_err)) { echo "<p style='color: red;'>$adharcard_err</p>"; } ?>
    <?php if (!empty($gender_err)) { echo "<p style='color: red;'>$gender_err</p>"; } ?>
    <br><br>
</body>

</html>
