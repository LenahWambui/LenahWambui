<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("Connection error: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Username'];
    $pass = $_POST['Password'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM users WHERE Username=? AND password=?";
    $stmt = mysqli_prepare($data, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $name, $pass);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result === false) {
        die("Query error: " . mysqli_error($data));
    }

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['Username'] = $name; // Set the username
        $_SESSION['usertype'] = $row['usertype']; // Set the usertype

        if ($row["usertype"] == "student") {
            header("location: studenthome.php");
            exit();
        } elseif ($row["usertype"] == "admin") {
            header("location: adminhome.php");
            exit();
        }
    } else {
        $message = "Username or password do not match";
        $_SESSION['loginmessage'] = $message;
        header("location: login.php");
        exit();
    }
}
?>