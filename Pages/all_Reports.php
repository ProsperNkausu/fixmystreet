<?php
session_start();


include "../connect/conn.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="page.css">
    <title> All Reports</title>

    <style>
       
        

        .main-content {
            width: 60%;
            margin-top: 5%;
            background-color: white;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* margin-top: 100px; */
            font-size: 16px;
            /* background-color: #45a049; */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .alert {
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }

        .alert h1 {
            margin: 0 0 10px;
        }

        .alert p {
            margin: 0;
        }
    </style>
</head>

<body>

    <div class="nav">
    <div class="navbar">
        <div class="navlogo">
            <h1><span class="span-tag">FixMy</span>Street</h1>
        </div>
        <div class="navitems">
            <li class="navlinks"><a href="" class="pac"><span class="span-1">Report a problem</span></a></li>
            <?php if(isset($_SESSION['fullname'])) { ?>
                <li class="navlinks"><a href="../form/signout.php" class="pac">Sign out (<?= htmlspecialchars($_SESSION['fullname']) ?>)</a></li>
                <li class="navlinks"><a href="Dashboard.php" class="pac">Dashboard</a></li>
            <?php } else { ?>
                <li class="navlinks"><a href="../form/signin.php" class="pac">Sign in</a></li>
            <?php } ?>
            <li class="navlinks"><a href="all_Reports.php" class="pac">All reports</a></li>
            <li class="navlinks"><a href="Local_alerts.php" class="pac">Local alerts</a></li>
            <li class="navlinks"><a href="help.php" class="pac">Help</a></li>
        </div>
    </div>
</div>

<div class="main-content">
    <?php
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch all reports from the database
    $query = "SELECT rp.Rp_id, rp.problem_discription, rp.status, u.fullname FROM report_problem rp JOIN users u ON rp.user_id = u.user_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        echo "<table>";
        echo "<thead><tr><th>Description</th><th>Status</th><th>Reported By</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['problem_discription']) . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<div class='alert'><h1>No reports found</h1><p>There are no reports to display at the moment. Please check back later.</p></div>";
    }

    $conn->close();
    ?>
</div>

</body>

</html>