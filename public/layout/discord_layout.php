<!DOCTYPE html>
        
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discord Connect</title>
    <link rel="stylesheet" href="../public/css/access_log_view.css">

    <?php
        include_once("header.php");
    ?>
    <style>
        .user-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 20px auto;
        }

        .user-info p {
            font-size: 16px;
            margin: 10px 0;
        }

        .user-info .label {
            font-weight: bold;
        }

        .avatar {
            border-radius: 50%;
            margin-bottom: 20px;
        }
    </style>
</head>