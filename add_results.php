<?php
session_start();

if (!isset($_SESSION['Username']) || $_SESSION['usertype'] != 'admin') {
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

$student_id = $_GET['student_id'];

$sql_username = "SELECT username FROM users WHERE id = '$student_id'";
$result_username = mysqli_query($data, $sql_username);

if (!$result_username) {
    die("Query failed: " . mysqli_error($data));
}

$row = mysqli_fetch_assoc($result_username);
$username = $row['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['subject']) && isset($_POST['score']) && isset($_POST['grade'])) {
        $subject = $_POST['subject'];
        $score = $_POST['score'];
        $grade = $_POST['grade'];

        $sql = "INSERT INTO exam_results (username, subject, score, grade) VALUES ('$username', '$subject', '$score', '$grade')";
        $result = mysqli_query($data, $sql);

        if ($result) {
            echo "<script>alert('Results added successfully!');</script>";
        } else {
            echo "<script>alert('Failed to add results: " . mysqli_error($data) . "');</script>";
        }
    } else {
        echo "<script>alert('Please fill all the fields.');</script>";
    }
}


$sql_results = "SELECT id, subject, score, grade FROM exam_results WHERE username='$username'";
$result_results = mysqli_query($data, $sql_results);

if (!$result_results) {
    die("Query failed: " . mysqli_error($data));
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM exam_results WHERE id='$delete_id'";
    if (mysqli_query($data, $sql_delete)) {
        echo "<script>alert('Record deleted successfully!');</script>";
    } else {
        echo "<script>alert('Failed to delete record: " . mysqli_error($data) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Exam Results</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Add Exam Results for Student: <?php echo htmlspecialchars($username); ?></h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="score">Score:</label>
                <input type="number" class="form-control" id="score" name="score" required>
            </div>
            <div class="form-group">
                <label for="grade">Grade:</label>
                <input type="text" class="form-control" id="grade" name="grade" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <h3 class="mt-5">Existing Exam Results</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Score</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row_result = mysqli_fetch_assoc($result_results)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row_result['subject']); ?></td>
                        <td><?php echo htmlspecialchars($row_result['score']); ?></td>
                        <td><?php echo htmlspecialchars($row_result['grade']); ?></td>
                        <td>
                            <a href="?student_id=<?php echo $student_id; ?>&delete_id=<?php echo $row_result['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>