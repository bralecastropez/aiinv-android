<? 
include('config.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `garantecliente` ( `IdCliente` ,  `Tipo` ,  `Descripcion` ,  `Observacion` ,  `DireccionPropiedad` ,  `TiempoPropiedad` ,  `TipoPropiedad` ,  `DescripcionPropiedad` ,  `TipoVehiculo` ,  `EstadoVehiculo` ,  `UsoVehiculo` ,  `DescripcionVehiculo`  ) VALUES(  '{$_POST['IdCliente']}' ,  '{$_POST['Tipo']}' ,  '{$_POST['Descripcion']}' ,  '{$_POST['Observacion']}' ,  '{$_POST['DireccionPropiedad']}' ,  '{$_POST['TiempoPropiedad']}' ,  '{$_POST['TipoPropiedad']}' ,  '{$_POST['DescripcionPropiedad']}' ,  '{$_POST['TipoVehiculo']}' ,  '{$_POST['EstadoVehiculo']}' ,  '{$_POST['UsoVehiculo']}' ,  '{$_POST['DescripcionVehiculo']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added row.<br />"; 
echo "<a href='listarGarantesCliente.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>IdCliente:</b><br /><input type='text' name='IdCliente'/> 
<p><b>Tipo:</b><br /><input type='text' name='Tipo'/> 
<p><b>Descripcion:</b><br /><textarea name='Descripcion'></textarea> 
<p><b>Observacion:</b><br /><textarea name='Observacion'></textarea> 
<p><b>DireccionPropiedad:</b><br /><textarea name='DireccionPropiedad'></textarea> 
<p><b>TiempoPropiedad:</b><br /><input type='text' name='TiempoPropiedad'/> 
<p><b>TipoPropiedad:</b><br /><input type='text' name='TipoPropiedad'/> 
<p><b>DescripcionPropiedad:</b><br /><textarea name='DescripcionPropiedad'></textarea> 
<p><b>TipoVehiculo:</b><br /><input type='text' name='TipoVehiculo'/> 
<p><b>EstadoVehiculo:</b><br /><input type='text' name='EstadoVehiculo'/> 
<p><b>UsoVehiculo:</b><br /><input type='text' name='UsoVehiculo'/> 
<p><b>DescripcionVehiculo:</b><br /><textarea name='DescripcionVehiculo'></textarea> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
