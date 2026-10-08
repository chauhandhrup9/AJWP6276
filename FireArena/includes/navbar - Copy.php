<?php
require_once("../config/auth.php");
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

    <div class="container-fluid">

        <a class="navbar-brand fw-bold text-warning" href="../user/dashboard.php">
            FireArena
        </a>

        <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- Main Navigation -->
            <ul class="navbar-nav ms-4">

                <li class="nav-item">
                    <a class="nav-link active" href="../user/dashboard.php">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../user/tournaments.php">
                        Tournaments
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../user/leaderboard.php">
                        Leaderboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../user/world-chat.php">
                        World Chat
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../user/friends.php">
                        Friends
                    </a>
                </li>

            </ul>

            <!-- Right Side -->
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item me-3">

                    <a class="nav-link position-relative" href="#">

                        <i class="bi bi-bell-fill fs-5"></i>

                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                            0

                        </span>

                    </a>

                </li>

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle d-flex align-items-center"
                        href="#"
                        data-bs-toggle="dropdown">

                        <img
                            src="../assets/uploads/profile/<?php echo $_SESSION['profile_photo']; ?>"
                            width="40"
                            height="40"
                            class="rounded-circle border border-warning me-2">

                        <?php echo htmlspecialchars($_SESSION['full_name']); ?>

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow" style="min-width:280px;">

                        <li class="text-center p-3">

                            <img src="../assets/uploads/profile/<?php echo htmlspecialchars($_SESSION['profile_photo']); ?>"
                                width="80"
                                height="80"
                                class="rounded-circle border border-3 border-warning mb-2"
                                alt="Profile">

                            <h5 class="mb-1">
                                <?php echo htmlspecialchars($_SESSION['full_name']); ?>
                            </h5>

                            <small class="text-muted">
                                Player ID : <?php echo htmlspecialchars($_SESSION['player_id']); ?>
                            </small>

                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item" href="../user/profile.php">
                                <i class="bi bi-person-circle me-2"></i>
                                My Profile
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="../user/edit-profile.php">
                                <i class="bi bi-pencil-square me-2"></i>
                                Edit Profile
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="../user/change-password.php">
                                <i class="bi bi-shield-lock me-2"></i>
                                Change Password
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="../user/settings.php">
                                <i class="bi bi-gear me-2"></i>
                                Settings
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item text-danger" href="../logout.php">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Logout
                            </a>
                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </div>

</nav>

