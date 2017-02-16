<? 
include('config.php'); 
$IdUsuario = (int) $_GET['IdUsuario']; 
mysql_query("DELETE FROM `Usuario` WHERE `IdUsuario` = '$IdUsuario' ") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listarUsuario.php'>Back To Listing</a>