<?php
session_start();

if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
} 
elseif (!isset($_SESSION['usertype']) || $_SESSION['usertype'] == 'student') {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";

$data = mysqli_connect($host, $user, $password, $db);

if (isset($_POST['add_teacher'])) {
    $t_name = $_POST['name'];
    $t_description = $_POST['description'];
    $file = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];

    $dst = "./image/" . $file;
    $dst_db = "image/" . $file;

    if (move_uploaded_file($file_tmp, $dst)) {
        $sql = "INSERT INTO teacher (name, description, image) VALUES ('$t_name', '$t_description', '$dst_db')";
        $result = mysqli_query($data, $sql);

        if ($result) {
            echo "<script>alert('Teacher added successfully!');</script>";
        } else {
            echo "<script>alert('Failed to add teacher!');</script>";
        }
    } else {
        echo "<script>alert('Failed to upload image!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <style type="text/css">
       .div_deg {
         background-color: skyblue;
         padding-top: 70px;
         padding-bottom: 70px;
         width: 500px;
       }
    </style>

    <?php include 'admin_css.php'; ?>
</head>
<body>
    
    <?php include 'admin_sidebar.php'; ?>
    
    <div class="content">
       <h1>Add Teacher</h1><br><br>
       <div class="div_deg">
          <form action="#" method="POST" enctype="multipart/form-data">
             <div>
                <label>Teacher Name</label>
                <input type="text" name="name" required>
             </div>
             <br>
             <div>
                <label>Description</label>
                <textarea name="description" required></textarea>
             </div>
             <br>
             <div>
                <label>Image</label>
                <input type="file" name="image" accept="image/*" required>
             </div>
             <br>
             <div>
                <input type="submit" name="add_teacher" value="Add Teacher" class="btn btn-success">
             </div>
          </form>
       </div>
    </div>
    
</body>
</html>