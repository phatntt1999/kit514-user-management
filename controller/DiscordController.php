<?php
//enable php errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("../config.php"); // Load env params

include_once("../view/ViewDiscord.php");
include_once('../authorization/check_permission.php');
include_once('../access_log/save_access_log.php');

use GuzzleHttp\Exception\ClientException;


class DiscordController
{
    public function index() {
        check_permission(["admin", "moderator", "user"]);

        $discord_view = new ViewDiscord();

        $discord_view->index();
        exit();
    }

    public function request_authorize() {
        check_permission(["admin", "moderator", "user"]);

        $discord_view = new ViewDiscord();

        $discord_view->ask_to_authorize();
        exit();
    }

    public function get_me($access_token) {
        check_permission(["admin", "moderator", "user"]);

        $client = new GuzzleHttp\Client(['verify' => false]);
        $response = $client->get('https://discord.com/api/users/@me', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => "Bearer $access_token",
            ],
        ]);

        $user_info = json_decode($response->getBody(), true);

        $discord_view = new ViewDiscord();

        $discord_view->discord_user($user_info);
        exit();
    }

    public function get_access_token($authorized_code) {
        if (isset($authorized_code)) {
            try {
                $client = new GuzzleHttp\Client(['verify' => false]);
                // Request URL here:
                $url = "https://discord.com/api/oauth2/token"; 
                // Set GET query parameters:
                $response = $client->post('https://discord.com/api/oauth2/token', [
                    'form_params' => [
                        'client_id' => $_ENV['DISCORD_CLIENT_ID'],
                        'client_secret' => $_ENV['DISCORD_CLIENT_SECRET'],
                        'grant_type' => 'authorization_code',
                        'code' => $authorized_code,  // Code received from Discord
                        'redirect_uri' => $_ENV['DISCORD_REDIRECT_URI'],
                    ],
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded'
                    ]
                ]);

                $token_data = json_decode($response->getBody(), true);
                $access_token = $token_data['access_token'];

                var_dump(isset($access_token));
                if (isset($access_token)) {
                    session_start();
                    $_SESSION['dc_access_token'] = $access_token; // Discord access token saved in session

                    log_current_access('allowed');

                    header("Location: ../routes/discord.php?action=index");
                }
                else {
                    log_current_access('denied');

                    header("Location: /kit514-assignment-phat/authorization/forbidden_403.php");
                }
            }
            catch (\Exception $e) {
                echo "Error: " . $e->getMessage() . "\n\n\n";
            }
        } else {
            echo "No authorization code found.";
            exit();
        }
        
        
    }

}
?>
