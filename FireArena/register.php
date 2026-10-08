<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FireArena | Player Registration</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/register.css">
</head>

<body class="bg-dark">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card shadow-lg border-0">

                    <div class="card-header bg-danger text-white text-center">

                        <h2> FireArena</h2>

                        <p class="mb-0">Player Registration</p>

                    </div>

                    <div class="card-body">

                        <form action="ajax/register.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">

                            <?php

                            if (isset($_GET['success'])) {
                            ?>
                                <div class="alert alert-success">
                                    Registration Successful.
                                </div>
                            <?php
                            }

                            if (isset($_GET['error'])) {
                            ?>
                                <div class="alert alert-danger">
                                    <?php echo htmlspecialchars($_GET['error']); ?>
                                </div>
                            <?php
                            }

                            ?>

                            <h5 class="mb-3">Personal Information</h5>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label>Full Name</label>
                                    <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Enter your full name" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Username</label>
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter a username" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Mobile Number</label>
                                    <input type="text" id="mobile" name="mobile" maxlength="10" inputmode="numeric" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" placeholder="Enter your mobile number" required>
                                </div>

                            </div>

                            <hr>

                            <h5 class="mb-3">Gaming Information</h5>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label>In Game Name (IGN)</label>
                                    <input type="text" id="ign" name="ign" class="form-control" placeholder="Enter your in-game name" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Free Fire UID</label>
                                    <input type="text" id="ff_uid" name="ff_uid" class="form-control" placeholder="Enter your Free Fire UID" maxlength="15" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Country</label>
                                    <input type="text" id="country" name="country" class="form-control" placeholder="Enter your country">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>State</label>
                                    <input type="text" id="state" name="state" class="form-control" placeholder="Enter your state">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>City</label>
                                    <input type="text" id="city" name="city" class="form-control" placeholder="Enter your city">
                                </div>

                            </div>

                            <hr>

                            <h5 class="mb-3">Account Information</h5>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter a password" autocomplete="new-password" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Confirm Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm your password" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Profile Picture</label>
                                    <input type="file" id="profile_photo" name="profile_photo" class="form-control" accept="image/*">
                                </div>

                            </div>

                            <div class="d-grid mt-4">

                                <button class="btn btn-danger btn-lg" type="submit">
                                    <i class="bi bi-person-plus-fill"></i>
                                    Create Account
                                </button>

                            </div>

                        </form>

                    </div>

                    <div class="card-footer text-center">

                        Already have an account?

                        <a href="login.php">Login Here</a>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>
        function validateForm() {

            let name = document.getElementById("full_name").value.trim();
            let username = document.getElementById("username").value.trim();
            let email = document.getElementById("email").value.trim();
            let mobile = document.getElementById("mobile").value.trim();
            let ign = document.getElementById("ign").value.trim();
            let uid = document.getElementById("ff_uid").value.trim();
            let password = document.getElementById("password").value;
            let confirm = document.getElementById("confirm_password").value;

            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let mobilePattern = /^[0-9]{10}$/;
            let uidPattern = /^[0-9]{8,15}$/;

            if (name == "") {
                alert("Enter Full Name");
                return false;
            }

            if (username.length < 4) {
                alert("Username must be at least 4 characters.");
                return false;
            }

            if (!emailPattern.test(email)) {
                alert("Invalid Email");
                return false;
            }

            if (!mobilePattern.test(mobile)) {
                alert("Enter valid Mobile Number");
                return false;
            }

            if (ign == "") {
                alert("Enter In Game Name");
                return false;
            }

            if (!uidPattern.test(uid)) {
                alert("Enter Valid Free Fire UID");
                return false;
            }

            if (password.length < 6) {
                alert("Password should be at least 6 characters.");
                return false;
            }

            if (password != confirm) {
                alert("Passwords do not match.");
                return false;
            }

            return true;

        }
    </script>

</body>

</html>