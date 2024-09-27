<?php
include_once('../controller/AccessLogController.php');

function log_current_access($access_status) {
    $al_controller = new AccessLogController();

    $al_controller->capture_access_log($access_status);
}
?>