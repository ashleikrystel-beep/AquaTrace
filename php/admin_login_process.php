<?php
session_start();
include "../db/database.php";

$error = "";

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare SQL
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = 'admin'");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
            $_SESSION['admin_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

            header("Location: ../dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password.";
            header("location: ../loginsignup.php?form=admin&error=Invalid+credentials");
        }
    } else {
        $error = "Invalid username or password.";
        header("location: ../loginsignup.php?form=admin&error=Invalid+credentials");
    }
}
?>