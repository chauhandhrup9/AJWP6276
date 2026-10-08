<?php

require_once(__DIR__."/../config/auth.php");
require_once(__DIR__."/../config/database.php");

header("Content-Type: application/json");

$user_id = $_SESSION['user_id'];

$current_password = trim($_POST['current_password']);
$new_password = trim($_POST['new_password']);
$confirm_password = trim($_POST['confirm_password']);

if (
    empty($current_password) ||
    empty($new_password) ||
    empty($confirm_password)
) {

    echo json_encode([
        "status" => "error",
        "message" => "All fields are required."
    ]);
    exit();
}

// Minimum 8 characters
if (strlen($new_password) < 8) {

    echo json_encode([
        "status" => "error",
        "message" => "Password must be at least 8 characters."
    ]);
    exit();
}

// Confirm Password
if ($new_password !== $confirm_password) {

    echo json_encode([
        "status" => "error",
        "message" => "Confirm password does not match."
    ]);
    exit();
}

// Get Current Password Hash
$sql = "SELECT password FROM users WHERE id=? LIMIT 1";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $user_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

// Verify Current Password
if (!password_verify($current_password, $user['password'])) {

    echo json_encode([
        "status" => "error",
        "message" => "Current password is incorrect."
    ]);
    exit();
}

// Don't allow same password
if (password_verify($new_password, $user['password'])) {

    echo json_encode([
        "status" => "error",
        "message" => "New password cannot be the same as the current password."
    ]);
    exit();
}

// Hash New Password
$new_hash = password_hash($new_password, PASSWORD_DEFAULT);

// Update Password
$sql = "UPDATE users SET password=? WHERE id=?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "si", $new_hash, $user_id);

if (mysqli_stmt_execute($stmt)) {

    echo json_encode([
        "status" => "success",
        "message" => "Password changed successfully."
    ]);

} else {

    echo json_encode([
        "status" => "error",
        "message" => "Failed to update password."
    ]);

}

mysqli_stmt_close($stmt);

mysqli_close($conn);

?>