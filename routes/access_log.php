<?php
include_once('../controller/AccessLogController.php');

$al_controller = new AccessLogController();

if (isset($_GET['ip_address'])) {
    $al_controller->search_by_ip($_GET['ip_address']);
}
else {
    $al_controller->get_access_log();
}

exit();