<html>  
<head></head>  
  
<body>  
  
    <table>  
        <tbody>
	<tr>
	   <td>ID</td>
	   <td>Cust Fname</td>
           <td>Cust Lname</td>
           <td>Cust Email</td>
	</tr>
	</tbody>  
        <?php   
  
            foreach ($customers as $id => $customer)  
            {  
                echo '<tr><td><a href="index.php?customer='.$customer->id.'">'.$customer->id.'</a></td><td>'.$customer->fname.'</td><td>'.$customer->lname.'</td><td>'.$customer->email.'</td></tr>';  
            }  
  
        ?>  
    </table>  
  
</body>  
</html>  