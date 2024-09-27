<?php
include_once('../controller/DiscordController.php');
session_start();

$discord_controller = new DiscordController();

if (!isset($_SESSION['dc_access_token']) && !isset($_GET['code'])) {
    $discord_controller->request_authorize();
}
elseif (!isset($_SESSION['dc_access_token']) && isset($_GET['code'])) {
    $discord_controller->get_access_token($_GET['code']);
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'index') {
        $discord_controller->index();
    }
    elseif ($_GET['action'] == 'get-me') {
        $discord_controller->get_me($_SESSION['dc_access_token']);
    }
}
?>