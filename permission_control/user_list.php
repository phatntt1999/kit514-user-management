<?php
include_once("../model/DBConn.php");

function get_all_users() {
    global $mysqli;

    // Fetch all users
    $sql = "SELECT * FROM users";
    $result = $mysqli->query($sql);
    
    $users = [];
    
    if ($result->num_rows > 0) {
        // Store all users in an array
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    $mysqli->close();

    return $users;
}
