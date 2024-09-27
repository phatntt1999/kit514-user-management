<?php
include_once("../model/DBConn.php");  
  
    global $mysqli;

    function encrypt_data($data) {
        $public_key = file_get_contents('../public.pem');

        // Check if the public key is valid
        if (openssl_public_encrypt($data, $encrypted_data, $public_key)) {
            // Base64 encode the encrypted data for storage or transmission
            $encrypted_result = base64_encode($encrypted_data);

            echo "Encrypted data successfully!";
        } else {
            echo "Encryption failed!";
        }
        return $encrypted_result;
    }
    try {
        // Registration logic
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $favorite_car = $_POST['favorite_car'];
            $ip_address = $_POST['ip_address'];
            $role = "user";

            // Encrypt the favorite car with a secret key
            $encrypted_favorite_car = encrypt_data($favorite_car);

            // Generate a salt
            $salt = bin2hex(random_bytes(16));
            // Hash the password with the salt
            $hashed_password = password_hash($password . $salt, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (fname, lname, email, password, role, favorite_car, ip_address, salt) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ssssssss", $fname, $lname, $email, $hashed_password, $role, $encrypted_favorite_car, $ip_address, $salt);

            if ($stmt->execute()) {
                header("Location: ../login/login.php");
            } else {
                echo "Error: " . $stmt->error;
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