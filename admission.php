<?php
session_start();

// Redirect if user is not logged in or is a student
if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
} elseif (!isset($_SESSION['usertype']) || $_SESSION['usertype'] == 'student') {
    header("Location: login.php");
    exit();
}

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";

$data = mysqli_connect($host, $user, $password, $db);

// Check connection
if ($data === false) {
    die("Connection error: " . mysqli_connect_error());
}

// Fetch data from the admission table
$sql = "SELECT * FROM admission";
$result = mysqli_query($data, $sql); // Use mysqli_query() instead of mysql_query()

// Check for query errors
if ($result === false) {
    die("Query error: " . mysqli_error($data));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <?php include 'admin_css.php'; ?>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    <div class="content">
        <center>
            <h1>Applied For Admission</h1>
            <br><br>
            <table border="2px">
                <tr>
                    <th style="padding: 20px; font-size: 15px;">SURNAME</th>
                    <th style="padding: 20px; font-size: 15px;">FIRST NAME</th>
                    <th style="padding: 20px; font-size: 15px;">LAST NAME</th>
                    <th style="padding: 20px; font-size: 15px;">BIRTH DATE</th>
                    <th style="padding: 20px; font-size: 15px;">GENDER</th>
                    <th style="padding: 20px; font-size: 15px;">EMAIL</th>
                    <th style="padding: 20px; font-size: 15px;">GUARDIAN NAME</th>
                    <th style="padding: 20px; font-size: 15px;">GUARDIAN CONTACT</th>
                    <th style="padding: 20px; font-size: 15px;">HOBBIES</th>
                    <th style="padding: 20px; font-size: 15px;">MESSAGE</th>
                </tr>
                <?php while ($info = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td style="padding: 20px;"><?php echo $info['surname']; ?></td>
                        <td style="padding: 20px;"><?php echo $info['firstname']; ?></td>
                        <td style="padding: 20px;"><?php echo $info['lastname']; ?></td>
                        <td style="padding: 20px;"><?php echo $info['birthdate']; ?></td>
                        <td style="padding: 20px;"><?php echo $info['gender']; ?></td>
                        <td style="padding: 20px;"><?php echo $info['email']; ?></td>
                        <td style="padding: 20px;"><?php echo $info['guardian_name']; ?></td>
                        <td style="padding: 20px;"><?php echo $info['guardian_contact']; ?></td>
                        <td style="padding: 20px;"><?php echo $info['hobbies']; ?></td>
                        <td style="padding: 20px;"><?php echo $info['message']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </center>
    </div>
</body>
</html>