<?php
require_once "config.php";

// Query to fetch data from the database
$query = "SELECT * FROM profile";
$query1 = "SELECT * FROM users";

// Execute queries
$result = mysqli_query($conn, $query);
$result1 = mysqli_query($conn, $query1);

// Fetch data from the results
$row = mysqli_fetch_assoc($result);
$row1 = mysqli_fetch_assoc($result1);

// Assign variables
$name = $row['name'];
$age = $row['age'];
$gender = $row['gender'];
$email = $row['username'];
$mobile = $row1['mobile'];

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tele-Communication</title>
</head>
<style>
    body{
        opacity:0.8;
        background-image: url("https://img.freepik.com/free-photo/beautiful-shining-stars-night-sky_181624-622.jpg?size=626&ext=jpg&ga=GA1.1.1078269260.1707474405&semt=sph");
    }
    .box {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    justify-content: center;
    flex-direction: column;
    border-radius: 5px;
    height: 70vh;
    width: 66%;
    box-shadow: aqua 2px 4px 5px 3px;
    background-color: aqua;
    padding: 3%;
   
}
h1{
    color: blue;

}
button{
    color: white;
    border-radius: 4px;
    width: 70%;
    align-self: center;
    background-color: rgb(52, 214, 52);
}
button:hover{
    cursor: pointer;
}
p{
    font-size: x-large;
    font-weight: 900;
   
}
td .p{
    color:red;
}
</style>
<body>
    <div class="box">
        <h1>Consult with Doctor</h1>
        <form method="Post" action="">
        <table>
            <tr>
                <td><p>Name:</p> </td>
                <td><p style="color:red"><?php echo "$name" ?></p></td>
                <td></td><td></td>
                <td><p>Email:</p></td>
                <td><p style="color:red"><?php echo "$email" ?></p></td>
            </tr>
            <tr>
                <td><p>Mobile No.:</p> </td>
                <td><p style="color:red"><?php echo "$mobile" ?></p></td>
                <td> </td>
                <td> </td>
                <td><p>Age:</p></td>
                <td><p style="color:red"><?php echo "$age" ?></p></td>
            </tr>
            <tr>
                <td><p>Gender:</p></td>
                <td><p style="color:red"><?php echo "$gender" ?></p></td>
            </tr>
        </table>
        <button><p>Click to Book online consultation</p></button>
</form>
    </div>
</body>
</html>
