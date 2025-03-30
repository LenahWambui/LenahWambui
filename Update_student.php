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

if (isset($_POST['update'])) {
    $id = intval($_POST['student_id']);
    $name = mysqli_real_escape_string($data, $_POST['username']);
    $email = mysqli_real_escape_string($data, $_POST['email']);
    $phone = mysqli_real_escape_string($data, $_POST['phone']);
    $password = mysqli_real_escape_string($data, $_POST['password']);

    $query = "UPDATE users SET username='$name', email='$email', phone='$phone', password='$password' WHERE id='$id'";
    $result2 = mysqli_query($data, $query);

    if ($result2) {
        echo "<script>alert('Student updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update student');</script>";
    }
}

if (isset($_GET['student_id'])) {
    $id = intval($_GET['student_id']);

    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($data, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $info = $result->fetch_assoc();
    } else {
        die("Student not found.");
    }
} else {
    die("No student ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <?php include 'admin_css.php'; ?>

    <style type="text/css">
        label {
            display: inline-block;
            width: 100px;
            text-align: right;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .div_deg {
            background-color: skyblue;
            width: 400px;
            padding-bottom: 70px;
            padding-top: 70px;
        }
    </style>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    
    <div class="content">
        <h1>Update Student</h1>
        <div class="div_deg">
            <form method="POST" action="#">
                <input type="hidden" name="student_id" value="<?php echo $info['id']; ?>">
                <div>
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo $info['username']; ?>">
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $info['email']; ?>">
                </div>
                <div>
                    <label>Phone</label>
                    <input type="tel" name="phone" value="<?php echo $info['phone']; ?>">
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" value="<?php echo $info['password']; ?>">
                </div>
                <div>
                    <center>
                        <input class="btn btn-success" type="submit" name="update" value="Update">
                    </center>
                </div>
            </form>
        </div>
    </div>
</body>
</html>