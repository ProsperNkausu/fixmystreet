<?php
session_start();
require_once '../connect/conn.php';

if(isset($_POST["Signin"])){
    $fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $hashed_password = md5($password);

    // Check if the login is for a user
    $login_user = "SELECT * FROM users WHERE fullname = '$fullname' AND password = '$hashed_password'";
    $result_user = $conn->query($login_user);

    // Check if the login is for an admin
    $login_admin = "SELECT * FROM admin WHERE username = '$fullname' AND password = '$hashed_password'";
    $result_admin = $conn->query($login_admin);

    if ($result_user->num_rows > 0) {
        $row = $result_user->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = 'user';

        if ($row['details_updated'] == 0) {
            header("Location: change.php");
        } else {
            header("Location: ../Pages/Dashboard.php");
        }
        exit();
    } elseif ($result_admin->num_rows > 0) {
        $row = $result_admin->fetch_assoc();
        $_SESSION['admin_id'] = $row['u_id'];
        $_SESSION['fullname'] = $row['username'];
        $_SESSION['role'] = 'admin';

        header("Location:../admin/Dashboard.php");
        exit();
    } else {
        echo "<script>alert('Wrong username or password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>FixMyStreet</title>
</head>
<body>
    <div class="nav">
        <div class="navbar">
            <div class="navlogo">
                <h1><span class="span-tag">FixMy</span>Street</h1>
            </div>
            <div class="navitems">
                <li class="navlinks"><a href="report_problem.php" class="pac"><span class="span-1">Report a problem</span></a></li>
                <li class="navlinks"><a href="signin.php" class="pac">Sign in</a></li>
                <li class="navlinks"><a href="../Pages/all_Reports.php" class="pac">All reports</a></li>
                <li class="navlinks"><a href="../Pages/Local_alerts.php" class="pac">Local alerts</a></li>
                <li class="navlinks"><a href="../Pages/help.php" class="pac">Help</a></li>
            </div>
        </div>
    </div>

    <div class="signin-form">
        <div class="form">
            <form method="post">
                <h1 class="title">Sign in</h1>
                <div class="sign-input">
                    <label for="">Username :</label><br>
                    <input type="text" name="fullname" required><br>
                    <label for="">Password :</label><br>
                    <input type="password" name="password" required><br>
                    <button name="Signin" class="btn">Signin</button><br><br>
                    <hr class="underline"><br>
                    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
