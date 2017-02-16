<? 
include('config.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>IdPago</b></td>"; 
echo "<td><b>IdPrestamo</b></td>"; 
echo "<td><b>CodigoPago</b></td>"; 
echo "<td><b>NoPago</b></td>"; 
echo "<td><b>Fecha</b></td>"; 
echo "<td><b>Estado</b></td>"; 
echo "<td><b>TipoPago</b></td>"; 
echo "<td><b>CantidadPagada</b></td>"; 
echo "<td><b>NoCheque</b></td>"; 
echo "<td><b>BancoCheque</b></td>"; 
echo "<td><b>BancoTransferencia</b></td>"; 
echo "<td><b>ReferenciaTransferencia</b></td>"; 
echo "<td><b>NoTransferencia</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `pago`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['IdPago']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['IdPrestamo']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['CodigoPago']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['NoPago']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Fecha']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Estado']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['TipoPago']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['CantidadPagada']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['NoCheque']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['BancoCheque']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['BancoTransferencia']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['ReferenciaTransferencia']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['NoTransferencia']) . "</td>";  
echo "<td valign='top'><a href=modificarPago.php?IdPago={$row['IdPago']}>Edit</a></td><td><a href=eliminarPago.php?IdPago={$row['IdPago']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=agregarPago.php>New Row</a>"; 
?>