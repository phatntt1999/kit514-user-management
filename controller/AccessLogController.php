<?php
//enable php errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("../model/AccessLogModel.php");
include_once("../view/ViewAccessLog.php");
include_once('../authorization/check_permission.php');
  
class AccessLogController 
{  
    private $al_model;   

    public function __construct()    
    {    
        $this->al_model = new AccessLogModel();
    }   
    
    public function capture_access_log($access_status)  
    {  
        // Get the IP address
        $ip_address = $_SERVER['REMOTE_ADDR'];

        // Get the current URL
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        // Check if the user is logged in
        $email = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
        $this->al_model->log_access($ip_address, $url, $email, $access_status);
    }

    public function get_access_log()  
    {  
        check_permission(["admin", "moderator"]);

        $access_logs = $this->al_model->get_logs();

        $format = isset($_GET['format']) ? $_GET['format'] : 'table';  // Default to HTML table

        $al_view = new ViewAccessLog();
        $al_view->output($access_logs, $format);

        exit();
    }

    public function search_by_ip($ip_address)  
    {  
        check_permission(["admin", "moderator"]);

        $access_logs = $this->al_model->get_logs_by_ip_address($ip_address);

        $format = isset($_GET['format']) ? $_GET['format'] : 'table';  // Default to HTML table

        $al_view = new ViewAccessLog();
        $al_view->output($access_logs, $format);

        exit();
    }
}  
?>