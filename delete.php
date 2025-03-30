<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
} elseif (!isset($_SESSION['usertype']) || $_SESSION['usertype'] != 'admin') {
    header("Location: login.php");
    exit();
}
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";

$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['student_id'])) {
    $user_id = intval($_GET['student_id']);

    $sql = "DELETE FROM users WHERE id='$user_id'";

    $result = mysqli_query($data, $sql);

    if ($result) {
       
        header("Location: view_student.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($data);
    }
} else {
    echo "No student ID provided.";
}

mysqli_close($data);
?>