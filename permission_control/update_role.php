<?php
//enable php errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once('../authorization/check_permission.php');

check_permission(["admin"]);

include_once("../model/DBConn.php");
  
global $mysqli;

try {
    // Registration logic
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id']) && isset($_POST['new_role'])) {
        $id = $_POST['user_id'];
        $role = $_POST['new_role'];

        // validated role input before update
        $allowed_roles = ['user', 'moderator'];

        if (!in_array($role, $allowed_roles)) {
            header("Location: manage_users.php?error=invalidrole");
            exit();
        }

        $sql = "UPDATE users SET role = ? WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("si", $role, $id);

        if ($stmt->execute()) {
            header("Location: manage_users.php?success=updated");
        } else {
            header("Location: manage_users.php?success=failed");
        }
        $stmt->close();
    }
} catch (mysqli_sql_exception $e) {
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$mysqli->close();

?>