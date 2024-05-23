<?php 
session_start();
include_once "../connect/conn.php";

if(!isset($_SESSION['user_id'])){
    header("Location: signin.php");
    exit();
}

if(isset($_POST["Update"])){
    $nickname = mysqli_real_escape_string($conn, $_POST["nickname"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $hashed_password = md5($password);

    $user_id = $_SESSION['user_id'];

    $UpdateQuery = "UPDATE users SET nickname = '$nickname', password = '$hashed_password', details_updated = 1 WHERE user_id = '$user_id'";
    $query_run = mysqli_query($conn, $UpdateQuery);
    
    if($query_run){
        header("Location: ../Pages/Dashboard.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
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
                <li class="navlinks"><a href="" class="pac"><span class="span-1">Report a problem</span></a></li>



                <?php 
                if(isset($_SESSION['fullname'])) {
                    ?>
                <li class="navlinks"><a href="signout.php" class="pac">Sign out (<?= $_SESSION['fullname'] ?>)</a></li>
                <?php
                } else{
                
                    ?>
                <li class="navlinks"><a href="form/signin.php" class="pac">Sign in</a></li>
                <?php } ?>


                <li class="navlinks"><a href="../Pages/all_Reports.php" class="pac"> All reports</a></li>
                <li class="navlinks"><a href="../Pages/Local_alerts.php" class="pac">Local alerts</a></li>
                <li class="navlinks"><a href="../Pages/help.php" class="pac">Help</a></li>
            </div>
        </div>

    </div>

    <div class="signin-form">
        <div class="form">
            <form method="post">
                <h1 class="title">Change Username and Password</h1>
                <div class="sign-input">
                    <label for="nickname">Nickname :</label><br>
                    <input type="text" name="nickname" placeholder="Enter your nickname" required><br>
                    <label for="password">Password :</label><br>
                    <input type="password" name="password" placeholder="Enter your new password" required><br>
                    <button name="Update" class="btn">Change</button><br><br>
                </div>
            </form>
        </div>
    </div>
</body>

</html>