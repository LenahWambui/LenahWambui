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

$sql = "SELECT * FROM teacher";
$result = mysqli_query($data, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($data));
}

if (isset($_GET['teacher_id'])) {
    $t_id = $_GET['teacher_id'];
    $sql2 = "DELETE FROM teacher WHERE id='$t_id'";

    $result2 = mysqli_query($data, $sql2);

    if ($result2) {
        header('Location:admin_view_teacher.php');
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
        .table_th {
            padding: 20px;
            font-size: 20px;
            background-color: #f2f2f2; 
        }

        .table_td {
            padding: 20px;
            background-color: skyblue;
        }

        table {
            border-collapse: collapse; 
            width: 100%; 
        }

        th, td {
            border: 1px solid black; 
        }
    </style>
</head>
<body>
    
    <?php include 'admin_sidebar.php'; ?>
    
    <div class="content">
        <h1>View All Teachers Data</h1>
        <table border="1"> 
            <tr>
                <th class="table_th">Teacher Name</th>
                <th class="table_th">About Teacher</th>
                <th class="table_th">Image</th>
                <th class="table_th">Delete</th>
                 <th class="table_th">Update</th>
            </tr>
            <?php
                while ($info = $result->fetch_assoc()) {
            ?>
            <tr>
                <td class="table_td"><?php echo htmlspecialchars($info['name']); ?></td>
                <td class="table_td"><?php echo htmlspecialchars($info['description']); ?></td>
                <td class="table_td"><img height="100px" width="100px" src="<?php echo htmlspecialchars($info['image']); ?>" alt="Teacher Image"></td>
                <td class="table_td">
                    <a class='btn btn-danger' href='admin_view_teacher.php?teacher_id=<?php echo $info['id']; ?>'>Delete</a>
                </td>
                <td  class="table_td">
                    <?php
                    echo"
                    <a href=' admin_update_teacher.php?teacher_id={$info['id']}' class='btn btn-primary'>Update</a>";
                    ?>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
    
</body>
</html>