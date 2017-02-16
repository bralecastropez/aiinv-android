<? 
include('config.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>IdCobrador</b></td>"; 
echo "<td><b>CodigoCobrador</b></td>"; 
echo "<td><b>Nombre</b></td>"; 
echo "<td><b>Apellido</b></td>"; 
echo "<td><b>Direccion</b></td>"; 
echo "<td><b>Telefono1</b></td>"; 
echo "<td><b>Telefono2</b></td>"; 
echo "<td><b>Telefono3</b></td>"; 
echo "<td><b>Correo</b></td>"; 
echo "<td><b>DPI</b></td>"; 
echo "<td><b>NIT</b></td>"; 
echo "<td><b>Ruta</b></td>"; 
echo "<td><b>EstadoCivil</b></td>"; 
echo "<td><b>Sexo</b></td>"; 
echo "<td><b>FechaCreacion</b></td>"; 
echo "<td><b>FechaModificacion</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `cobrador`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['IdCobrador']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['CodigoCobrador']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Nombre']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Apellido']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Direccion']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Telefono1']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Telefono2']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Telefono3']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Correo']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['DPI']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['NIT']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Ruta']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['EstadoCivil']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Sexo']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['FechaCreacion']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['FechaModificacion']) . "</td>";  
echo "<td valign='top'><a href=modificarCobrador.php?IdCobrador={$row['IdCobrador']}>Edit</a></td><td><a href=eliminarCobrador.php?IdCobrador={$row['IdCobrador']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=agregarCobrador.php>New Row</a>"; 
?>