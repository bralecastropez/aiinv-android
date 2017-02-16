<? 
include('config.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>IdGaranteCliente</b></td>"; 
echo "<td><b>IdCliente</b></td>"; 
echo "<td><b>Tipo</b></td>"; 
echo "<td><b>Descripcion</b></td>"; 
echo "<td><b>Observacion</b></td>"; 
echo "<td><b>DireccionPropiedad</b></td>"; 
echo "<td><b>TiempoPropiedad</b></td>"; 
echo "<td><b>TipoPropiedad</b></td>"; 
echo "<td><b>DescripcionPropiedad</b></td>"; 
echo "<td><b>TipoVehiculo</b></td>"; 
echo "<td><b>EstadoVehiculo</b></td>"; 
echo "<td><b>UsoVehiculo</b></td>"; 
echo "<td><b>DescripcionVehiculo</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `garantecliente`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['IdGaranteCliente']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['IdCliente']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Tipo']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Descripcion']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Observacion']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['DireccionPropiedad']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['TiempoPropiedad']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['TipoPropiedad']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['DescripcionPropiedad']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['TipoVehiculo']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['EstadoVehiculo']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['UsoVehiculo']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['DescripcionVehiculo']) . "</td>";  
echo "<td valign='top'><a href=modificarGaranteCliente.php?IdGaranteCliente={$row['IdGaranteCliente']}>Edit</a></td><td><a href=eliminarGaranteCliente.php?IdGaranteCliente={$row['IdGaranteCliente']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=agregarGaranteCliente.php>New Row</a>"; 
?>