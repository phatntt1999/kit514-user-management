<?php
//enable php errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once('../authorization/check_permission.php');
include_once('user_list.php');

check_permission(["admin"]);

$users = get_all_users();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 18px;
            padding: 20px;
        }

        table thead th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border-bottom: 2px solid #ddd;
        }

        /* Table Body Rows */
        table tbody tr {
            background-color: #fff;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        /* Hover Effect */
        table tbody tr:hover {
            background-color: #e0e0e0;
        }

        /* Form Styling in Table (for role modification) */
        table tbody td form select {
            font-size: 16px;
            padding: 6px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        table tbody td form input[type="submit"] {
            padding: 6px 12px;
            margin-left: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        table tbody td form input[type="submit"]:hover {
            background-color: #45a049;
        }

        h1 a {
            text-decoration: none;
            color: black;
        }
    </style>
    
    <!-- Include navigation bar -->
    <?php
        include_once("../public/layout/header.php");
    ?>
</head>
<body>
    <div class="container">
        <h1><a href="manage_users.php">Manage Users and Roles</a></h1>
        <?php
            if (isset($_GET['error']) && $_GET['error'] == 'invalidrole') {
                echo '<p style="color:red;">Update role failed! You input invalid role.</p>';
            } elseif (isset($_GET['success']) && $_GET['success'] == 'updated') {
                echo '<p style="color:green;">Update user\'s role successfully!</p>';
            }
            elseif (isset($_GET['success']) && $_GET['success'] == 'failed') {
                echo '<p style="color:red;">Undefined error. Please try again</p>';
            }
        ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Modify Role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['fname'] . " " . $user['lname']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td>
                            <?php if ($user['role'] != 'admin'): ?>
                                <form action="update_role.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <select name="new_role">
                                        <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                                        <option value="moderator" <?php echo ($user['role'] == 'moderator') ? 'selected' : ''; ?>>Moderator</option>
                                    </select>
                                    <input type="submit" value="Update Role">
                                </form>
                            <?php else: ?>
                                <!-- Do not allow role modification for admins -->
                                Admin
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
