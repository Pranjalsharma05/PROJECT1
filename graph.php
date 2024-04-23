<?php
$host = 'localhost'; // or your host
$dbname = 'login';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Query to fetch data for gender graph
    $sql_gender = "SELECT doc_gender, COUNT(*) as count FROM doc_reg GROUP BY doc_gender";
    $stmt_gender = $conn->prepare($sql_gender);
    $stmt_gender->execute();

    $data_gender = $stmt_gender->fetchAll(PDO::FETCH_ASSOC);

    // Query to fetch data for department graph
    $sql_department = "SELECT doc_department, COUNT(*) as count FROM doc_reg GROUP BY doc_department";
    $stmt_department = $conn->prepare($sql_department);
    $stmt_department->execute();

    $data_department = $stmt_department->fetchAll(PDO::FETCH_ASSOC);

    $sql_patients = "SELECT patient_department, COUNT(*) as count FROM patient_offline_appointment GROUP BY patient_department";
    $stmt_patients = $conn->prepare($sql_patients);
    $stmt_patients->execute();

    $data_patients = $stmt_patients->fetchAll(PDO::FETCH_ASSOC);
    // Combine data for both graphs
    $combined_data = array("gender" => $data_gender, "doc_department" => $data_department, "patients"=>$data_patients);

    echo json_encode($combined_data);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
