<? 
include('config.php'); 
$IdCliente = (int) $_GET['IdCliente']; 
mysql_query("DELETE FROM `cliente` WHERE `IdCliente` = '$IdCliente' ") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listarClientes.php'>Back To Listing</a>