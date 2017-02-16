<? 
include('config.php'); 
$IdPago = (int) $_GET['IdPago']; 
mysql_query("DELETE FROM `pago` WHERE `IdPago` = '$IdPago' ") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listarPagos.php'>Back To Listing</a>