<?php
session_start();

if (!isset($_SESSION['fullname'])) {
    header("Location: ../form/signin.php");
    exit();
}

require_once '../connect/conn.php';

// Retrieve user information
$user_id = $_SESSION['user_id'];
$sql = "SELECT fullname, email, gender, nickname, Wardname FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Retrieve user reports
$sql_reports = "SELECT Rp_id, problem_discription, status FROM report_problem WHERE user_id = ?";
$stmt_reports = $conn->prepare($sql_reports);
$stmt_reports->bind_param("i", $user_id);
$stmt_reports->execute();
$reports_result = $stmt_reports->get_result();
$reports = [];
while ($row = $reports_result->fetch_assoc()) {
    $reports[] = $row;
}
$stmt_reports->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <!-- <link rel="stylesheet" href="page.css"> -->
    <link rel="stylesheet" href="dash.css">
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
                <?php if (isset($_SESSION['fullname'])) { ?>
                <li class="navlinks"><a href="../form/signout.php" class="pac">Sign out
                        (<?= htmlspecialchars($_SESSION['fullname']) ?>)</a></li>
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

    <div class="dashboard">
        <div class="card-conten">
            <div class="card-inf">
                <div class="user-profile">
                    <h2 class="user">User Profile</h2>
                    <p><strong>Full Name:</strong> <?= htmlspecialchars($user['fullname']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                    <p><strong>Gender:</strong> <?= htmlspecialchars($user['gender']) ?></p>
                    <p><strong>Nickname:</strong> <?= htmlspecialchars($user['nickname']) ?></p>
                    <p><strong>Ward Name:</strong> <?= htmlspecialchars($user['Wardname']) ?></p>
                </div>

                <div class="user-input">
                    <h2 class="user">Change Password</h2>
                    <form action="change_password.php" method="post">
                        <label for="current_password">Current Password:</label>
                        <input type="password" id="current_password" name="current_password" required>
                        <label for="new_password">New Password:</label>
                        <input type="password" id="new_password" name="new_password" required>
                        <label for="confirm_password">Confirm New Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                        <button type="submit">Change Password</button>
                    </form>
                </div>

                <div class="user-reports">
                    <h2 class="user">Your Reports</h2>
                    <div class="add-button">
                        <a href="Report.php">Report a problem</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reports as $report) { ?>
                            <tr>
                                <td><?= htmlspecialchars($report['problem_discription']) ?></td>
                                <td><?= htmlspecialchars($report['status']) ?></td>
                                <td>
                                    <a href="edit_report.php?Rp_id=<?= $report['Rp_id'] ?>">Edit</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
