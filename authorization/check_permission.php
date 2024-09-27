<?php
include_once('../access_log/save_access_log.php');

function check_permission($required_roles) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the role matches any of the allowed roles
    if (!isset($_SESSION['role'])) {
        header("Location: /kit514-assignment-phat/login/login.php?error=3");
        exit();
    }
    elseif (!in_array($_SESSION['role'], $required_roles)) {
        log_current_access('denied');
        header("Location: /kit514-assignment-phat/authorization/forbidden_403.php");
        exit();
    }
    else {
        log_current_access('allowed');
    }
}
