<html>
<head>
    <title> Homepage </title>
    <link rel="stylesheet" href="public/css/home.css">
</head>
<body>


<div class="container">
    <?php
    session_start();

    if (isset($_SESSION['email'])) {
        header("Location: login/welcome.php");
        exit();
    }
    else {
    ?>
        <h1>Welcome to KIT514</h1>
        <h2>You have account? <a href="login/login.php">Sign in</a></h2>
        <h3><a href="registration/registration.php">Registration</a></h3>
    <?php
    }
    ?>
    
</div>

</body>
