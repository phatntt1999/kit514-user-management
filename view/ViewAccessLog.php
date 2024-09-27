<?php
class ViewAccessLog
{
    public function output($access_logs, $format)
    {
        ?>
        <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Access Logs</title>
                <link rel="stylesheet" href="../public/css/access_log_view.css">

                <?php
                    include_once("../public/layout/header.php");
                ?>
            </head>
            <body>
                
                <div class="container">
                    <h1>Access Logs</h1>
                    <div class="view-format-links">
                    <a href="../routes/access_log.php?format=table" class="btn-format">View as Table</a>
                    <a href="../routes/access_log.php?format=list" class="btn-format">View as List</a>
                    <a href="../routes/access_log.php?format=json" class="btn-format">View as JSON</a>
                </div>
                <!-- Search form -->
                <form action="../routes/access_log.php" method="get">
                    <label for="ip_address">Search by IP Address:</label>
                    <input type="text" name="ip_address" id="ip_address" required>
                    <button type="submit">Search</button>
                </form>
                    <?php
                        switch ($format) {
                            case 'list':
                                $this->output_as_list($access_logs);
                                break;
                            case 'json':
                                $this->output_as_json($access_logs);
                                break;
                            default:
                                $this->output_as_table($access_logs);
                                break;
                        }
                    ?>
                </div>
                
            </body>
        </html>
        <?php
    }

    private function output_as_table($access_logs) {
        ?>
        <table>
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>IP Address</th>
                    <th>URL</th>
                    <th>Email</th>
                    <th>Access Status</th>
                </tr>
            </thead>
            <tbody>
        <?php
        foreach ($access_logs as $log) {
        ?>
                <tr>
                    <td><?php echo $log['timestamp']; ?></td>
                    <td><?php echo $log['ip_address']; ?></td>
                    <td><?php echo $log['url']; ?></td>
                    <td><?php echo $log['email'] ? $log['email'] : 'Unknown'; ?></td>
                    <td><?php echo $log['access_status'] == 1 ? 'Allowed' : 'Denied'; ?></td>
                </tr>
            
    <?php
        }
        ?>
            </tbody>
        </table>
    <?php
    }

    private function output_as_list($access_logs) {
        echo '<ul class="list_access_log">';
        foreach ($access_logs as $log) {
            $converted_access_status = $log['access_status'] == 1 ? 'Allowed' : 'Denied';
            echo 'User: <b>' . ($log['email'] ? $log['email'] : 'Unknown') . '</b>';

            echo '<li>Timestamp: ' . $log['timestamp'] . '</li>';
            echo '<li>IP: ' . $log['ip_address'] . '</li>';
            echo '<li>URL: ' . $log['url'] . '</li>';
            echo '<li>Status: ' . $converted_access_status . '</li>';
            echo '<br>';
        }
        echo '</ul>';
    }

    
    private function output_as_json($access_logs) {
        $json_data = json_encode($access_logs, JSON_PRETTY_PRINT);
        ob_end_clean();
        header('Content-Type: application/json');
        
        echo $json_data;

        exit();
        // var_dump($access_logs);
    }
    
}
?>

