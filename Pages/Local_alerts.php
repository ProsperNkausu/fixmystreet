<?php
session_start();

if (!isset($_SESSION['fullname']) || !isset($_SESSION['role'])) {
    header("Location: ../form/signin.php");
    exit();
}

require_once '../connect/conn.php';

$reports_sql = "SELECT Rp_id, problem_discription, date FROM report_problem ORDER BY date DESC";
$reports_result = $conn->query($reports_sql);

function getComments($conn, $report_id) {
    $comments_sql = "
        SELECT c.comment, c.created_at, u.fullname as user_fullname, a.username as admin_username 
        FROM comments c 
        LEFT JOIN users u ON c.user_id = u.user_id 
        LEFT JOIN admin a ON c.admin_id = a.u_id 
        WHERE c.report_id = ? 
        ORDER BY c.created_at ASC";
    $stmt = $conn->prepare($comments_sql);
    $stmt->bind_param("i", $report_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

if (isset($_POST['submit_comment'])) {
    $report_id = $_POST['report_id'];
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;

    // Determine which ID to use (user or admin)
    if ($user_id) {
        $insert_comment_sql = "INSERT INTO comments (report_id, user_id, comment, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($insert_comment_sql);
        $stmt->bind_param("iis", $report_id, $user_id, $comment);
    } elseif ($admin_id) {
        $insert_comment_sql = "INSERT INTO comments (report_id, admin_id, comment, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($insert_comment_sql);
        $stmt->bind_param("iis", $report_id, $admin_id, $comment);
    }

    $stmt->execute();
    $stmt->close();
    header("Location: Local_alerts.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="page.css">
    <title>FixMyStreet</title>
    <style>
        .main_alerts {
            padding: 20px;
            width: 40%; 
            margin-left: 25%;
            margin-right: 25%;
        }

        .alert-conten {
            width: 100%;
            margin-top: 50px;
        }

        .card-comment {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .title-comment h1 {
            margin: 0 0 10px 0;
        }

        .comments-section {
            margin-top: 10px;
        }

        .section-comment {
            margin-bottom: 10px;
        }

        .comment-form textarea {
            width: 40%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .comment-form button {
            margin-bottom: 50px;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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

        @media screen and (max-width: 768px) {
            .main_alerts {
                width: 90%;
                margin: 0 auto;
            }

            .comment-form textarea {
                width: 90%;
            }
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
                <?php if (isset($_SESSION['fullname']) || isset($_SESSION['role'])) { ?>
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

    <div class="main_alerts">
        <div class="title">
            <h1>Discussion of Reports</h1>
            <hr>
        </div>
        <div class="alert-conten">
            <?php if ($reports_result->num_rows > 0) { ?>
            <?php while ($report = $reports_result->fetch_assoc()) { ?>
            <div class="card-comment">
                <div class="title-comment">
                    <h1>Report #<?= htmlspecialchars($report['Rp_id']) ?></h1>
                    <p>Date: <?= htmlspecialchars($report['date']) ?></p>
                    <p class="problem_discription"><?= htmlspecialchars($report['problem_discription']) ?></p>
                </div>

                <div class="comments-section">
                    <h2>Comments</h2>
                    <?php
                            $comments_result = getComments($conn, $report['Rp_id']);
                            if ($comments_result->num_rows > 0) {
                                while ($comment = $comments_result->fetch_assoc()) {
                                    $commenter = $comment['user_fullname'] ? $comment['user_fullname'] : $comment['admin_username'];
                                    ?>
                    <div class="section-comment">
                        <p><strong>
                                <?= htmlspecialchars($commenter) ?>:
                                <?= htmlspecialchars($comment['comment']) ?>
                            </strong>
                            <br>
                            <small><?= htmlspecialchars($comment['created_at']) ?></small>
                        </p>
                    </div>
                    <?php
                                }
                            } else {
                                echo "<p>No comments yet.</p>";
                            }
                            ?>

                </div>
            </div>

            <form method="post" class="comment-form">
                <input type="hidden" name="report_id" value="<?= $report['Rp_id'] ?>">
                <textarea name="comment" required placeholder="Add a comment"></textarea>
                <button type="submit" class="btn" name="submit_comment">Submit</button>
            </form>
            <?php } ?>
            <?php } else { ?>
            <div class='alert'><h1>No reports found</h1><p>There are no reports to display at the moment. Please check back later.</p></div>
            <?php } ?>
        </div>
    </div>
</body>

</html>
