<?php
require_once(__DIR__ . "/../config/auth.php");
require_once(__DIR__ . "/../config/database.php");

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id=? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
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

    <title>Edit Profile | FireArena</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body class="bg-light">

    <?php include("../includes/navbar.php"); ?>

    <div class="container mt-5 mb-5">

        <div class="row justify-content-center">

            <div class="col-lg-9">

                <div class="card shadow border-0">

                    <div class="card-header bg-dark text-white">

                        <h3 class="mb-0">
                            <i class="bi bi-person-gear"></i>
                            Edit Profile
                        </h3>

                    </div>

                    <div class="card-body">

                        <div id="message"></div>

                        <form id="profileForm" enctype="multipart/form-data">

                            <input type="hidden" name="old_photo"
                                value="<?php echo $user['profile_photo']; ?>">

                            <div class="text-center mb-4">

                                <img

                                    id="preview"

                                    src="../assets/uploads/profile/<?php echo htmlspecialchars($user['profile_photo']); ?>"

                                    class="rounded-circle border border-3 border-warning"

                                    style="width:170px;height:170px;object-fit:cover;">

                                <br><br>

                                <input
                                    type="file"
                                    name="profile_photo"
                                    id="profile_photo"
                                    class="form-control">

                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        <i class="bi bi-lock-fill text-danger"></i>
                                        Player ID
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control bg-light"
                                        value="<?php echo $user['player_id']; ?>"
                                        readonly>

                                    <small class="text-muted">
                                        Player ID cannot be changed.
                                    </small>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        <i class="bi bi-lock-fill text-danger"></i>
                                        Username

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control bg-light"
                                        value="<?php echo $user['username']; ?>"
                                        readonly>

                                    <small class="text-muted">
                                        Username cannot be changed.
                                    </small>
                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        <i class="bi bi-lock-fill text-danger"></i>
                                        Email

                                    </label>

                                    <input
                                        type="email"
                                        class="form-control bg-light"
                                        value="<?php echo $user['email']; ?>"
                                        readonly>

                                    <small class="text-muted">
                                        Email cannot be changed.
                                    </small>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Full Name

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="full_name"
                                        value="<?php echo htmlspecialchars($user['full_name']); ?>"
                                        required>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Mobile

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="mobile"
                                        value="<?php echo htmlspecialchars($user['mobile']); ?>"
                                        required>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        IGN

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="ign"
                                        value="<?php echo htmlspecialchars($user['ign']); ?>"
                                        required>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Free Fire UID

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="ff_uid"
                                        value="<?php echo htmlspecialchars($user['ff_uid']); ?>"
                                        required
                                        pattern="[0-9]{9,}"
                                        minlength="9"
                                        maxlength="20"
                                        inputmode="numeric"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');">


                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Country

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="country"
                                        value="<?php echo htmlspecialchars($user['country']); ?>">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        State

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="state"
                                        value="<?php echo htmlspecialchars($user['state']); ?>">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        City

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="city"
                                        value="<?php echo htmlspecialchars($user['city']); ?>">

                                </div>

                            </div>

                            <div class="text-end">

                                <a
                                    href="profile.php"
                                    class="btn btn-secondary">

                                    Cancel

                                </a>

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    id="saveBtn">

                                    <i class="bi bi-floppy"></i>

                                    Save Changes

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        document.getElementById("profile_photo").addEventListener("change", function() {

            const file = this.files[0];

            if (file) {

                document.getElementById("preview").src = URL.createObjectURL(file);

            }

        });

        document.getElementById("profileForm").addEventListener("submit", function(e) {

            e.preventDefault();

            let formData = new FormData(this);

            let btn = document.getElementById("saveBtn");

            btn.disabled = true;

            btn.innerHTML = "Saving...";

            fetch("../ajax/update-profile.php", {

                    method: "POST",

                    body: formData

                })

                .then(response => response.json())

                .then(data => {

                    btn.disabled = false;

                    btn.innerHTML = "Save Changes";

                    if (data.status == "success") {

                        document.getElementById("message").innerHTML =
                            `<div class="alert alert-success">${data.message}</div>`;

                        setTimeout(function() {
                            // location.reload();
                            location.href = "profile.php";
                        }, 1200);

                    } else {

                        document.getElementById("message").innerHTML =
                            `<div class="alert alert-danger">${data.message}</div>`;

                    }

                });

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>