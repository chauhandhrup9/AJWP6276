<?php

session_start();

$_SESSION = [];

session_destroy();

header("Location: login.php?success=Logged out successfully.");
exit();