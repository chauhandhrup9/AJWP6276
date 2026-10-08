<?php

require_once(__DIR__ . "/../config/auth.php");
require_once(__DIR__ . "/../config/database.php");

header("Content-Type: application/json");

$user_id = $_SESSION['user_id'];

$full_name = trim($_POST['full_name']);
$mobile = trim($_POST['mobile']);
$ign = trim($_POST['ign']);
$ff_uid = trim($_POST['ff_uid']);
$country = trim($_POST['country']);
$state = trim($_POST['state']);
$city = trim($_POST['city']);
$old_photo = $_POST['old_photo'];

// Basic Validation
if (
    empty($full_name) ||
    empty($mobile) ||
    empty($ign) ||
    empty($ff_uid)
) {
    echo json_encode([
        "status" => "error",
        "message" => "Please fill all required fields."
    ]);
    exit();
}

// Mobile Validation
if (!preg_match('/^[0-9]{10}$/', $mobile)) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid mobile number."
    ]);
    exit();
}

// Free Fire UID Validation (Minimum 9 digits)
if (!preg_match('/^[0-9]{9,}$/', $ff_uid)) {

    echo json_encode([
        "status" => "error",
        "message" => "Free Fire UID must contain at least 9 digits."
    ]);

    exit();
}

// Duplicate Mobile Check
$sql = "SELECT id FROM users WHERE mobile=? AND id!=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "si", $mobile, $user_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {

    echo json_encode([
        "status" => "error",
        "message" => "Mobile number already exists."
    ]);

    exit();
}

mysqli_stmt_close($stmt);

// Duplicate FF UID Check
$sql = "SELECT id FROM users WHERE ff_uid=? AND id!=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "si", $ff_uid, $user_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {

    echo json_encode([
        "status" => "error",
        "message" => "Free Fire UID already exists."
    ]);

    exit();
}

mysqli_stmt_close($stmt);

// Image Upload

$new_photo = $old_photo;

if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {

    $allowed = ['jpg', 'jpeg', 'png', 'webp'];

    $ext = strtolower(pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {

        echo json_encode([
            "status" => "error",
            "message" => "Only JPG, PNG and WEBP images are allowed."
        ]);

        exit();
    }

    if ($_FILES['profile_photo']['size'] > 2 * 1024 * 1024) {

        echo json_encode([
            "status" => "error",
            "message" => "Maximum image size is 2MB."
        ]);

        exit();
    }

    $new_photo = "FA_" . time() . "." . $ext;

    $destination = "../assets/uploads/profile/" . $new_photo;

    move_uploaded_file($_FILES['profile_photo']['tmp_name'], $destination);

    if ($old_photo != "default.png") {

        $old = "../assets/uploads/profile/" . $old_photo;

        if (file_exists($old)) {
            unlink($old);
        }

    }

}

// Update Database

$sql = "UPDATE users
SET
full_name=?,
mobile=?,
ign=?,
ff_uid=?,
profile_photo=?,
country=?,
state=?,
city=?
WHERE id=?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ssssssssi",
    $full_name,
    $mobile,
    $ign,
    $ff_uid,
    $new_photo,
    $country,
    $state,
    $city,
    $user_id
);

if (mysqli_stmt_execute($stmt)) {

    // Update Session

    $_SESSION['full_name'] = $full_name;
    $_SESSION['mobile'] = $mobile;
    $_SESSION['profile_photo'] = $new_photo;

    echo json_encode([
        "status" => "success",
        "message" => "Profile updated successfully."
    ]);

} else {

    echo json_encode([
        "status" => "error",
        "message" => "Database update failed."
    ]);

}

mysqli_stmt_close($stmt);

?>