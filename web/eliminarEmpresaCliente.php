<? 
include('config.php'); 
$IdEmpresaCliente = (int) $_GET['IdEmpresaCliente']; 
mysql_query("DELETE FROM `empresacliente` WHERE `IdEmpresaCliente` = '$IdEmpresaCliente' ") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listarEmpresasCliente.php'>Back To Listing</a>