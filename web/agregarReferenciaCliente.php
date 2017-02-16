<? 
include('config.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `referenciacliente` ( `IdCliente` ,  `Nombre` ,  `DPI` ,  `Telefono` ,  `DescripcionTelefono` ,  `Correo` ,  `Direccion` ,  `NombreEmpresa` ,  `NitEmpresa` ,  `TelefonoEmpresa` ,  `CorreoEmpresa` ,  `DireccionEmpresa`  ) VALUES(  '{$_POST['IdCliente']}' ,  '{$_POST['Nombre']}' ,  '{$_POST['DPI']}' ,  '{$_POST['Telefono']}' ,  '{$_POST['DescripcionTelefono']}' ,  '{$_POST['Correo']}' ,  '{$_POST['Direccion']}' ,  '{$_POST['NombreEmpresa']}' ,  '{$_POST['NitEmpresa']}' ,  '{$_POST['TelefonoEmpresa']}' ,  '{$_POST['CorreoEmpresa']}' ,  '{$_POST['DireccionEmpresa']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added row.<br />"; 
echo "<a href='listarReferenciasCliente.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>IdCliente:</b><br /><input type='text' name='IdCliente'/> 
<p><b>Nombre:</b><br /><input type='text' name='Nombre'/> 
<p><b>DPI:</b><br /><input type='text' name='DPI'/> 
<p><b>Telefono:</b><br /><input type='text' name='Telefono'/> 
<p><b>DescripcionTelefono:</b><br /><input type='text' name='DescripcionTelefono'/> 
<p><b>Correo:</b><br /><input type='text' name='Correo'/> 
<p><b>Direccion:</b><br /><textarea name='Direccion'></textarea> 
<p><b>NombreEmpresa:</b><br /><input type='text' name='NombreEmpresa'/> 
<p><b>NitEmpresa:</b><br /><input type='text' name='NitEmpresa'/> 
<p><b>TelefonoEmpresa:</b><br /><input type='text' name='TelefonoEmpresa'/> 
<p><b>CorreoEmpresa:</b><br /><input type='text' name='CorreoEmpresa'/> 
<p><b>DireccionEmpresa:</b><br /><textarea name='DireccionEmpresa'></textarea> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
