<?php
require_once("../config/auth.php");

$pageTitle = "Dashboard | FireArena";
include("../includes/header.php");
include("../includes/navbar.php");
?>

<div class="container-fluid py-4 px-4">

    <!-- Welcome -->
    <div class="mb-4">
        <h2 class="fw-bold">
            Welcome Back,
            <?= htmlspecialchars($_SESSION['full_name']); ?>
        </h2>

        <p class="text-muted mb-0">
            Player ID :
            <span class="fw-semibold text-primary">
                <?= htmlspecialchars($_SESSION['player_id']); ?>
            </span>
        </p>
    </div>

    <!-- Statistics -->
    <div class="row g-4">

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="bg-primary text-white rounded-3 p-3 me-3">
                        <i class="bi bi-controller fs-3"></i>
                    </div>

                    <div>
                        <small class="text-muted">Total Matches</small>
                        <h2 class="mb-0 fw-bold">0</h2>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="bg-success text-white rounded-3 p-3 me-3">
                        <i class="bi bi-trophy fs-3"></i>
                    </div>

                    <div>
                        <small class="text-muted">Wins</small>
                        <h2 class="mb-0 fw-bold">0</h2>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="bg-danger text-white rounded-3 p-3 me-3">
                        <i class="bi bi-crosshair fs-3"></i>
                    </div>

                    <div>
                        <small class="text-muted">Kills</small>
                        <h2 class="mb-0 fw-bold">0</h2>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="bg-warning text-dark rounded-3 p-3 me-3">
                        <i class="bi bi-graph-up-arrow fs-3"></i>
                    </div>

                    <div>
                        <small class="text-muted">Win Rate</small>
                        <h2 class="mb-0 fw-bold">0%</h2>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Tournament & Match -->
    <div class="row mt-4 g-4">

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-header bg-warning fw-bold d-flex justify-content-between">

                    <span>
                        <i class="bi bi-calendar-event"></i>
                        Upcoming Tournaments
                    </span>

                    <a href="tournaments.php" class="text-dark text-decoration-none">
                        View All →
                    </a>

                </div>

                <div class="card-body">

                    <div class="text-center py-4 text-muted">

                        <i class="bi bi-calendar-x fs-1"></i>

                        <p class="mt-2 mb-0">
                            No tournaments available.
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-header bg-success text-white fw-bold d-flex justify-content-between">

                    <span>
                        <i class="bi bi-clock-history"></i>
                        Recent Matches
                    </span>

                    <a href="#" class="text-white text-decoration-none">
                        View All →
                    </a>

                </div>

                <div class="card-body">

                    <div class="text-center py-4 text-muted">

                        <i class="bi bi-controller fs-1"></i>

                        <p class="mt-2 mb-0">
                            No match history available.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Announcement -->
    <div class="card border-0 shadow-sm rounded-4 mt-4">

        <div class="card-header bg-primary text-white fw-bold d-flex justify-content-between">

            <span>
                <i class="bi bi-megaphone"></i>
                Latest Announcements
            </span>

            <a href="#" class="text-white text-decoration-none">
                View All →
            </a>

        </div>

        <div class="card-body">

            <ul class="mb-0">

                <li>Welcome to FireArena.</li>

                <li>Free Fire tournaments will open soon.</li>

                <li>Complete your profile before joining tournaments.</li>

            </ul>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>