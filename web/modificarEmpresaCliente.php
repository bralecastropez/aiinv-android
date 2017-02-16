<? 
include('config.php'); 
if (isset($_GET['IdEmpresaCliente']) ) { 
$IdEmpresaCliente = (int) $_GET['IdEmpresaCliente']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `empresacliente` SET  `IdCliente` =  '{$_POST['IdCliente']}' ,  `Nombre` =  '{$_POST['Nombre']}' ,  `Direccion` =  '{$_POST['Direccion']}' ,  `Correo` =  '{$_POST['Correo']}' ,  `Telefono` =  '{$_POST['Telefono']}' ,  `NIT` =  '{$_POST['NIT']}' ,  `Sueldo` =  '{$_POST['Sueldo']}' ,  `Experiencia` =  '{$_POST['Experiencia']}'   WHERE `IdEmpresaCliente` = '$IdEmpresaCliente' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='listarEmpresasCliente.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `empresacliente` WHERE `IdEmpresaCliente` = '$IdEmpresaCliente' ")); 
?>

<form action='' method='POST'> 
<p><b>IdCliente:</b><br /><input type='text' name='IdCliente' value='<?= stripslashes($row['IdCliente']) ?>' /> 
<p><b>Nombre:</b><br /><input type='text' name='Nombre' value='<?= stripslashes($row['Nombre']) ?>' /> 
<p><b>Direccion:</b><br /><textarea name='Direccion'><?= stripslashes($row['Direccion']) ?></textarea> 
<p><b>Correo:</b><br /><input type='text' name='Correo' value='<?= stripslashes($row['Correo']) ?>' /> 
<p><b>Telefono:</b><br /><input type='text' name='Telefono' value='<?= stripslashes($row['Telefono']) ?>' /> 
<p><b>NIT:</b><br /><input type='text' name='NIT' value='<?= stripslashes($row['NIT']) ?>' /> 
<p><b>Sueldo:</b><br /><input type='text' name='Sueldo' value='<?= stripslashes($row['Sueldo']) ?>' /> 
<p><b>Experiencia:</b><br /><input type='text' name='Experiencia' value='<?= stripslashes($row['Experiencia']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
