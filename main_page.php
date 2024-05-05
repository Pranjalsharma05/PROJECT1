<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PATIENT INTERFACE</title>
    <link rel="stylesheet" href="patient_interface.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

    <style>
        /* Your CSS styles here */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Josefin Sans', sans-serif;
            background-color: #f3f5f9;
        }

        .wrapper {
         display: flex;

        }

        

        .main_content {
           
            
            background: #fff;
            color: #717171;
        }
        ul{
           list-style-type: none;
        }


        /*  */
        .left{
          margin-left: 0.1vw;
          flex-direction: column;
          text-decoration: none;
          background: #52CEBA;
     max-width: max-content;
       flex-wrap: wrap;
     padding: 3%;
     box-shadow: 1px 2px 3px 5px grey;
          border: 2px dotted rgb(138, 138, 215);
          
       
      }
      p{
          font-weight: bolder;
          color: aliceblue;
    flex-wrap: wrap;
          font-size: 4.2vw;
          margin-top: 0.6vh;
      }
      ul{
          text-decoration: dotted;
          display: flex;
          flex-direction: column;
      display:contents;
       
      }
      a{
        color: white;
        font-weight: 600;
        text-decoration: none;
      }
      span:hover{
       display: block;
        background-color: #F08A5D;
        border-radius: 2px;
      }
      .navbar {
            background-color: #7FFFD4;
            overflow: hidden;
            height: 80px;
            
            display: flex;
            flex-wrap: wrap;
        }
        
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 20px 20px;
            text-decoration: none;
            cursor: pointer;
        }
        
        .navbar a:hover {
            background-color: #F08A5D;
            color: black;
        }  
       
        #google_translate_element {
            position: fixed;
            top: 20px;
            right: 20px;
            
            background-color:transparent;
            border-radius: 5px;
            
         
        }
        .logo{
            background-image: url(https://img.freepik.com/free-photo/3d-cartoon-doctor-character-face-mask_1048-12965.jpg?w=740&t=st=1711044975~exp=1711045575~hmac=008ff2bfe9abfc5ce60e37cee6188b705166bfff152fd905460aa3bc39c18fb2);
            background-repeat: no-repeat;
            height: 79px;
            width: 100px;
            background-size: cover;
        }
    </style>
</head>
<body>
<div class="navbar">
<div class="logo"></div>

        <a href="frontpage.html">Go To Main Page</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
        <div id="google_translate_element"></div>
        
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({ pageLanguage: 'en', includedLanguages: 'en,es,fr,hi,mr,ta,ur' }, 'google_translate_element');
            }
        </script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    
        <script src="" async defer></script>
        </div>
    </div>
<div class="wrapper">

    <div class="left">
        <p>Hi User</p>
        <hr>
        
        <ul>
            <span><br>
        <li><a href="welcome.html" target="content"><i class="fas fa-home"></i>Home</a></li>
          <br>
            <hr></span>
           <span> <Br>
                <li><a href="profile.php" target="content"><i class="fas fa-user"></i>Profile</li>
            <BR></a></span>
                <hr>
               <span><br> <li><a href="patient.php" id="book-appointment-link" target="content"><i class="fas fa-address-card"></i>BOOK AN APPOINTMENT</li>
          <BR></a></span>
            <hr>
           <span> <a href="teleappoint.html"><i class="fas fa-phone-volume"></i>BOOK A<br>TELECOMMUNICATION<br> APPOINTMENT
           <BR></a></span>
            <hr>
           <span> <li><a href="lab.html" id="book-labtest-link" target="content"><i class="fas fa-user-md"></i>BOOK Lab Tests</li>
            <BR></a></span>
                <hr>
              <span> <br> 
                <li><a href="prescription.php" target="content"><i class="fas fa-prescription-bottle-alt"></i>YOUR PRESCRIPTIONS</li>
            <br></a></span><hr>
           <span> <br>
            <li><a href="logout.php" ><i class="fas fa-sign-out-alt"></i>LOGOUT</li><br></a>
            </span>
        
    </ul>
    </div>
    
    





    <div class="main_content">
        <iframe name="content" style="width: 77vw; height: 133vh; border: none;"></iframe>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Set the iframe src to the home page URL
        document.querySelector('iframe[name="content"]').src = 'welcome.html';

        const bookAppointmentLink = document.getElementById("book-appointment-link");
        const bookLabTestLink = document.getElementById("book-labtest-link");
        const bookTelecommunicationAppointmentLink = document.getElementById("book-telecommunication-appointment-link");

        bookAppointmentLink.addEventListener("click", function(event) {
            event.preventDefault();
            document.querySelector('iframe[name="content"]').src = 'patient.php';
        });

        bookLabTestLink.addEventListener("click", function(event) {
            event.preventDefault();
            document.querySelector('iframe[name="content"]').src = 'lab.html';
        });

        bookTelecommunicationAppointmentLink.addEventListener("click", function(event) {
            event.preventDefault();
            document.querySelector('iframe[name="content"]').src = 'telecommunication.html';
        });
    });
</script>
</body>
</html>