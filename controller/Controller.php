<?php

include_once("model/Model.php");  
  
class Controller {  
     public $model;   
  
     public function __construct()    
     {    
          $this->model = new Model();  
     }   
      
     public function execute()  
     {  
		$customers = $this->model->getCustomerList();  

		include 'view/customerlist.php'; 
		//Or
		//include 'view/customerlist2.php'; 
     }  
}  

?>