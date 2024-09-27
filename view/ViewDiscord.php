<?php
class ViewDiscord
{
    public function index()
    {
        include_once("../public/layout/discord_layout.php");
?>
            <body>
                <div class="container">
                    <h1>Discord Connect</h1>
                    <div class="view-format-links">
                    <a href="../routes/discord.php?action=get-me" class="btn-format">Get Me</a>
                    <a href="../routes/discord.php?format=list-channels" class="btn-format">List Channels</a>
                </div>
                    <?php
                        
                    ?>
                </div>
                
            </body>
        </html>
<?php
    }
    
    public function ask_to_authorize()
    {
        include_once("../public/layout/discord_layout.php");

?>
        <link rel="stylesheet" href="../public/css/home.css">
        <body>
            <div class="container">
                <?php

                if (!isset($_SESSION['email'])) {
                    header("Location: ../login/login.php");
                    exit();
                }
                else {
                ?>
                    <h1>Access to Discord</h1>

                    <p>Click this <a href="https://discord.com/oauth2/authorize?client_id=1288829713862627338&response_type=code&redirect_uri=https%3A%2F%2Flab-d00a6b41-7f81-4587-a3ab-fa25e5f6d9cf.australiaeast.cloudapp.azure.com%3A7101%2Fkit514-assignment-phat%2Froutes%2Fdiscord.php&scope=identify+guilds">Discord link</a> to authorized with Discord</p>
                <?php
                }
                ?>
                
            </div>

            </body>
        </html>
<?php
    }

    public function discord_user($user) {
        include_once("../public/layout/discord_layout.php");
?>
        <body>
            <h1 style="text-align: center;">Discord User Information</h1>

            <div class="container">
                <div class="view-format-links">
                <a href="../routes/discord.php?action=get-me" class="btn-format">Get Me</a>
                <a href="../routes/discord.php?format=list-channels" class="btn-format">List Channels</a>
            </div>


            <!-- User Info Block -->
            <div class="user-info">
                <?php if (isset($user)): ?>
                    <?php
                        // Check if the user has a custom avatar
                        if ($user['avatar']) {
                            $avatar_url = "https://cdn.discordapp.com/avatars/{$user['id']}/{$user['avatar']}.png";
                        } else {
                            // If no custom avatar, generate a default avatar based on the user's discriminator
                            $discriminator = $user['discriminator'] % 5;
                            $avatar_url = "https://cdn.discordapp.com/embed/avatars/{$discriminator}.png";
                        }
                    ?>
                    <img class="avatar" src="<?= htmlspecialchars($avatar_url) ?>" alt="User Avatar" width="128" height="128">
                    <p><span class="label">ID:</span> <?= htmlspecialchars($user['id']) ?></p>
                    <p><span class="label">Username:</span> <?= htmlspecialchars($user['username']) ?></p>
                    <p><span class="label">Global Name:</span> <?= htmlspecialchars($user['global_name'] ?? 'N/A') ?></p>
                <?php else: ?>
                    <p>No user information available.</p>
                <?php endif; ?>
            </div>

        </body>
    </html>
<?php
    }
}
?>

