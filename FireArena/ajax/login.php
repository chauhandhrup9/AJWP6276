<?php

require_once(__DIR__ . "/../config/database.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../login.php");
    exit();
}

/* ==================================================
   1. Receive Form Data
================================================== */

$login_id = trim($_POST['login_id']);
$password = $_POST['password'];

/* ==================================================
   2. Empty Validation
================================================== */

if (empty($login_id) || empty($password)) {
    header("Location: ../login.php?error=All fields are required.");
    exit();
}

/* ==================================================
   3. Find User
   Login using Username / Email / Mobile
================================================== */

$sql = "SELECT * FROM users
        WHERE username = ?
        OR email = ?
        OR mobile = ?
        LIMIT 1";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Prepare failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "sss",
    $login_id,
    $login_id,
    $login_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {

    mysqli_stmt_close($stmt);

    header("Location: ../login.php?error=Invalid login credentials.");

    exit();
}

$user = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

/* ==================================================
   4. Verify Password
================================================== */

if (!password_verify($password, $user['password'])) {

    header("Location: ../login.php?error=Invalid login credentials.");

    exit();
}

/* ==================================================
   5. Account Status Check
================================================== */

if ($user['account_status'] !== "active") {

    header("Location: ../login.php?error=Your account is not active.");

    exit();
}

/* ==================================================
   6. Start Secure Session
================================================== */

session_start();

session_regenerate_id(true);

/* ==================================================
   7. Store Session Variables
================================================== */

$_SESSION['user_id'] = $user['id'];
$_SESSION['player_id'] = $user['player_id'];
$_SESSION['full_name'] = $user['full_name'];
$_SESSION['username'] = $user['username'];
$_SESSION['email'] = $user['email'];
$_SESSION['mobile'] = $user['mobile'];
$_SESSION['role'] = $user['role'];
$_SESSION['profile_photo'] = $user['profile_photo'];
$_SESSION['login_time'] = time();

/* ==================================================
   8. Redirect According to Role
================================================== */

switch ($user['role']) {

    case "player":
        header("Location: ../user/dashboard.php");
        break;

    case "admin":
        header("Location: ../admin/dashboard.php");
        break;

    case "sub_admin":
        header("Location: ../subadmin/dashboard.php");
        break;

    default:
        session_destroy();
        header("Location: ../login.php?error=Invalid user role.");
        break;
}

exit();