<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
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
        <h2>Registration</h2>
        
        <form action="register_user.php" method="POST">
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="fname" required>

            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lname" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="favorite_car">Favorite Fancy Car</label>
            <input type="text" id="favorite_car" name="favorite_car" required>

            <label for="ip_address">Your IP Address</label>
            <br><br>
            <input type="text" id="ip_address" name="ip_address" required>
            <span>Click <a href="https://whatismyipaddress.com" target=”_blank”>here</a> to get your ip address.</span>
            <p>Back to <a href="../login/login.php">login</a></p>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>