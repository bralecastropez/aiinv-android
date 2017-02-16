<? 
include('config.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>IdEmpresaCliente</b></td>"; 
echo "<td><b>IdCliente</b></td>"; 
echo "<td><b>Nombre</b></td>"; 
echo "<td><b>Direccion</b></td>"; 
echo "<td><b>Correo</b></td>"; 
echo "<td><b>Telefono</b></td>"; 
echo "<td><b>NIT</b></td>"; 
echo "<td><b>Sueldo</b></td>"; 
echo "<td><b>Experiencia</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `empresacliente`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['IdEmpresaCliente']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['IdCliente']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Nombre']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Direccion']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Correo']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Telefono']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['NIT']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Sueldo']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Experiencia']) . "</td>";  
echo "<td valign='top'><a href=modificarEmpresaCliente.php?IdEmpresaCliente={$row['IdEmpresaCliente']}>Edit</a></td><td><a href=eliminarEmpresaCliente.php?IdEmpresaCliente={$row['IdEmpresaCliente']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=agregarEmpresaCliente.php>New Row</a>"; 
?>