<?php
include_once("Customer.php");  

  
class Model {  
    public function getCustomerList()  
    {  

include_once("DBConn.php");  

$sql= "select * from customer";

$result=$mysqli->query($sql);


$arr= array();

while($row = $result->fetch_array(MYSQLI_ASSOC))
{
	$arr[$row['ID']]= new Customer($row['ID'], $row['Firstname'],$row['Lastname'],$row['email']);
}



return $arr;

    }        
  
 // public function getCustomerByID($id)  {  … }       
 // public function getCustomerByName($name)  {  … } 
    
} 


?>