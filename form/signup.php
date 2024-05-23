<?php
require_once '../connect/conn.php';

if(isset($_POST["Signup"])){
    $fullname = $_POST ["fullname"];
    $email = $_POST ["email"];
    $password = $_POST ["password"];
    $password = md5($password);
    $gender = $_POST["gender"];
    $nickname = $_POST["nickname"];
    $Wardname = $_POST["Wardname"];

    $checkEmail = "SELECT * From users where email= '$email'";
    $result=$conn->query($checkEmail);
    if($result->num_rows>0){
        echo "<script> alert('Email Already exist') </script>";

    }
    else{
        $insertQuery= "INSERT INTO users(fullname,email,password,gender,nickname,wardname) VALUES ('$fullname', '$email', '$password', '$gender', '$nickname', '$Wardname')";

        if ($conn->query($insertQuery)== TRUE){
           echo "<script>
                alert('Signup successful');
                window.location.href = 'signin.php';
            </script>";
        }
        else {
            echo "error";
        }
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
                    <div></div>
                    <?php
                } else{
                
                    ?>
                    <li class="navlinks"><a href="signin.php" class="pac">Sign in</a></li>
                <?php } ?>

               
                <li class="navlinks"><a href="Pages/all_Reports.php" class="pac"> All reports</a></li>
                <li class="navlinks"><a href="Pages/Local_alerts.php" class="pac">Local alerts</a></li>
                <li class="navlinks"><a href="Pages/help.php" class="pac">Help</a></li>
            </div>
        </div>

    </div>

    <div class="signin-form">
        <div class="form">

            <form method="post">
                <h1 class="title">
                    Sign up
                </h1>

                <div class="sign-input">
                    <label for="">Fullname :</label>
                    <br>
                    <input type="name" name="fullname" required>

                    <br>

                    <label for="">Password :</label>
                    <br>
                    <input type="password" name="password" required>

                    <br>

                    <label for="">Email :</label>
                    <br>
                    <input type="email" name="email" required>

                    <br>

                    <label for="">Gender :</label>
                    <select name="gender" required>
                        <option value="" selected hidden>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>

                    <br>

                    <label for="">Nickname :</label>
                    <br>
                    <input type="text" name="nickname" required>
                    <br>
                    <label for="">Wardname :</label>
                    <br>
                    <input type="text" name="Wardname" required>
                </div>

                <button name="Signup" class="btn">Sign up</button>
            </form>

            <br>
            
            <hr class="underline">
            <br>
            <p>Already have an account ? <a href="signin.php">Sign in</a></p>
        </div>

    </div>
</body>

</html>