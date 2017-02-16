<? 
include('config.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>IdReferenciaCliente</b></td>"; 
echo "<td><b>IdCliente</b></td>"; 
echo "<td><b>Nombre</b></td>"; 
echo "<td><b>DPI</b></td>"; 
echo "<td><b>Telefono</b></td>"; 
echo "<td><b>DescripcionTelefono</b></td>"; 
echo "<td><b>Correo</b></td>"; 
echo "<td><b>Direccion</b></td>"; 
echo "<td><b>NombreEmpresa</b></td>"; 
echo "<td><b>NitEmpresa</b></td>"; 
echo "<td><b>TelefonoEmpresa</b></td>"; 
echo "<td><b>CorreoEmpresa</b></td>"; 
echo "<td><b>DireccionEmpresa</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `referenciacliente`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['IdReferenciaCliente']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['IdCliente']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Nombre']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['DPI']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Telefono']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['DescripcionTelefono']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Correo']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Direccion']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['NombreEmpresa']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['NitEmpresa']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['TelefonoEmpresa']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['CorreoEmpresa']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['DireccionEmpresa']) . "</td>";  
echo "<td valign='top'><a href=modificarReferenciaCliente.php?IdReferenciaCliente={$row['IdReferenciaCliente']}>Edit</a></td><td><a href=eliminarReferenciaCliente.php?IdReferenciaCliente={$row['IdReferenciaCliente']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=agregarReferenciaCliente.php>New Row</a>"; 
?>