<?php
session_start();

if (!isset($_SESSION['fullname']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../form/signin.php");
    exit();
}

require_once '../connect/conn.php';

// Fetch reports
$reports_sql = "SELECT * FROM report_problem ORDER BY date DESC";
$reports_result = $conn->query($reports_sql);

// Fetch provinces
$provinces_sql = "SELECT P_id, Province_name FROM province";
$provinces_result = $conn->query($provinces_sql);

// Fetch districts
$districts_sql = "SELECT district_id, district_name FROM district";
$districts_result = $conn->query($districts_sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_district'])) {
    $province = mysqli_real_escape_string($conn, $_POST['province']);
    $district_name = mysqli_real_escape_string($conn, $_POST['district_name']);
    $insert_district_sql = "INSERT INTO district (P_idd, district_name) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_district_sql);
    $stmt->bind_param("is", $province, $district_name);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_ward'])) {
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $ward_name = mysqli_real_escape_string($conn, $_POST['ward_name']);
    $insert_ward_sql = "INSERT INTO ward (dd_idd, ward_name) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_ward_sql);
    $stmt->bind_param("is", $district, $ward_name);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_report'])) {
    $report_id = $_POST['report_id'];
    $delete_report_sql = "DELETE FROM report_problem WHERE Rp_id = ?";
    $stmt = $conn->prepare($delete_report_sql);
    $stmt->bind_param("i", $report_id);
    $stmt->execute();
    $stmt->close();
    header("Location: Dashboard.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../Pages/page.css">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            
        }

         .container {
            color: white;
            padding: 20px;
            max-width: 1200px;
            min-width: 50%;
            margin: 0 auto;
            
        }

        .card {
            color: black;
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            margin-top: 40px;
            width: 100%;
            margin-left: 15%;
            margin-right: 15%;
            justify-content: center;
        }

        form {
            margin-top: 20px;
            margin-bottom: 20px;
            width: 70%;
            color: black;
            background-color: #f9f9f9;
            padding: 20px;
        }

        #district_name,
        #ward_name {
            width: 97.5%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #555;
        }

        table {
                font-size: 12px;
            width: 88%;
            border-collapse: collapse;
            margin-top: 40px;
            table-layout: fixed; 
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            word-wrap: break-word;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .delete-button {
            background-color: #ff4d4d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #ff1a1a;
        }

        .image-container img {
            max-width: 100px;
            height: auto;
            display: block; 
            margin: 0 auto; 
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
                <li class="navlinks"><a href="Dashboard.php" class="pac">Dashboard</a></li>
                <li class="navlinks"><a href="comments.php" class="pac">View Discussions</a></li>
                <?php if (isset($_SESSION['role'])) { ?>
                    <li class="navlinks"><a href="../form/signout.php" class="pac">Sign out (<?= htmlspecialchars($_SESSION['role']) ?>)</a></li>
                <?php } else { ?>
                    <li class="navlinks"><a href="../form/signin.php" class="pac">Sign in</a></li>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="form-section">
            <h2>Add District</h2>
            <form method="post">
                <div class="form-group">
                    <label for="province">Select Province</label>
                    <select name="province" id="province" required>
                        <option value="">Select Province</option>
                        <?php if ($provinces_result->num_rows > 0) {
                            while ($province = $provinces_result->fetch_assoc()) { ?>
                                <option value="<?= htmlspecialchars($province['province_id']) ?>"><?= htmlspecialchars($province['province_name']) ?></option>
                            <?php }
                        } else { ?>
                            <option value="">No provinces found</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="district_name">District Name</label>
                    <input type="text" name="district_name" id="district_name" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit_district">Add District</button>
                </div>
            </form>

            <h2>Add Ward</h2>
            <form method="post">
                <div class="form-group">
                    <label for="district">Select District</label>
                    <select name="district" id="district" required>
                        <option value="">Select District</option>
                        <?php if ($districts_result->num_rows > 0) {
                            while ($district = $districts_result->fetch_assoc()) { ?>
                                <option value="<?= htmlspecialchars($district['district_id']) ?>"><?= htmlspecialchars($district['district_name']) ?></option>
                            <?php }
                        } else { ?>
                            <option value="">No districts found</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ward_name">Ward Name</label>
                    <input type="text" name="ward_name" id="ward_name" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit_ward">Add Ward</button>
                </div>
            </form>
        </div>

        <h2>Manage Reports</h2>
        <table>
            <thead>
                <tr>
                    <th>Report ID</th>
                    <th>User ID</th>
                    <th>Province ID</th>
                    <th>Description</th>
                    <th>Image 1</th>
                    <th>Image 2</th>
                    <th>Image 3</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($reports_result->num_rows > 0) {
    // Output data of each row
    while ($report = $reports_result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($report['Rp_id']) . "</td>";
        echo "<td>" . htmlspecialchars($report['user_id']) . "</td>";
        echo "<td>" . htmlspecialchars($report['pro_idd']) . "</td>";
        echo "<td>" . htmlspecialchars($report['problem_discription']) . "</td>";
        echo "<td class='image-container'><img src='" . htmlspecialchars($report['image_1']) . "' alt='Image 1'></td>";
        echo "<td class='image-container'><img src='" . htmlspecialchars($report['image_2']) . "' alt='Image 2'></td>";
        echo "<td class='image-container'><img src='" . htmlspecialchars($report['image_3']) . "' alt='Image 3'></td>";
        echo "<td>" . htmlspecialchars($report['status']) . "</td>";
        echo "<td>" . htmlspecialchars($report['date']) . "</td>";
        echo "<td><button class='delete-button'>Delete</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='10'>No reports found.</td></tr>";
} ?>
            </tbody>
        </table>
    </div>
</body>

</html>
