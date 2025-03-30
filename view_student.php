<?php
session_start();

if (!isset($_SESSION['Username']) || !isset($_SESSION['usertype']) || $_SESSION['usertype'] !== 'admin') {
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

$sql = "SELECT * FROM users WHERE usertype='student'";
$result = mysqli_query($data, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($data));
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
            font-size: 15px;
            background-color: #333;
            color: white;
        }

        .table_td {
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        .btn {
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn:hover {
            opacity: 0.8;
        }

        .content {
            margin-left: 250px; 
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            text-align: center;
        }
    </style>
</head>
<body>

    <?php include 'admin_sidebar.php'; ?>

    <div class="content">
        <h1>Student Data</h1>

        <table>
            <tr>
                <th class="table_th">Username</th>
                <th class="table_th">Email</th>
                <th class="table_th">Phone</th>
                <th class="table_th">Delete</th>
                <th class="table_th">Update</th>
                <th class="table_th">Add Results</th>
            </tr>

            <?php
            while ($info = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td class="table_td"><?php echo htmlspecialchars($info['username']); ?></td>
                    <td class="table_td"><?php echo htmlspecialchars($info['email']); ?></td>
                    <td class="table_td"><?php echo htmlspecialchars($info['phone']); ?></td>
                    <td class="table_td">
                        <a class='btn btn-danger' href='delete.php?student_id=<?php echo $info['id']; ?>' onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                    </td>
                    <td class="table_td">
                        <a class='btn btn-primary' href='Update_student.php?student _id=<?php echo $info['id']; ?>'>Update</a>
                    </td>
                    <td class="table_td">
                        <a class='btn btn-success' href='add_results.php?student_id=<?php echo $info['id']; ?>'>Add Results</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>