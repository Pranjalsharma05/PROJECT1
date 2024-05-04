<?php
// Establish connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$doctorName = $_POST['doctorName'];
$patientName = $_POST['patientName'];
$date = $_POST['date'];
$diagnosedDisease = $_POST['diagnosedDisease'];
$prescribedTreatment = $_POST['prescribedTreatment'];
$medicineAdvised = $_POST['medicineAdvised'];
$miscellaneous = $_POST['miscellaneous'];

// Insert form data into the database
$sql = "INSERT INTO prescriptions (doctorName, patientName, date, diagnosedDisease, prescribedTreatment, medicineAdvised, miscellaneous)
        VALUES ('$doctorName', '$patientName', '$date', '$diagnosedDisease', '$prescribedTreatment', '$medicineAdvised', '$miscellaneous')";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Prescription Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    h2 {
        text-align: center;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
    }
    .form-group input[type="text"],
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .form-group textarea {
        height: 100px;
    }
    .btn {
        display: block;
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }
    .btn:hover {
        background-color: #0056b3;
    }
    #pdfViewer {
        width: 100%;
        height: 600px; /* Adjust the height as needed */
    }
</style>
</head>
<body>

<div class="container">
    <h2>DEPARTMENT OF GENERAL SURGERY</h2>
    <form id="prescriptionForm">
        <div class="form-group">
            <label for="doctorName">Doctor's Name:</label>
            <input type="text" id="doctorName" name="doctorName" required>
        </div>
        <div class="form-group">
            <label for="patientName">Patient's Name:</label>
            <input type="text" id="patientName" name="patientName" required>
        </div>
        <div class="form-group">
            <label for="date">Date of Prescription:</label>
            <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="diagnosedDisease">Diagnosed Disease:</label>
            <input type="text" id="diagnosedDisease" name="diagnosedDisease" required>
        </div>
        <div class="form-group">
            <label for="prescribedTreatment">Prescribed Treatment:</label>
            <textarea id="prescribedTreatment" name="prescribedTreatment" required></textarea>
        </div>
        <div class="form-group">
            <label for="medicineAdvised">Medicine Advised:</label>
            <textarea id="medicineAdvised" name="medicineAdvised" required></textarea>
        </div>
        <div class="form-group">
            <label for="miscellaneous">Miscellaneous:</label>
            <textarea id="miscellaneous" name="miscellaneous"></textarea>
        </div>
        <button type="button" class="btn" onclick="generatePDF()">Generate PDF</button>

    </form>
</div>
<iframe id="pdfViewer" frameborder="0"></iframe>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
    function generatePDF() {
        // Capture form data
        const formData = {
            doctorName: document.getElementById('doctorName').value,
            patientName: document.getElementById('patientName').value,
            date: document.getElementById('date').value,
            diagnosedDisease: document.getElementById('diagnosedDisease').value,
            prescribedTreatment: document.getElementById('prescribedTreatment').value,
            medicineAdvised: document.getElementById('medicineAdvised').value,
            miscellaneous: document.getElementById('miscellaneous').value
        };

        // Create PDF instance
        const doc = new jsPDF();

        // Set content
        doc.text(20, 20, 'Doctor\'s Name: ' + formData.doctorName);
        doc.text(20, 30, 'Patient\'s Name: ' + formData.patientName);
        doc.text(20, 40, 'Date of Prescription: ' + formData.date);
        doc.text(20, 50, 'Diagnosed Disease: ' + formData.diagnosedDisease);
        doc.text(20, 60, 'Prescribed Treatment: ' + formData.prescribedTreatment);
        doc.text(20, 70, 'Medicine Advised: ' + formData.medicineAdvised);
        doc.text(20, 80, 'Miscellaneous: ' + formData.miscellaneous);

        // Convert PDF to base64
        const pdfData = doc.output('datauristring');

        // Display PDF
        const pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.src = pdfData;
    }
</script>

</body>
</html>
