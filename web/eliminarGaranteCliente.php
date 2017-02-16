<? 
include('config.php'); 
$IdGaranteCliente = (int) $_GET['IdGaranteCliente']; 
mysql_query("DELETE FROM `garantecliente` WHERE `IdGaranteCliente` = '$IdGaranteCliente' ") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listarGarantesCliente.php'>Back To Listing</a>