<? 
include('config.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `cobrador` ( `CodigoCobrador` ,  `Nombre` ,  `Apellido` ,  `Direccion` ,  `Telefono1` ,  `Telefono2` ,  `Telefono3` ,  `Correo` ,  `DPI` ,  `NIT` ,  `Ruta` ,  `EstadoCivil` ,  `Sexo` ,  `FechaCreacion` ,  `FechaModificacion`  ) VALUES(  '{$_POST['CodigoCobrador']}' ,  '{$_POST['Nombre']}' ,  '{$_POST['Apellido']}' ,  '{$_POST['Direccion']}' ,  '{$_POST['Telefono1']}' ,  '{$_POST['Telefono2']}' ,  '{$_POST['Telefono3']}' ,  '{$_POST['Correo']}' ,  '{$_POST['DPI']}' ,  '{$_POST['NIT']}' ,  '{$_POST['Ruta']}' ,  '{$_POST['EstadoCivil']}' ,  '{$_POST['Sexo']}' ,  '{$_POST['FechaCreacion']}' ,  '{$_POST['FechaModificacion']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added row.<br />"; 
echo "<a href='listarCobradores.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>CodigoCobrador:</b><br /><input type='text' name='CodigoCobrador'/> 
<p><b>Nombre:</b><br /><input type='text' name='Nombre'/> 
<p><b>Apellido:</b><br /><input type='text' name='Apellido'/> 
<p><b>Direccion:</b><br /><textarea name='Direccion'></textarea> 
<p><b>Telefono1:</b><br /><input type='text' name='Telefono1'/> 
<p><b>Telefono2:</b><br /><input type='text' name='Telefono2'/> 
<p><b>Telefono3:</b><br /><input type='text' name='Telefono3'/> 
<p><b>Correo:</b><br /><input type='text' name='Correo'/> 
<p><b>DPI:</b><br /><input type='text' name='DPI'/> 
<p><b>NIT:</b><br /><input type='text' name='NIT'/> 
<p><b>Ruta:</b><br /><textarea name='Ruta'></textarea> 
<p><b>EstadoCivil:</b><br /><input type='text' name='EstadoCivil'/> 
<p><b>Sexo:</b><br /><input type='text' name='Sexo'/> 
<p><b>FechaCreacion:</b><br /><input type='text' name='FechaCreacion'/> 
<p><b>FechaModificacion:</b><br /><input type='text' name='FechaModificacion'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
