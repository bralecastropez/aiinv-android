<? 
include('config.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `empresacliente` ( `IdCliente` ,  `Nombre` ,  `Direccion` ,  `Correo` ,  `Telefono` ,  `NIT` ,  `Sueldo` ,  `Experiencia`  ) VALUES(  '{$_POST['IdCliente']}' ,  '{$_POST['Nombre']}' ,  '{$_POST['Direccion']}' ,  '{$_POST['Correo']}' ,  '{$_POST['Telefono']}' ,  '{$_POST['NIT']}' ,  '{$_POST['Sueldo']}' ,  '{$_POST['Experiencia']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added row.<br />"; 
echo "<a href='listarEmpresasCliente.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>IdCliente:</b><br /><input type='text' name='IdCliente'/> 
<p><b>Nombre:</b><br /><input type='text' name='Nombre'/> 
<p><b>Direccion:</b><br /><textarea name='Direccion'></textarea> 
<p><b>Correo:</b><br /><input type='text' name='Correo'/> 
<p><b>Telefono:</b><br /><input type='text' name='Telefono'/> 
<p><b>NIT:</b><br /><input type='text' name='NIT'/> 
<p><b>Sueldo:</b><br /><input type='text' name='Sueldo'/> 
<p><b>Experiencia:</b><br /><input type='text' name='Experiencia'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
