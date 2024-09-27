<?php
//enable php errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("../model/DBConn.php");
include_once('../access_log/save_access_log.php');

    session_start();
    global $mysqli;

    function decrypt_data($data) {
        //Load encrypted text
        $cryptText = base64_decode($data);

        //Load private Key
        $priv_key_raw = file_get_contents("../private.pem");
        $priv_key = openssl_get_privatekey($priv_key_raw, $_ENV['KEY_PASS']);

        $decryptText = "";
        //Decrypt
        openssl_private_decrypt($cryptText, $decryptText, $priv_key);

        return $decryptText;
    }

    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];
            
            // Fetch the user from the database
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // User found, now verify the password
                $user = $result->fetch_assoc();
                $hashed_password = $user["password"];
                $salt = $user["salt"];
                $encrypted_favorite_car = $user["favorite_car"];
                $ip_address = $user["ip_address"];
                $role = $user["role"];

                // Verify the password with the hash and salt
                if (password_verify($password . $salt, $hashed_password)) {
                    // Correct password, set session variables and redirect
                    $_SESSION["email"] = $email;
                    $_SESSION["favorite_car"] = decrypt_data($encrypted_favorite_car);
                    $_SESSION["ip_address"] = $ip_address;
                    $_SESSION["role"] = $role;

                    log_current_access('allowed');
                    header("Location: welcome.php");
                } else {
                    log_current_access('denied');
                    header("Location: login.php?error=1");
                    exit();
                }
            } else {
                log_current_access('denied');
                header("Location: login.php?error=2");
                exit();
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