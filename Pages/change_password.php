<?php
session_start();
require_once '../connect/conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../form/signin.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password != $confirm_password) {
        echo "New passwords do not match.";
        exit();
    }

    $sql = "SELECT password FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!password_verify($current_password, $user['password'])) {
        echo "Current password is incorrect.";
        exit();
    }

    $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
    $sql_update = "UPDATE users SET password = ? WHERE user_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("si", $new_password_hashed, $user_id);
    $stmt_update->execute();
    $stmt_update->close();

    echo "Password changed successfully.";
    header("Location: Dashboard.php");
}

$conn->close();
?>
