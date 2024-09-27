<?php
//enable php errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

  
class Controller 
{  
     public $model;   

     public function __construct()    
     {    
          $this->model = new Model();  
     }   
}  

?>