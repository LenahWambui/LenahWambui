<?php
session_start();
error_reporting(E_ALL);

if (!isset($_SESSION['Username'])) {
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

$username = $_SESSION['Username'];

$sql = "SELECT * FROM students WHERE username='$username'";
$result = mysqli_query($data, $sql);

if (!$result) {
    die("SQL query failed: " . mysqli_error($data));
}

$info = [];

if (mysqli_num_rows($result) > 0) {
    $info = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($data, $_POST['name']);
    $email = mysqli_real_escape_string($data, $_POST['email']);
    $phone = mysqli_real_escape_string($data, $_POST['phone']);

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 10]);
    } else {
        $password = $info['password'];
    }

    $sql2 = "UPDATE students SET username='$name', email='$email', phone='$phone', password='$password' WHERE username='$username'";
    $result2 = mysqli_query($data, $sql2);

    if ($result2) {
        $sql3 = "UPDATE users SET username='$name', email='$email', phone='$phone', password='$password' WHERE username='$username'";
        $result3 = mysqli_query($data, $sql3);

        if ($result3) {
            echo "<script>
                    alert('Profile updated successfully.');
                    window.location.href = 'studenthome.php'; // Refresh the page
                  </script>";
        } else {
            echo "<script>alert('Error updating profile in users table: " . mysqli_error($data) . "');</script>";
        }
    } else {
        echo "<script>alert('Error updating profile in students table: " . mysqli_error($data) . "');</script>";
    }
}

$sql_results = "SELECT subject, score, grade FROM exam_results WHERE username='$username'";
$result_results = mysqli_query($data, $sql_results);

$exam_results = [];

if ($result_results && mysqli_num_rows($result_results) > 0) {
    while ($row = mysqli_fetch_assoc($result_results)) {
        $exam_results[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding: 10px 0;
        }
        .div_deg {
            background-color: skyblue;
            width: 500px;
            padding: 70px 0;
            margin: auto;
            border-radius: 10px;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .btn-success {
            margin-top: 20px;
        }
        .navbar {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-align: center;
            width:  100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }
        .navbar a:hover {
            color: #ddd;
        }
        .logout {
            float: right;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 60px; 
            left: 0;
            background-color: #444;
            padding-top: 20px;
            z-index: 999;
        }
        .sidebar a {
            padding: 10px 15px; 
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575757;
        }
        .main-content {
            margin-left: 250px; 
            margin-top: 60px; 
            padding: 20px;
        }
        .exam-results-table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        .exam-results-table th, .exam-results-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .exam-results-table th {
            background-color: #333;
            color: white;
        }
        .exam-results-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .exam-results-table tr:hover {
            background-color: #ddd;
        }
        #exam_results {
            margin-top: 50px; 
        }
        .print-button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1><a href="">Student Dashboard</a></h1>
        <div class="logout">
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </nav>

    <div class="sidebar">
        <a href="#profile">Update Profile</a>
        <a href="#exam_results">My Exams</a>
    </div>

    <div class="main-content">
        <div class="content" id="profile">
            <form method="POST" action="studenthome.php">
                <div class="div_deg">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo isset($info['username']) ? htmlspecialchars($info['username']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo isset($info['email']) ? htmlspecialchars($info['email']) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" id="phone" name="phone" value="<?php echo isset($info['phone']) ? htmlspecialchars($info['phone']) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Leave blank to keep current password">
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-success" name="update_profile" value="Update Profile">
                    </div>
                </div>
            </form>
        </div>

        <div class="content" id="exam_results" style="display: none;">
            <h1>My Exams</h1>
            <p>Here are your exam results:</p>
            <table class="exam-results-table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Score</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($exam_results as $result): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($result['subject']); ?></td>
                            <td><?php echo htmlspecialchars($result['score']); ?></td>
                            <td><?php echo htmlspecialchars($result['grade']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button class="btn btn-primary print-button" onclick="printExamResults()">Print Results</button>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#profile').show();
            $('#exam_results').hide();

            $('.sidebar a').on('click', function(e) {
                e.preventDefault();
                var target = $(this).attr('href');
                $('.content').hide();
                $(target).show();
            });
        });

        function printExamResults() {
            window.print();
        }
    </script>
</body>
</html>