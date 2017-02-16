<? 
include('session.php'); 
if (isset($_GET['IdPrestamo']) ) { 
$IdPrestamo = (int) $_GET['IdPrestamo']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `prestamo` SET  `IdUsuario` =  '{$_POST['IdUsuario']}' ,  `IdCliente` =  '{$_POST['IdCliente']}' ,  `CodigoPrestamo` =  '{$_POST['CodigoPrestamo']}' ,  `FechaDesembolso` =  '{$_POST['FechaDesembolso']}' ,  `FechaCorte` =  '{$_POST['FechaCorte']}' ,  `Mora` =  '{$_POST['Mora']}' ,  `PeriodoPago` =  '{$_POST['PeriodoPago']}' ,  `InteresMensual` =  '{$_POST['InteresMensual']}' ,  `Plazo` =  '{$_POST['Plazo']}' ,  `Detalle` =  '{$_POST['Detalle']}' ,  `Estado` =  '{$_POST['Estado']}' ,  `MontoPagado` =  '{$_POST['MontoPagado']}' ,  `MontoParcial` =  '{$_POST['MontoParcial']}' ,  `MontoPendiente` =  '{$_POST['MontoPendiente']}' ,  `CuotaDiaria` =  '{$_POST['CuotaDiaria']}' ,  `CuotaSemanal` =  '{$_POST['CuotaSemanal']}' ,  `CuotaBisemanal` =  '{$_POST['CuotaBisemanal']}' ,  `CuotaMensual` =  '{$_POST['CuotaMensual']}' ,  `CuotasPagadas` =  '{$_POST['CuotasPagadas']}' ,  `CuotasRestantes` =  '{$_POST['CuotasRestantes']}'   WHERE `IdPrestamo` = '$IdPrestamo' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='listarPrestamos.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `prestamo` WHERE `IdPrestamo` = '$IdPrestamo' ")); 
?>

<form action='' method='POST'> 
<p><b>IdUsuario:</b><br /><input type='text' name='IdUsuario' value='<?= stripslashes($row['IdUsuario']) ?>' /> 
<p><b>IdCliente:</b><br /><input type='text' name='IdCliente' value='<?= stripslashes($row['IdCliente']) ?>' /> 
<p><b>CodigoPrestamo:</b><br /><input type='text' name='CodigoPrestamo' value='<?= stripslashes($row['CodigoPrestamo']) ?>' /> 
<p><b>FechaDesembolso:</b><br /><input type='text' name='FechaDesembolso' value='<?= stripslashes($row['FechaDesembolso']) ?>' /> 
<p><b>FechaCorte:</b><br /><input type='text' name='FechaCorte' value='<?= stripslashes($row['FechaCorte']) ?>' /> 
<p><b>Mora:</b><br /><input type='text' name='Mora' value='<?= stripslashes($row['Mora']) ?>' /> 
<p><b>PeriodoPago:</b><br /><input type='text' name='PeriodoPago' value='<?= stripslashes($row['PeriodoPago']) ?>' /> 
<p><b>InteresMensual:</b><br /><input type='text' name='InteresMensual' value='<?= stripslashes($row['InteresMensual']) ?>' /> 
<p><b>Plazo:</b><br /><input type='text' name='Plazo' value='<?= stripslashes($row['Plazo']) ?>' /> 
<p><b>Detalle:</b><br /><textarea name='Detalle'><?= stripslashes($row['Detalle']) ?></textarea> 
<p><b>Estado:</b><br /><input type='text' name='Estado' value='<?= stripslashes($row['Estado']) ?>' /> 
<p><b>MontoPagado:</b><br /><input type='text' name='MontoPagado' value='<?= stripslashes($row['MontoPagado']) ?>' /> 
<p><b>MontoParcial:</b><br /><input type='text' name='MontoParcial' value='<?= stripslashes($row['MontoParcial']) ?>' /> 
<p><b>MontoPendiente:</b><br /><input type='text' name='MontoPendiente' value='<?= stripslashes($row['MontoPendiente']) ?>' /> 
<p><b>CuotaDiaria:</b><br /><input type='text' name='CuotaDiaria' value='<?= stripslashes($row['CuotaDiaria']) ?>' /> 
<p><b>CuotaSemanal:</b><br /><input type='text' name='CuotaSemanal' value='<?= stripslashes($row['CuotaSemanal']) ?>' /> 
<p><b>CuotaBisemanal:</b><br /><input type='text' name='CuotaBisemanal' value='<?= stripslashes($row['CuotaBisemanal']) ?>' /> 
<p><b>CuotaMensual:</b><br /><input type='text' name='CuotaMensual' value='<?= stripslashes($row['CuotaMensual']) ?>' /> 
<p><b>CuotasPagadas:</b><br /><input type='text' name='CuotasPagadas' value='<?= stripslashes($row['CuotasPagadas']) ?>' /> 
<p><b>CuotasRestantes:</b><br /><input type='text' name='CuotasRestantes' value='<?= stripslashes($row['CuotasRestantes']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
