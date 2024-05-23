<?php
session_start();

include "../connect/conn.php"; // Include database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $problem_category = $_POST['problem_category'];
    $custom_category = $_POST['custom_category'];
    $image_1 = $_FILES['image_1']['name'];
    $image_2 = $_FILES['image_2']['name'];
    $image_3 = $_FILES['image_3']['name'];

    // Insert report data into the database
    $sql = "INSERT INTO report_problem (user_id, pro_idd, problem_discription, image_1, image_2, image_3, status, date) 
            VALUES (?, ?, ?, ?, ?, ?, 'Pending', NOW())";
    $stmt = $conn->prepare($sql);
    $user_id = $_SESSION['user_id'];

    // Determine pro_idd based on problem_category
    if ($problem_category == 'custom') {
        $pro_idd = null;
    } else {
        $pro_idd = $problem_category;
    }

    // Bind parameters to the statement
    $stmt->bind_param("iissss", $user_id, $pro_idd, $custom_category, $image_1, $image_2, $image_3);

    // Execute the statement
    if ($stmt->execute()) {
        // Upload images to server
        $target_dir = "uploads/";
        move_uploaded_file($_FILES["image_1"]["tmp_name"], $target_dir . $image_1);
        move_uploaded_file($_FILES["image_2"]["tmp_name"], $target_dir . $image_2);
        move_uploaded_file($_FILES["image_3"]["tmp_name"], $target_dir . $image_3);

        // Redirect to dashboard
        header("Location: Dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Retrieve problem categories from the database
$sql_categories = "SELECT * FROM problem_category";
$result_categories = $conn->query($sql_categories);
$categories = $result_categories->fetch_all(MYSQLI_ASSOC);
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

    <div class="report-form">
        <h2>Report a Problem</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <label for="problem_category">Select Problem Category:</label>
            <select id="problem_category"  name="problem_category">
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category['Pro_id'] ?>"><?= $category['Problem_name'] ?></option>
                <?php } ?>
                <option selected hidden value="custom">Custom</option> <!-- Assuming custom category option -->
            </select>
            <label for="custom_category"> Enter Problem Discription :</label>
            <input type="text" id="custom_category" required name="custom_category">
            <label for="image_1">Upload Image 1:</label>
            <input type="file" id="image_1" name="image_1" required accept="image/*">
            <label for="image_2">Upload Image 2:</label>
            <input type="file" id="image_2" name="image_2" required accept="image/*">
            <label for="image_3">Upload Image 3:</label>
            <input type="file" id="image_3" name="image_3" required accept="image/*">
            <button type="submit">Submit Report</button>
        </form>
    </div>

</body>
</html>
