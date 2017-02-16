<? 
include('config.php'); 
if (isset($_GET['IdReferenciaCliente']) ) { 
$IdReferenciaCliente = (int) $_GET['IdReferenciaCliente']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `referenciacliente` SET  `IdCliente` =  '{$_POST['IdCliente']}' ,  `Nombre` =  '{$_POST['Nombre']}' ,  `DPI` =  '{$_POST['DPI']}' ,  `Telefono` =  '{$_POST['Telefono']}' ,  `DescripcionTelefono` =  '{$_POST['DescripcionTelefono']}' ,  `Correo` =  '{$_POST['Correo']}' ,  `Direccion` =  '{$_POST['Direccion']}' ,  `NombreEmpresa` =  '{$_POST['NombreEmpresa']}' ,  `NitEmpresa` =  '{$_POST['NitEmpresa']}' ,  `TelefonoEmpresa` =  '{$_POST['TelefonoEmpresa']}' ,  `CorreoEmpresa` =  '{$_POST['CorreoEmpresa']}' ,  `DireccionEmpresa` =  '{$_POST['DireccionEmpresa']}'   WHERE `IdReferenciaCliente` = '$IdReferenciaCliente' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='listarReferenciasCliente.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `referenciacliente` WHERE `IdReferenciaCliente` = '$IdReferenciaCliente' ")); 
?>

<form action='' method='POST'> 
<p><b>IdCliente:</b><br /><input type='text' name='IdCliente' value='<?= stripslashes($row['IdCliente']) ?>' /> 
<p><b>Nombre:</b><br /><input type='text' name='Nombre' value='<?= stripslashes($row['Nombre']) ?>' /> 
<p><b>DPI:</b><br /><input type='text' name='DPI' value='<?= stripslashes($row['DPI']) ?>' /> 
<p><b>Telefono:</b><br /><input type='text' name='Telefono' value='<?= stripslashes($row['Telefono']) ?>' /> 
<p><b>DescripcionTelefono:</b><br /><input type='text' name='DescripcionTelefono' value='<?= stripslashes($row['DescripcionTelefono']) ?>' /> 
<p><b>Correo:</b><br /><input type='text' name='Correo' value='<?= stripslashes($row['Correo']) ?>' /> 
<p><b>Direccion:</b><br /><textarea name='Direccion'><?= stripslashes($row['Direccion']) ?></textarea> 
<p><b>NombreEmpresa:</b><br /><input type='text' name='NombreEmpresa' value='<?= stripslashes($row['NombreEmpresa']) ?>' /> 
<p><b>NitEmpresa:</b><br /><input type='text' name='NitEmpresa' value='<?= stripslashes($row['NitEmpresa']) ?>' /> 
<p><b>TelefonoEmpresa:</b><br /><input type='text' name='TelefonoEmpresa' value='<?= stripslashes($row['TelefonoEmpresa']) ?>' /> 
<p><b>CorreoEmpresa:</b><br /><input type='text' name='CorreoEmpresa' value='<?= stripslashes($row['CorreoEmpresa']) ?>' /> 
<p><b>DireccionEmpresa:</b><br /><textarea name='DireccionEmpresa'><?= stripslashes($row['DireccionEmpresa']) ?></textarea> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
