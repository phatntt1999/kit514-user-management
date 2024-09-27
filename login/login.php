<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            width: 420px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 5px;
        }
        input[type="submit"] {
            width: 80%;
            padding: 10px;
            margin-left: 30px;
            margin-top: 15px;
            background-color: #5cb85c;
            border: none;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<p style="color:red;">Invalid username or password!</p>';
        } elseif (isset($_GET['error']) && $_GET['error'] == 2) {
            echo '<p style="color:red;">User not found!</p>';
        }
        elseif (isset($_GET['error']) && $_GET['error'] == 3) {
            echo '<p style="color:red;">You have to login to access content.</p>';
        }
        ?>
        <h2>Login</h2>
        <form action="login_user.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
        </form>

        <p>Or register <a href="../registration/registration.php">here</a></p>
    </div>
</body>
</html>