<? 
include('session.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `prestamo` ( `IdUsuario` ,  `IdCliente` ,  `CodigoPrestamo` ,  `FechaDesembolso` ,  `FechaCorte` ,  `Mora` ,  `PeriodoPago` ,  `InteresMensual` ,  `Plazo` ,  `Detalle` ,  `Estado` ,  `MontoPagado` ,  `MontoParcial` ,  `MontoPendiente` ,  `CuotaDiaria` ,  `CuotaSemanal` ,  `CuotaBisemanal` ,  `CuotaMensual` ,  `CuotasPagadas` ,  `CuotasRestantes`  ) VALUES(  '{$_POST['IdUsuario']}' ,  '{$_POST['IdCliente']}' ,  '{$_POST['CodigoPrestamo']}' ,  '{$_POST['FechaDesembolso']}' ,  '{$_POST['FechaCorte']}' ,  '{$_POST['Mora']}' ,  '{$_POST['PeriodoPago']}' ,  '{$_POST['InteresMensual']}' ,  '{$_POST['Plazo']}' ,  '{$_POST['Detalle']}' ,  '{$_POST['Estado']}' ,  '{$_POST['MontoPagado']}' ,  '{$_POST['MontoParcial']}' ,  '{$_POST['MontoPendiente']}' ,  '{$_POST['CuotaDiaria']}' ,  '{$_POST['CuotaSemanal']}' ,  '{$_POST['CuotaBisemanal']}' ,  '{$_POST['CuotaMensual']}' ,  '{$_POST['CuotasPagadas']}' ,  '{$_POST['CuotasRestantes']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added row.<br />"; 
echo "<a href='listarPrestamos.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>IdUsuario:</b><br /><input type='text' name='IdUsuario'/> 
<p><b>IdCliente:</b><br /><input type='text' name='IdCliente'/> 
<p><b>CodigoPrestamo:</b><br /><input type='text' name='CodigoPrestamo'/> 
<p><b>FechaDesembolso:</b><br /><input type='text' name='FechaDesembolso'/> 
<p><b>FechaCorte:</b><br /><input type='text' name='FechaCorte'/> 
<p><b>Mora:</b><br /><input type='text' name='Mora'/> 
<p><b>PeriodoPago:</b><br /><input type='text' name='PeriodoPago'/> 
<p><b>InteresMensual:</b><br /><input type='text' name='InteresMensual'/> 
<p><b>Plazo:</b><br /><input type='text' name='Plazo'/> 
<p><b>Detalle:</b><br /><textarea name='Detalle'></textarea> 
<p><b>Estado:</b><br /><input type='text' name='Estado'/> 
<p><b>MontoPagado:</b><br /><input type='text' name='MontoPagado'/> 
<p><b>MontoParcial:</b><br /><input type='text' name='MontoParcial'/> 
<p><b>MontoPendiente:</b><br /><input type='text' name='MontoPendiente'/> 
<p><b>CuotaDiaria:</b><br /><input type='text' name='CuotaDiaria'/> 
<p><b>CuotaSemanal:</b><br /><input type='text' name='CuotaSemanal'/> 
<p><b>CuotaBisemanal:</b><br /><input type='text' name='CuotaBisemanal'/> 
<p><b>CuotaMensual:</b><br /><input type='text' name='CuotaMensual'/> 
<p><b>CuotasPagadas:</b><br /><input type='text' name='CuotasPagadas'/> 
<p><b>CuotasRestantes:</b><br /><input type='text' name='CuotasRestantes'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
