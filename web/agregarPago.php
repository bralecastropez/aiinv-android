<? 
include('config.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `pago` ( `IdPrestamo` ,  `CodigoPago` ,  `NoPago` ,  `Fecha` ,  `Estado` ,  `TipoPago` ,  `CantidadPagada` ,  `NoCheque` ,  `BancoCheque` ,  `BancoTransferencia` ,  `ReferenciaTransferencia` ,  `NoTransferencia`  ) VALUES(  '{$_POST['IdPrestamo']}' ,  '{$_POST['CodigoPago']}' ,  '{$_POST['NoPago']}' ,  '{$_POST['Fecha']}' ,  '{$_POST['Estado']}' ,  '{$_POST['TipoPago']}' ,  '{$_POST['CantidadPagada']}' ,  '{$_POST['NoCheque']}' ,  '{$_POST['BancoCheque']}' ,  '{$_POST['BancoTransferencia']}' ,  '{$_POST['ReferenciaTransferencia']}' ,  '{$_POST['NoTransferencia']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added row.<br />"; 
echo "<a href='listarPagos.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>IdPrestamo:</b><br /><input type='text' name='IdPrestamo'/> 
<p><b>CodigoPago:</b><br /><input type='text' name='CodigoPago'/> 
<p><b>NoPago:</b><br /><input type='text' name='NoPago'/> 
<p><b>Fecha:</b><br /><input type='text' name='Fecha'/> 
<p><b>Estado:</b><br /><input type='text' name='Estado'/> 
<p><b>TipoPago:</b><br /><input type='text' name='TipoPago'/> 
<p><b>CantidadPagada:</b><br /><input type='text' name='CantidadPagada'/> 
<p><b>NoCheque:</b><br /><input type='text' name='NoCheque'/> 
<p><b>BancoCheque:</b><br /><input type='text' name='BancoCheque'/> 
<p><b>BancoTransferencia:</b><br /><input type='text' name='BancoTransferencia'/> 
<p><b>ReferenciaTransferencia:</b><br /><input type='text' name='ReferenciaTransferencia'/> 
<p><b>NoTransferencia:</b><br /><input type='text' name='NoTransferencia'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
