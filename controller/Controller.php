<?php
//enable php errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("model/Model.php");  
include_once("view/ViewCustomerList.php");
include_once("view/ViewCustomerTable.php");
  
class Controller 
{  
     public $model;   

     public function __construct()    
     {    
          $this->model = new Model();  
     }   
      
     public function execute()  
     {  
		$customers = $this->model->getCustomerList();  

          $view = new ViewCustomerTable();
          //or
          //$view = new ViewCustomerList();

          $view->output($customers);
     }  
}  

?>