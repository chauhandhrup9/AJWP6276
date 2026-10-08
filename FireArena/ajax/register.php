


<?php

require_once(__DIR__ . "/../config/database.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../register.php");
    exit();
}


// Receive Form Data
$full_name = trim($_POST['full_name']);
$username = strtolower(trim($_POST['username']));
$email = strtolower(trim($_POST['email']));
$mobile = trim($_POST['mobile']);
$ign = trim($_POST['ign']);
$ff_uid = trim($_POST['ff_uid']);
$country = trim($_POST['country']);
$state = trim($_POST['state']);
$city = trim($_POST['city']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

/* ==================================================
 4. Server Side Validation
 Empty Validation
================================================== */

if (
    empty($full_name) ||
    empty($username) ||
    empty($email) ||
    empty($mobile) ||
    empty($ign) ||
    empty($ff_uid) ||
    empty($password) ||
    empty($confirm_password)
) {
    header("Location: ../register.php?error=All fields are required");
    exit();
}

// Password Match

if ($password !== $confirm_password) {
    header("Location: ../register.php?error=Passwords do not match");
    exit();
}

// Password Length

if (strlen($password) < 6) {
    header("Location: ../register.php?error=Password must be at least 6 characters");
    exit();
}

/* ==================================================
 5. Duplicate Email Check
================================================== */

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../register.php?error=Invalid email address.");
    exit();
}

$sql = "SELECT id FROM users WHERE email=?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $email);

mysqli_stmt_execute($stmt);

mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {

    header("Location: ../register.php?error=Email is already registered.");

    exit();
}

mysqli_stmt_close($stmt);


/* ==================================================
 6. Duplicate Username Check
================================================== */
if (!preg_match('/^[a-z0-9_]{4,20}$/', $username)) {
    header("Location: ../register.php?error=Username must be 4-20 characters and contain only lowercase letters, numbers, and underscores.");
    exit();
}

$sql = "SELECT id FROM users WHERE username=?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $username);

mysqli_stmt_execute($stmt);

mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {

    header("Location: ../register.php?error=Username is already taken.");

    exit();
}

mysqli_stmt_close($stmt);

/* ==================================================
 7. Duplicate Mobile Check
================================================== */

if (!preg_match('/^[0-9]{10}$/', $mobile)) {
    header("Location: ../register.php?error=Invalid mobile number.");
    exit();
}

$sql = "SELECT id FROM users WHERE mobile=?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $mobile);

mysqli_stmt_execute($stmt);

mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {

    header("Location: ../register.php?error=Mobile number is already registered.");

    exit();
}

mysqli_stmt_close($stmt);

/* ==================================================
 8. Duplicate FF UID Check
================================================== */

if (!preg_match('/^[0-9]{8,15}$/', $ff_uid)) {
    header("Location: ../register.php?error=Invalid Free Fire UID.");
    exit();
}

$sql = "SELECT id FROM users WHERE ff_uid=?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $ff_uid);

mysqli_stmt_execute($stmt);

mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {

    header("Location: ../register.php?error=Free Fire UID is already registered.");

    exit();
}

mysqli_stmt_close($stmt);

/* ==================================================
 9. Player ID Generation
================================================== */
$result = mysqli_query($conn, "SELECT player_id FROM users ORDER BY id DESC LIMIT 1");

if (!$result) {
    die("Database Error: " . mysqli_error($conn));
}

if ($result && mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);

    $last_player_id = $row['player_id'];

    $number = (int) substr($last_player_id, 2);

    $number++;
} else {

    $number = 1;
}

$player_id = "FA" . str_pad($number, 6, "0", STR_PAD_LEFT);


/* ==================================================
 10. Password Hashing
================================================== */
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

/* ==================================================
 11. Image Upload
================================================== */
if (
    isset($_FILES['profile_photo']) &&
    $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK &&
    $_FILES['profile_photo']['size'] > 2 * 1024 * 1024
) {
    header("Location: ../register.php?error=Profile image must be less than 2 MB.");
    exit();
}


$profile_photo = "default.png";

if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {

    $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];

    $file_name = $_FILES['profile_photo']['name'];
    $tmp_name = $_FILES['profile_photo']['tmp_name'];

    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $tmp_name);
    finfo_close($finfo);

    $allowed_mime = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    if (!in_array($mime, $allowed_mime, true)) {
        header("Location: ../register.php?error=Invalid image file.");
        exit();
    }

    if (!in_array($extension, $allowed_extensions, true)) {
        header("Location: ../register.php?error=Only JPG, JPEG, PNG and WEBP images are allowed.");
        exit();
    }



        $profile_photo = $player_id . "_" . time() . "." . $extension;

        if (!move_uploaded_file(
            $tmp_name,
            "../assets/uploads/profile/" . $profile_photo
        )) {
            header("Location: ../register.php?error=Failed to upload profile image.");
            exit();
        }
    
}

/* ==================================================
 12. Insert Query
================================================== */
$sql = "INSERT INTO users
(
    player_id,
    full_name,
    username,
    email,
    mobile,
    password,
    ff_uid,
    ign,
    profile_photo,
    country,
    state,
    city
)
VALUES
(
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Prepare failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssss",
    $player_id,
    $full_name,
    $username,
    $email,
    $mobile,
    $hashed_password,
    $ff_uid,
    $ign,
    $profile_photo,
    $country,
    $state,
    $city
);

if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    header("Location: ../login.php?success=Registration completed successfully.");

    exit();
} else {

    mysqli_stmt_close($stmt);

    //header("Location: ../register.php?error=" . urlencode(mysqli_error($conn)));
    header("Location: ../register.php?error=Registration failed.");

    exit();
}

// mysqli_stmt_close($stmt);


?>