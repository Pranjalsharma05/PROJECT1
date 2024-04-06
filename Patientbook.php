

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewpoint" content="width=device-width, initial-scale=1">
	<title></title>

	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/font-awesome.min.css">
	<style>
		/* Global styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image:url(https://img.freepik.com/free-photo/copy-space-bowl-with-fruits-breakfast_23-2148571051.jpg?t=st=1711343043~exp=1711346643~hmac=10433a0f4139644d26efe6ffb21880d94706c60cb0926d3d3b8604da478c448c&w=740);
	background-repeat: no-repeat;
	background-size: cover;

}


/* Headings */
h1{
    text-align: center;
    font-size: 34px;
    line-height: 24px;
    padding: 2px;
}

/* Form container */
.Head {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	background-image: url(https://www.shutterstock.com/shutterstock/photos/615708752/display_1500/stock-vector-medical-report-line-flat-vector-icon-for-mobile-application-button-and-website-design-615708752.jpg);
    background-size: cover;
    background-repeat: no-repeat;
	image-opacity: 0.7;
}

/* Input fields */
.input-name, .input-name1 {
    margin-bottom: 10px;
}

/* Buttons */
/* Buttons */


/* Note paragraph */
p {
    margin-left: 160px;
    color: red;
    font-size: 18px;
}

/* Form container */
.input-name {
    margin-bottom: 10px;
}

/* Label for select */
label {
    display: block;
    margin-bottom: 5px;
}

/* Select dropdown */
select {
    width: 100%;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

/* Patient details */
h2 {
    margin-top: 20px;
    font-size: 20px;
}

/* Buttons */
button[type="submit"],
input[type="reset"],
button[type="button"] {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    margin-right: 10px;
}

button[type="submit"]:hover,
input[type="reset"]:hover,
button[type="button"]:hover {
    background-color: #45a049;
}


		</style>
</head>
<body>
	<h1 style="font-size:34px;line-height: 24px;padding: 2px;text-align: center;">Welcome</h1>

	<div class="Head">
			<div class="input-name1">
				
					<fieldset><div>
						<h2>Registration Process For Patient Details</h2><br>
	
						<div class="input-name">
						<form method="post" action="samya.html">
    <div class="input-name">
       
    </div><br>
    <h2>Patient Name:</h2><br><?php echo $name ?>
    <div>
        <h2>Father Name:</h2><?php echo $fathername ?>
    </div>
    <div><br>
        <h2>Patient Age:</h2><?php echo $age ?>
        <h2>Patient Gender:</h2><?php echo $gender ?>
        <h2>Patient Mobile no.:</h2><?php echo $mobile ?>
        <h2>Patient Email Id:</h2><?php echo $username ?>
        <h2>Patient Aadhar no.:</h2><?php echo $adharcard ?>
    </div>
    <hr>
   
    <hr>			    
    <input type="reset" value="Reset">
    <button type="button" onclick="">Submit</button>
</form>


					<script>
						    function submitOption() {
						        var ageOption = document.getElementById('ageOption');
						        var dobOption = document.getElementById('dobOption');
						        var ageInput = document.getElementById('ageInput');
						        var dobInput = document.getElementById('dobInput');

						        if (ageOption.checked) {
						            // Age option is selected
						            alert('Selected Age: ' + ageInput.value);
						        } else if (dobOption.checked) {
						            // Date of Birth option is selected
						            alert('Selected Date of Birth: ' + dobInput.value);
						        } else {
						            // Neither option is selected
						            alert('Please choose an option.');
						        }
						    }function myFunction() {
								  var x = document.getElementById("myInput");
								  if (x.type === "password") {
								    x.type = "text";
								  } else {
								    x.type = "password";
								  }
								}
						</script>
			</div>
		</div>
		<p style="margin-left: 160px;color: red;font-size:18px">Note: You must fill all boxes And
         This facility is only for Online Pre-Registration and not for Online Appointment for a specific Consultant/Unit</p>
</body>
</html>
