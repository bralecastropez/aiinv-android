<? 
include('config.php'); 
$IdReferenciaCliente = (int) $_GET['IdReferenciaCliente']; 
mysql_query("DELETE FROM `referenciacliente` WHERE `IdReferenciaCliente` = '$IdReferenciaCliente' ") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listarReferenciasCliente.php'>Back To Listing</a>