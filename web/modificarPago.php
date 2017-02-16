<? 
include('config.php'); 
if (isset($_GET['IdPago']) ) { 
$IdPago = (int) $_GET['IdPago']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `pago` SET  `IdPrestamo` =  '{$_POST['IdPrestamo']}' ,  `CodigoPago` =  '{$_POST['CodigoPago']}' ,  `NoPago` =  '{$_POST['NoPago']}' ,  `Fecha` =  '{$_POST['Fecha']}' ,  `Estado` =  '{$_POST['Estado']}' ,  `TipoPago` =  '{$_POST['TipoPago']}' ,  `CantidadPagada` =  '{$_POST['CantidadPagada']}' ,  `NoCheque` =  '{$_POST['NoCheque']}' ,  `BancoCheque` =  '{$_POST['BancoCheque']}' ,  `BancoTransferencia` =  '{$_POST['BancoTransferencia']}' ,  `ReferenciaTransferencia` =  '{$_POST['ReferenciaTransferencia']}' ,  `NoTransferencia` =  '{$_POST['NoTransferencia']}'   WHERE `IdPago` = '$IdPago' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='listarPagos.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `pago` WHERE `IdPago` = '$IdPago' ")); 
?>

<form action='' method='POST'> 
<p><b>IdPrestamo:</b><br /><input type='text' name='IdPrestamo' value='<?= stripslashes($row['IdPrestamo']) ?>' /> 
<p><b>CodigoPago:</b><br /><input type='text' name='CodigoPago' value='<?= stripslashes($row['CodigoPago']) ?>' /> 
<p><b>NoPago:</b><br /><input type='text' name='NoPago' value='<?= stripslashes($row['NoPago']) ?>' /> 
<p><b>Fecha:</b><br /><input type='text' name='Fecha' value='<?= stripslashes($row['Fecha']) ?>' /> 
<p><b>Estado:</b><br /><input type='text' name='Estado' value='<?= stripslashes($row['Estado']) ?>' /> 
<p><b>TipoPago:</b><br /><input type='text' name='TipoPago' value='<?= stripslashes($row['TipoPago']) ?>' /> 
<p><b>CantidadPagada:</b><br /><input type='text' name='CantidadPagada' value='<?= stripslashes($row['CantidadPagada']) ?>' /> 
<p><b>NoCheque:</b><br /><input type='text' name='NoCheque' value='<?= stripslashes($row['NoCheque']) ?>' /> 
<p><b>BancoCheque:</b><br /><input type='text' name='BancoCheque' value='<?= stripslashes($row['BancoCheque']) ?>' /> 
<p><b>BancoTransferencia:</b><br /><input type='text' name='BancoTransferencia' value='<?= stripslashes($row['BancoTransferencia']) ?>' /> 
<p><b>ReferenciaTransferencia:</b><br /><input type='text' name='ReferenciaTransferencia' value='<?= stripslashes($row['ReferenciaTransferencia']) ?>' /> 
<p><b>NoTransferencia:</b><br /><input type='text' name='NoTransferencia' value='<?= stripslashes($row['NoTransferencia']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
