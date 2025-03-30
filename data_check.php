<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("Connection error: " . mysqli_connect_error());
}

if (isset($_POST['apply'])) {
   
    $data_name = mysqli_real_escape_string($data, $_POST['surname']);
    $data_firstname = mysqli_real_escape_string($data, $_POST['firstname']);
    $data_lastname = mysqli_real_escape_string($data, $_POST['lastname']);
    $data_birth_date = mysqli_real_escape_string($data, $_POST['birthdate']);
    $data_gender = mysqli_real_escape_string($data, $_POST['gender']);
    $data_email = mysqli_real_escape_string($data, $_POST['email']);
    $data_guardian_name = mysqli_real_escape_string($data, $_POST['guardian_name']);
    $data_guardian_contact = mysqli_real_escape_string($data, $_POST['guardian_contact']);
    $data_hobbies = mysqli_real_escape_string($data, $_POST['hobbies']);
    $data_message = mysqli_real_escape_string($data, $_POST['message']);
   
   
    $stmt = $data->prepare("INSERT INTO admission (surname, firstname, lastname, birthdate, gender, email, guardian_name, guardian_contact, hobbies, message) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($data->error));
    }
var_dump($data_name, $data_firstname, $data_lastname, $data_birth_date, $data_gender, $data_email, $data_guardian_name, $data_guardian_contact, $data_hobbies, $data_message);
   echo "Type string: ssssssssss\n";
    $stmt->bind_param("ssssssssss", 
        $data_name, 
        $data_firstname, 
        $data_lastname, 
        $data_birth_date, 
        $data_gender, 
        $data_email, 
        $data_guardian_name, 
        $data_guardian_contact, 
        $data_hobbies, 
        $data_message
    );

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Your Application sent successfully"; 
        header("Location: index.php"); 
        exit(); 
   
    $stmt->close();
}

$data->close();
}
?>