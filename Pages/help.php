<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="page.css">
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
                    <li class="navlinks"><a href="../form/signout.php" class="pac">Sign out (<?= $_SESSION['fullname'] ?>)</a></li>
                    <li class="navlinks"><a href="Dashboard.php" class="pac">Dashboard</a></li>
                    <?php
                } else{
                
                    ?>
                    <li class="navlinks"><a href="../form/signin.php" class="pac">Sign in</a></li>
                <?php } ?>

               
                <li class="navlinks"><a href="all_Reports.php" class="pac"> All reports</a></li>
                <li class="navlinks"><a href="Local_alerts.php" class="pac">Local alerts</a></li>
                <li class="navlinks"><a href="help.php" class="pac">Help</a></li>
            </div>
        </div>

    </div>


</body>
</html>