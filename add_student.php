<?php
session_start();

if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
} elseif (!isset($_SESSION['usertype']) || $_SESSION['usertype'] == 'student') {
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

if (isset($_POST['add_student'])) {
    $username = $_POST['username'];
    $user_phone = $_POST['phone'];
    $user_email = $_POST['email'];
    $usertype = "student";
    $user_password = $_POST['password'];

    $sql = "INSERT INTO users (username, phone, email, usertype, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($data, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $username, $user_phone, $user_email, $usertype, $user_password);

   
    if (mysqli_stmt_execute($stmt)) {
        echo "<script type='text/javascript'>alert('Data Upload success')
        </script>";

    } else {
        echo "Error: " . mysqli_error($data);
    }

    
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <style type="text/css">
        label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .div_deg {
            background-color: lightskyblue;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 50px;
        }
    </style>

    <?php include 'admin_css.php'; ?>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>

    <div class="content">
        <h1>Add Student</h1>

        <div class="div_deg">
            <form action="#" method="POST">
                <fieldset>
                    <div>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div>
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>

                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div>
                        <center>
                        <input type="submit" class="btn btn-success " name="add_student" value="Add Student">
                    </center>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</body>
</html>