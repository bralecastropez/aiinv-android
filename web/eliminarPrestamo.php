<? 
include('session.php'); 
$IdPrestamo = (int) $_GET['IdPrestamo']; 
mysql_query("DELETE FROM `prestamo` WHERE `IdPrestamo` = '$IdPrestamo' ") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listarPrestamos.php'>Back To Listing</a>