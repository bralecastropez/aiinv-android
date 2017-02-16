<? 
include('config.php'); 
if (isset($_GET['IdCobrador']) ) { 
$IdCobrador = (int) $_GET['IdCobrador']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `cobrador` SET  `CodigoCobrador` =  '{$_POST['CodigoCobrador']}' ,  `Nombre` =  '{$_POST['Nombre']}' ,  `Apellido` =  '{$_POST['Apellido']}' ,  `Direccion` =  '{$_POST['Direccion']}' ,  `Telefono1` =  '{$_POST['Telefono1']}' ,  `Telefono2` =  '{$_POST['Telefono2']}' ,  `Telefono3` =  '{$_POST['Telefono3']}' ,  `Correo` =  '{$_POST['Correo']}' ,  `DPI` =  '{$_POST['DPI']}' ,  `NIT` =  '{$_POST['NIT']}' ,  `Ruta` =  '{$_POST['Ruta']}' ,  `EstadoCivil` =  '{$_POST['EstadoCivil']}' ,  `Sexo` =  '{$_POST['Sexo']}' ,  `FechaCreacion` =  '{$_POST['FechaCreacion']}' ,  `FechaModificacion` =  '{$_POST['FechaModificacion']}'   WHERE `IdCobrador` = '$IdCobrador' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='listarCobradores.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `cobrador` WHERE `IdCobrador` = '$IdCobrador' ")); 
?>

<form action='' method='POST'> 
<p><b>CodigoCobrador:</b><br /><input type='text' name='CodigoCobrador' value='<?= stripslashes($row['CodigoCobrador']) ?>' /> 
<p><b>Nombre:</b><br /><input type='text' name='Nombre' value='<?= stripslashes($row['Nombre']) ?>' /> 
<p><b>Apellido:</b><br /><input type='text' name='Apellido' value='<?= stripslashes($row['Apellido']) ?>' /> 
<p><b>Direccion:</b><br /><textarea name='Direccion'><?= stripslashes($row['Direccion']) ?></textarea> 
<p><b>Telefono1:</b><br /><input type='text' name='Telefono1' value='<?= stripslashes($row['Telefono1']) ?>' /> 
<p><b>Telefono2:</b><br /><input type='text' name='Telefono2' value='<?= stripslashes($row['Telefono2']) ?>' /> 
<p><b>Telefono3:</b><br /><input type='text' name='Telefono3' value='<?= stripslashes($row['Telefono3']) ?>' /> 
<p><b>Correo:</b><br /><input type='text' name='Correo' value='<?= stripslashes($row['Correo']) ?>' /> 
<p><b>DPI:</b><br /><input type='text' name='DPI' value='<?= stripslashes($row['DPI']) ?>' /> 
<p><b>NIT:</b><br /><input type='text' name='NIT' value='<?= stripslashes($row['NIT']) ?>' /> 
<p><b>Ruta:</b><br /><textarea name='Ruta'><?= stripslashes($row['Ruta']) ?></textarea> 
<p><b>EstadoCivil:</b><br /><input type='text' name='EstadoCivil' value='<?= stripslashes($row['EstadoCivil']) ?>' /> 
<p><b>Sexo:</b><br /><input type='text' name='Sexo' value='<?= stripslashes($row['Sexo']) ?>' /> 
<p><b>FechaCreacion:</b><br /><input type='text' name='FechaCreacion' value='<?= stripslashes($row['FechaCreacion']) ?>' /> 
<p><b>FechaModificacion:</b><br /><input type='text' name='FechaModificacion' value='<?= stripslashes($row['FechaModificacion']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
