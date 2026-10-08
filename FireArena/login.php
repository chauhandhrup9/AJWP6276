<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: user/dashboard.php");
    exit();
}

$success = $_GET['success'] ?? "";
$error = $_GET['error'] ?? "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | FireArena</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            background:
                linear-gradient(rgba(0, 0, 0, .65), rgba(0, 0, 0, .75)),
                url("assets/images/auth-bg.jpg");

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .login-card {
            width: 100%;
            max-width: 450px;
            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(8px);
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .35);
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
            color: #ff6b00;
        }

        .toggle-password {
            cursor: pointer;
        }

        .btn-danger {
            background: #ff5e00;
            border: none;
        }

        .btn-danger:hover {
            background: #ff7b00;
        }

        .logo {
            color: #ff6b00;
        }
    </style>
</head>

<body>

    <div class="card login-card p-4">

        <div class="text-center mb-4">
            <div class="logo"> FireArena </div>
            <p class="text-muted mb-0">Player Login</p>
        </div>

        <?php if ($success != "") { ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php } ?>

        <?php if ($error != "") { ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php } ?>

        <form
            action="ajax/login.php"
            method="POST"
            onsubmit="return validateForm();">

            <div class="mb-3">
                <label class="form-label">Username / Email / Mobile</label>

                <input
                    type="text"
                    class="form-control"
                    id="login_id"
                    name="login_id"
                    placeholder="Enter Username, Email or Mobile">
            </div>

            <div class="mb-3">

                <label class="form-label">Password</label>

                <div class="input-group">

                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Enter Password">

                    <button
                        class="btn btn-outline-secondary"
                        type="button"
                        onclick="togglePassword();">

                        <!-- <i class="bi bi-eye" id="toggleIcon"></i> -->
                        <i class="fa-solid fa-eye" id="toggleIcon"></i>

                    </button>

                </div>

            </div>

            <div class="d-flex justify-content-between mb-3">

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="remember">

                    <label class="form-check-label">
                        Remember Me
                    </label>

                </div>

                <a href="forgot-password.php">
                    Forgot Password?
                </a>

            </div>

            <button class="btn btn-danger w-100">
                Login
            </button>

        </form>

        <hr>

        <div class="text-center">

            Don't have an account?

            <a href="register.php">
                Register Now
            </a>

        </div>

    </div>

    <script>
        function validateForm() {

            let login = document.getElementById("login_id").value.trim();
            let password = document.getElementById("password").value;

            if (login == "") {
                alert("Enter Username, Email or Mobile");
                return false;
            }

            if (password == "") {
                alert("Enter Password");
                return false;
            }

            return true;
        }

        function togglePassword() {

            let password = document.getElementById("password");
            let icon = document.getElementById("toggleIcon");

            // if (password.type === "password") {
            //     password.type = "text";
            //     icon.classList.remove("bi-eye");
            //     icon.classList.add("bi-eye-slash");
            // } else {
            //     password.type = "password";
            //     icon.classList.remove("bi-eye-slash");
            //     icon.classList.add("bi-eye");
            // }

            if (password.type === "password") {
                password.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                password.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }

        }
    </script>

</body>

</html>