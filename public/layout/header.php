<link rel="stylesheet" href="../public/css/nav.css">

<nav>
    <ul class="nav-links">
        <li><a href="../login/welcome.php">Home</a></li>
        <li><a href="../routes/discord.php?action=index">Discord</a></li>
        <?php
            if ($_SESSION['role'] == 'admin') {
        ?>
            <li><a href="../routes/access_log.php">Access Logs</a></li>
            <li><a href="../permission_control/manage_users.php">Manage Users</a></li>
        <?php        
            } elseif ($_SESSION['role'] == 'moderator') {
        ?>
            <li><a href="../routes/access_log.php">Access Logs</a></li>
        <?php
            }
        ?>
        
        <li><a href="../login/logout.php">Logout</a></li>
    </ul>
</nav>