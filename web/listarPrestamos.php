<? 
include('session.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>IdPrestamo</b></td>"; 
echo "<td><b>IdUsuario</b></td>"; 
echo "<td><b>IdCliente</b></td>"; 
echo "<td><b>CodigoPrestamo</b></td>"; 
echo "<td><b>FechaDesembolso</b></td>"; 
echo "<td><b>FechaCorte</b></td>"; 
echo "<td><b>Mora</b></td>"; 
echo "<td><b>PeriodoPago</b></td>"; 
echo "<td><b>InteresMensual</b></td>"; 
echo "<td><b>Plazo</b></td>"; 
echo "<td><b>Detalle</b></td>"; 
echo "<td><b>Estado</b></td>"; 
echo "<td><b>MontoPagado</b></td>"; 
echo "<td><b>MontoParcial</b></td>"; 
echo "<td><b>MontoPendiente</b></td>"; 
echo "<td><b>CuotaDiaria</b></td>"; 
echo "<td><b>CuotaSemanal</b></td>"; 
echo "<td><b>CuotaBisemanal</b></td>"; 
echo "<td><b>CuotaMensual</b></td>"; 
echo "<td><b>CuotasPagadas</b></td>"; 
echo "<td><b>CuotasRestantes</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `prestamo`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['IdPrestamo']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['IdUsuario']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['IdCliente']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['CodigoPrestamo']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['FechaDesembolso']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['FechaCorte']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Mora']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['PeriodoPago']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['InteresMensual']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Plazo']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Detalle']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Estado']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['MontoPagado']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['MontoParcial']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['MontoPendiente']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['CuotaDiaria']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['CuotaSemanal']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['CuotaBisemanal']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['CuotaMensual']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['CuotasPagadas']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['CuotasRestantes']) . "</td>";  
echo "<td valign='top'><a href=modificarPrestamo.php?IdPrestamo={$row['IdPrestamo']}>Edit</a></td><td><a href=eliminarPrestamo.php?IdPrestamo={$row['IdPrestamo']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=agregarPrestamo.php>New Row</a>"; 
?>