<? 
include('config.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `garantecliente` ( `IdCliente` ,  `Tipo` ,  `Descripcion` ,  `Observacion` ,  `DireccionPropiedad` ,  `TiempoPropiedad` ,  `TipoPropiedad` ,  `DescripcionPropiedad` ,  `TipoVehiculo` ,  `EstadoVehiculo` ,  `UsoVehiculo` ,  `DescripcionVehiculo`  ) VALUES(  '{$_POST['IdCliente']}' ,  '{$_POST['Tipo']}' ,  '{$_POST['Descripcion']}' ,  '{$_POST['Observacion']}' ,  '{$_POST['DireccionPropiedad']}' ,  '{$_POST['TiempoPropiedad']}' ,  '{$_POST['TipoPropiedad']}' ,  '{$_POST['DescripcionPropiedad']}' ,  '{$_POST['TipoVehiculo']}' ,  '{$_POST['EstadoVehiculo']}' ,  '{$_POST['UsoVehiculo']}' ,  '{$_POST['DescripcionVehiculo']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added row.<br />"; 
echo "<a href='listarGarantesCliente.php'>Back To Listing</a>"; 
} 
?>

    <form action='' method='POST'>
        <p>
            <b>IdCliente:</b><br /><input type='text' name='IdCliente' />
        </p>
        <p>
            <b>Tipo:</b><br /><input type='text' name='Tipo' />
        </p>
        <p>
            <b>Descripcion:</b><br /><textarea name='Descripcion'></textarea>
        </p>
        <p>
            <b>Observacion:</b><br /><textarea name='Observacion'></textarea>
        </p>
        <p>
            <b>DireccionPropiedad:</b><br /><textarea name='DireccionPropiedad'></textarea>
        </p>
        <p>
            <b>TiempoPropiedad:</b><br /><input type='text' name='TiempoPropiedad' />
        </p>
        <p>
            <b>TipoPropiedad:</b><br /><input type='text' name='TipoPropiedad' />
        </p>
        <p>
            <b>DescripcionPropiedad:</b><br /><textarea name='DescripcionPropiedad'></textarea>
        </p>
        <p>
            <b>TipoVehiculo:</b><br /><input type='text' name='TipoVehiculo' />
        </p>
        <p>
            <b>EstadoVehiculo:</b><br /><input type='text' name='EstadoVehiculo' />
        </p>
        <p>
            <b>UsoVehiculo:</b><br /><input type='text' name='UsoVehiculo' />
        </p>
        <p>
            <b>DescripcionVehiculo:</b><br /><textarea name='DescripcionVehiculo'></textarea>
        </p>
        <p>
            <input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' />
        </p>
    </form>
    <script type="text/javascript">
        var elegirPropiedad = function() {
            $('#propiedad').collapse('show');
            $('#vehiculo').collapse('hide');
            console.log("elegirPropiedad");
        };
        var elegirVehiculo = function() {
            $('#vehiculo').collapse('show');
            $('#propiedad').collapse('hide');
            console.log("elegirVehiculo");
        };

    </script>
    <div class="btn-group" data-toggle="buttons">
        <!--<button type="button" data-toggle="collapse" data-target="#demo1" class="btn btn-primary">
                                            Opcion 1
                                        </button>-->
        <button type="button" onclick="elegirPropiedad()" class="btn btn-primary">
                                            Opcion 1
                                        </button>
        <button type="button" onclick="elegirVehiculo()" class="btn btn-primary">
                                            Opcion 2
                                        </button>
    </div>
    <div id="propiedad" class="collapse in">
        Contenido Demo 1
    </div>
    <div id="vehiculo" class="collapse">
        Contenido Demo 2
    </div>
