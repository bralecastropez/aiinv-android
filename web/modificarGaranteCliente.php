<? 
include('config.php'); 
if (isset($_GET['IdGaranteCliente']) ) { 
$IdGaranteCliente = (int) $_GET['IdGaranteCliente']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `garantecliente` SET  `IdCliente` =  '{$_POST['IdCliente']}' ,  `Tipo` =  '{$_POST['Tipo']}' ,  `Descripcion` =  '{$_POST['Descripcion']}' ,  `Observacion` =  '{$_POST['Observacion']}' ,  `DireccionPropiedad` =  '{$_POST['DireccionPropiedad']}' ,  `TiempoPropiedad` =  '{$_POST['TiempoPropiedad']}' ,  `TipoPropiedad` =  '{$_POST['TipoPropiedad']}' ,  `DescripcionPropiedad` =  '{$_POST['DescripcionPropiedad']}' ,  `TipoVehiculo` =  '{$_POST['TipoVehiculo']}' ,  `EstadoVehiculo` =  '{$_POST['EstadoVehiculo']}' ,  `UsoVehiculo` =  '{$_POST['UsoVehiculo']}' ,  `DescripcionVehiculo` =  '{$_POST['DescripcionVehiculo']}'   WHERE `IdGaranteCliente` = '$IdGaranteCliente' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='listarGarantesCliente.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `garantecliente` WHERE `IdGaranteCliente` = '$IdGaranteCliente' ")); 
?>

<form action='' method='POST'> 
<p><b>IdCliente:</b><br /><input type='text' name='IdCliente' value='<?= stripslashes($row['IdCliente']) ?>' /> 
<p><b>Tipo:</b><br /><input type='text' name='Tipo' value='<?= stripslashes($row['Tipo']) ?>' /> 
<p><b>Descripcion:</b><br /><textarea name='Descripcion'><?= stripslashes($row['Descripcion']) ?></textarea> 
<p><b>Observacion:</b><br /><textarea name='Observacion'><?= stripslashes($row['Observacion']) ?></textarea> 
<p><b>DireccionPropiedad:</b><br /><textarea name='DireccionPropiedad'><?= stripslashes($row['DireccionPropiedad']) ?></textarea> 
<p><b>TiempoPropiedad:</b><br /><input type='text' name='TiempoPropiedad' value='<?= stripslashes($row['TiempoPropiedad']) ?>' /> 
<p><b>TipoPropiedad:</b><br /><input type='text' name='TipoPropiedad' value='<?= stripslashes($row['TipoPropiedad']) ?>' /> 
<p><b>DescripcionPropiedad:</b><br /><textarea name='DescripcionPropiedad'><?= stripslashes($row['DescripcionPropiedad']) ?></textarea> 
<p><b>TipoVehiculo:</b><br /><input type='text' name='TipoVehiculo' value='<?= stripslashes($row['TipoVehiculo']) ?>' /> 
<p><b>EstadoVehiculo:</b><br /><input type='text' name='EstadoVehiculo' value='<?= stripslashes($row['EstadoVehiculo']) ?>' /> 
<p><b>UsoVehiculo:</b><br /><input type='text' name='UsoVehiculo' value='<?= stripslashes($row['UsoVehiculo']) ?>' /> 
<p><b>DescripcionVehiculo:</b><br /><textarea name='DescripcionVehiculo'><?= stripslashes($row['DescripcionVehiculo']) ?></textarea> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
