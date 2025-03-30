<?php
session_start();
error_reporting(0);

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

if (!$data) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_GET['teacher_id'])) {
    $t_id = mysqli_real_escape_string($data, $_GET['teacher_id']);
    $sql = "SELECT * FROM teacher WHERE id='$t_id'";
    $result = mysqli_query($data, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $info = mysqli_fetch_assoc($result);
    } else {
        echo "Error: Teacher not found.";
        exit();
    }
} else {
    echo "Error: No teacher ID provided.";
    exit();
}

if (isset($_POST['update_teacher'])) {
    $id = mysqli_real_escape_string($data, $_POST['id']);
    $t_name = mysqli_real_escape_string($data, $_POST['name']);
    $t_des = mysqli_real_escape_string($data, $_POST['description']);
    
    $dst_db = $info['image']; 
    if ($_FILES['image']['name'] != "") {
        $file = $_FILES['image']['name'];
        $dst = "./image/" . $file;
        $dst_db = "image/" . $file; 
        move_uploaded_file($_FILES['image']['tmp_name'], $dst);
    }

    $sql2 = "UPDATE teacher SET name='$t_name', description='$t_des', image='$dst_db' WHERE id='$id'";
    $result2 = mysqli_query($data, $sql2);

    if ($result2) {
        echo "Update successful.";
    } else {
        echo "Error updating teacher data: " . mysqli_error($data);
    }
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
         width: 150px;
         text-align: right;
         padding-top: 10px;
         padding-bottom: 10px;
       }
       .form_deg {
         background-color: skyblue;
         width: 600px;
         padding-top: 70px;
         padding-bottom: 70px;
       }
    </style>
</head>
<body>
    
    <!-- Include admin sidebar -->
    <?php include 'admin_sidebar.php'; ?>
    
    <div class="content">
       <h1>Update All Teachers Data</h1>
       <form class="form_deg" action="#" method="POST" enctype="multipart/form-data">
         <input type="hidden" name="id" value="<?php echo htmlspecialchars($info['id']); ?>">
          <div>
             <label>Teacher Name </label>
             <input type="text" name="name" value="<?php echo htmlspecialchars($info['name']); ?>">
          </div>
          <div>
             <label>About Teacher</label>
             <textarea name="description"><?php echo htmlspecialchars($info['description']); ?></textarea>
          </div>
          <div>
             <label>Teacher Old Image</label>
             <img width="100px" height="100px" src="<?php echo htmlspecialchars($info['image']); ?>">
          </div>
          <div>
             <label>Teacher New Image</label>
             <input type="file" name="image">
          </div>
          <center>
          <div>
             <input type="submit" name="update_teacher" class="btn btn-success">
          </div></center>
       </form>
    </div>
</body>
</html>