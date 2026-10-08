<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$role = $_SESSION['role'] ?? '';
$fullName = $_SESSION['full_name'] ?? 'Guest';
$profilePhoto = $_SESSION['profile_photo'] ?? 'default.png';

// Adjust paths based on current folder
$basePath = (strpos($_SERVER['PHP_SELF'], '/user/') !== false ||
    strpos($_SERVER['PHP_SELF'], '/admin/') !== false ||
    strpos($_SERVER['PHP_SELF'], '/subadmin/') !== false)
    ? "../"
    : "";

$imagePath = $basePath . "assets/uploads/profile/" . $profilePhoto;

// Fallback if no profile photo
if ($profilePhoto == "" || $profilePhoto == null) {
    $imagePath = $basePath . "assets/images/default-user.png";
}

$currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-3">
    <div class="container-fluid px-4">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center fw-bold fs-3"
            href="<?= $basePath ?>index.php">

            <span class="me-2">🔥</span>

            <span class="text-warning">
                FireArena
            </span>

        </a>

        <!-- Mobile Button -->
        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbar">

            <ul class="navbar-nav me-auto">

                <?php if (!$isLoggedIn): ?>

                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage == 'index.php' ? 'active' : '' ?>"
                            href="<?= $basePath ?>index.php">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?= $basePath ?>public-tournaments.php">
                            Tournaments
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?= $basePath ?>leaderboard.php">
                            Leaderboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?= $basePath ?>about.php">
                            About
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?= $basePath ?>contact.php">
                            Contact
                        </a>
                    </li>

                <?php elseif ($role == "player"): ?>

                    <li class="nav-item">
                        <a class="nav-link px-3 <?= $currentPage == 'dashboard.php' ? 'active' : '' ?>"
                            href="<?= $basePath ?>user/dashboard.php">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?= $basePath ?>user/tournaments.php">
                            Tournaments
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?= $basePath ?>user/leaderboard.php">
                            Leaderboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?= $basePath ?>user/world-chat.php">
                            World Chat
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?= $basePath ?>user/friends.php">
                            Friends
                        </a>
                    </li>

                <?php elseif ($role == "admin"): ?>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?= $basePath ?>admin/dashboard.php">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?= $basePath ?>admin/users.php">
                            Players
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?= $basePath ?>admin/tournaments.php">
                            Tournaments
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?= $basePath ?>admin/matches.php">
                            Matches
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

            <ul class="navbar-nav ms-auto">

                <?php if (!$isLoggedIn): ?>

                    <li class="nav-item me-2">

                        <a href="<?= $basePath ?>login.php"
                            class="btn btn-outline-light">

                            Login

                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="<?= $basePath ?>register.php"
                            class="btn btn-warning">

                            Register

                        </a>

                    </li>

                <?php else: ?>

                    <li class="nav-item me-3">

                        <a href="#"
                            class="nav-link position-relative">

                            <i class="bi bi-bell fs-5"></i>

                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                                0

                            </span>

                        </a>

                    </li>

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle d-flex align-items-center"
                            href="#"
                            data-bs-toggle="dropdown">

                            <img src="<?= $imagePath ?>"
                                width="40"
                                height="40"
                                class="rounded-circle border border-warning me-2"
                                style="object-fit:cover;">

                            <?= htmlspecialchars($fullName) ?>

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>

                                <a class="dropdown-item"
                                    href="<?= $basePath ?>user/profile.php">

                                    <i class="bi bi-person"></i>

                                    My Profile

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-item"
                                    href="<?= $basePath ?>user/edit-profile.php">

                                    <i class="bi bi-pencil"></i>

                                    Edit Profile

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-item"
                                    href="<?= $basePath ?>user/change-password.php">

                                    <i class="bi bi-key"></i>

                                    Change Password

                                </a>

                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>

                                <a class="dropdown-item text-danger"
                                    href="<?= $basePath ?>logout.php">

                                    <i class="bi bi-box-arrow-right"></i>

                                    Logout

                                </a>

                            </li>

                        </ul>

                    </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>

</nav>