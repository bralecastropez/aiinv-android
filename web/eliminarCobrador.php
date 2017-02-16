<? 
include('config.php'); 
$IdCobrador = (int) $_GET['IdCobrador']; 
mysql_query("DELETE FROM `cobrador` WHERE `IdCobrador` = '$IdCobrador' ") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listarCobradores.php'>Back To Listing</a>