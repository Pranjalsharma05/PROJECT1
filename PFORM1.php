<?php
require_once "config.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['doc'], $_POST['pat'], $_POST['date'], $_POST['dis'], $_POST['trt'], $_POST['med'])) {
    $doc = trim($_POST['doc']);
    $pat = trim($_POST['pat']);
    $date = $_POST['date'];
    $dis = trim($_POST['dis']);
    $trt = trim($_POST['trt']);
    $med = trim($_POST['med']);

    // No need for the loop here, just proceed with generating PDF
    // $text = json_encode([$doc, $pat, $date, $dis, $trt, $med]);

        $python = shell_exec("python pdf.py \"$doc\" \"$pat\" \"$date\" \"$dis\" \"$trt\" \"$med\"");
    
}
}
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
    .form-group textarea,
    .form-group input[type="date"] {
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
    <form id="prescriptionForm" method="POST" action="">
        <div class="form-group">
            <label for="doctorName">Doctor's Name:</label>
            <input type="text" id="doctorName" name="doc" required>
        </div>
        <div class="form-group">
        <label for="patientUsername">Patient's Email:</label>
            <input type="email" id="patientUsername" name="pat" required>
        </div>
        <div class="form-group">
            <label for="date">Date of Prescription:</label>
            <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="diagnosedDisease">Diagnosed Disease:</label>
            <input type="text" id="diagnosedDisease" name="dis" required>
        </div>
        <div class="form-group">
            <label for="prescribedTreatment">Prescribed Treatment:</label>
            <textarea id="prescribedTreatment" name="trt" required></textarea>
        </div>
        <div class="form-group">
            <label for="medicineAdvised">Medicine Advised:</label>
            <textarea id="medicineAdvised" name="med" required></textarea>
        </div>
      
        <button type="submit" class="btn" name="pdf">Generate PDF</button>

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
            // miscellaneous: document.getElementById('miscellaneous').value // Uncomment this if there's a field with ID 'miscellaneous'
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
        // doc.text(20, 80, 'Miscellaneous: ' + formData.miscellaneous); // Uncomment this if there's a field with ID 'miscellaneous'

        // Convert PDF to base64
        const pdfData = doc.output('datauristring');

        // Display PDF
        const pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.src = pdfData;
    }
</script>

</body>
</html>
