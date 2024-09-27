<?php

include_once("DBConn.php");  

class AccessLogModel {
    public function log_access($ip_address, $url, $email, $access_status) {
        global $mysqli;

        // Convert value of access status
        if ($access_status == "allowed") {
            $access_status = 1;
        } else {
            $access_status = 0;
        }

        // Insert access log into the database
        $stmt = $mysqli->prepare("INSERT INTO access_logs (ip_address, url, email, access_status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $ip_address, $url, $email, $access_status);

        $stmt->execute();
        $stmt->close();
    }

    public function get_logs() {
        global $mysqli;

        $sql = "SELECT * FROM access_logs ORDER BY timestamp DESC";
        $result = $mysqli->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_logs_by_ip_address($ip_address) {
        global $mysqli;

         // Prepare the SQL query
        $stmt = $mysqli->prepare('SELECT * FROM access_logs WHERE ip_address = ?');
        
        $stmt->bind_param('s', $ip_address);
        $stmt->execute();

        $result = $stmt->get_result();
        $logs = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $logs;
    }
}