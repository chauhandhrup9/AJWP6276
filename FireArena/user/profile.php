<?php
require_once(__DIR__ . "/../config/auth.php");
require_once(__DIR__ . "/../config/database.php");

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = ? LIMIT 1";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Prepare failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Profile | FireArena</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body>

<?php include("../includes/navbar.php"); ?>

<div class="container mt-5 mb-5">

    <div class="card shadow-lg border-0">

        <div class="card-header bg-dark text-white">
            <h3 class="mb-0">
                <i class="bi bi-person-circle"></i>
                My Profile
            </h3>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 text-center">

                    <img src="../assets/uploads/profile/<?php echo htmlspecialchars($user['profile_photo']); ?>"
                        class="rounded-circle border border-3 border-warning shadow"
                        style="width:180px;height:180px;object-fit:cover;">

                    <h4 class="mt-3">
                        <?php echo htmlspecialchars($user['full_name']); ?>
                    </h4>

                    <span class="badge bg-success">
                        <?php echo ucfirst(htmlspecialchars($user['account_status'])); ?>
                    </span>

                </div>

                <div class="col-md-8">

                    <table class="table table-bordered table-striped">

                        <tr>
                            <th width="35%">Player ID</th>
                            <td><?php echo htmlspecialchars($user['player_id']); ?></td>
                        </tr>

                        <tr>
                            <th>Username</th>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                        </tr>

                        <tr>
                            <th>Mobile</th>
                            <td><?php echo htmlspecialchars($user['mobile']); ?></td>
                        </tr>

                        <tr>
                            <th>IGN</th>
                            <td><?php echo htmlspecialchars($user['ign']); ?></td>
                        </tr>

                        <tr>
                            <th>Free Fire UID</th>
                            <td><?php echo htmlspecialchars($user['ff_uid']); ?></td>
                        </tr>

                        <tr>
                            <th>Country</th>
                            <td><?php echo htmlspecialchars($user['country']); ?></td>
                        </tr>

                        <tr>
                            <th>State</th>
                            <td><?php echo htmlspecialchars($user['state']); ?></td>
                        </tr>

                        <tr>
                            <th>City</th>
                            <td><?php echo htmlspecialchars($user['city']); ?></td>
                        </tr>

                        <tr>
                            <th>Role</th>
                            <td><?php echo ucfirst(htmlspecialchars($user['role'])); ?></td>
                        </tr>

                        <tr>
                            <th>Member Since</th>
                            <td><?php echo date("d M Y", strtotime($user['created_at'])); ?></td>
                        </tr>

                    </table>

                    <a href="edit-profile.php" class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i>
                        Edit Profile
                    </a>

                    <a href="change-password.php" class="btn btn-warning">
                        <i class="bi bi-shield-lock"></i>
                        Change Password
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>