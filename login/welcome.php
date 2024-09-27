<?php
require '../vendor/autoload.php';
include_once('../access_log/save_access_log.php');

use GuzzleHttp\Exception\ClientException;

session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    log_current_access('denied');

    header("Location: login.php");
    exit();
}
else {
    log_current_access('allowed');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            width: 500px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }
    </style>

     <!-- Navigation Bar -->
    <?php
        include_once("../public/layout/header.php");
    ?>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['email']; ?>!</h2>
        <p>Your favorite fancy car is: <?php echo $_SESSION['favorite_car']; ?></p>
    <?php
        try 
        {
            // A Client object is what we use to make requests -- it is almost like a web browser effectively
            $client = new GuzzleHttp\Client(['verify' => false]);
            
            // Request URL here:
            $url = "https://ip-to-location1.p.rapidapi.com/myip?ip="; 
            // Set GET query parameters:
            $ip = $_SESSION['ip_address'];
            
            $response = $client->request('GET', $url . $ip, [
                    'headers' => [
                            'x-rapidapi-host' => 'ip-to-location1.p.rapidapi.com',
                            'x-rapidapi-key' => '6140750718msh046c2ffde8aa036p134db3jsn561c80d61078',
                    ],
            ]);
            
            // Check the result, and handle the data
            if($response->getStatusCode() == 200) 
            {
                    $result = json_decode($response->getBody(), true);
            }
            else 
            {
                    echo "Error : " . $response->getStatusCode();
            }

        }
        catch (ClientException $e) 
        {
            // catches all ClientExceptions (Errors)
            echo "Error request: \n";
            print_r($e->getRequest());

            echo "Error response: \n";
            print_r($e->getResponse());
        }
    ?>

        <?php
            if($result['geo'] == null) 
            {
        ?>
                <p>Your IP address is: <?php echo $result['ip']; ?></p>
                <p>Your IP address is invalid!!! Cannot retrieve the location information.</p>
        <?php
            }
            else 
            {
        ?>
                <p>Your IP address is: <?php echo $result['ip']; ?></p>
                <p>Your country is: <?php echo $result['geo']['country']; ?></p>
                <p>Your city is: <?php echo $result['geo']['city']; ?></p>
                <p>Your region is: <?php echo $result['geo']['region']; ?></p>
                <p>Your timezone is: <?php echo $result['geo']['timezone']; ?></p>
        <?php
            }
        ?>
        
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>

