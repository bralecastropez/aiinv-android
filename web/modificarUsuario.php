<? 
include('config.php'); 
if (isset($_GET['IdUsuario']) ) { 
$IdUsuario = (int) $_GET['IdUsuario']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `Usuario` SET   WHERE `IdUsuario` = '$IdUsuario' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='listarUsuario.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `Usuario` WHERE `IdUsuario` = '$IdUsuario' ")); 
?>

<form action='' method='POST'> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
