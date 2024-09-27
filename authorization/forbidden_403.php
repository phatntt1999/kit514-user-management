<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>

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
    </style>
</head>
<body>
    <?php header('HTTP/1.0 403 Forbidden'); ?>
    
    <div class="container">
        <h1>Access Denied</h1>

        <p>You do not have permission to view this page.</p>
        <a href="javascript:history.back()">Go Back</a>
    </div>
</body>
</html>