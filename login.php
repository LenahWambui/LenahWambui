<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body background="briko.jpeg" class="body_deg">
    <center>
        <div class="form_deg">
            <center class="title_deg">
                Login Form
                <h4>
                    <?php
                    session_start(); 
                    error_reporting(E_ALL); 
                    echo isset($_SESSION['loginmessage']) ? $_SESSION['loginmessage'] : '';
                    ?>
                </h4>
            </center>

            <form action="login_check.php" method="POST" class="login_form">
                <div>
                    <label class="label_deg">Username</label>
                    <input type="text" name="Username" required>
                </div>

                <div>
                    <label class="label_deg">Password</label>
                    <input type="password" name="Password" required>
                </div>

                <div>
                    <input class="btn btn-primary" type="submit" name="submit" value="Login">
                </div>
            </form>
        </div>
    </center>
</body>
</html>