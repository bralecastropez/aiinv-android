<?php
    require_once("config/db/session.php");
    $page_title = "Agregar Garante";
    $page_maintance = true;
    require_once("config/page/header.php");

    if(isset($_GET['IdCliente'])) {
        $IdCliente = (int) $_GET['IdCliente'];
    }
    if(isset($_GET['Referencia'])) {
        $url_referencia = $_GET['Referencia'];
    }

    if(isset($_POST['EleccionPropiedad'])) {
        foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
        $sql = "INSERT INTO `garantecliente` ( `IdCliente` ,  `Tipo` ,  `Descripcion` ,  `Observacion` ,  `DireccionPropiedad` ,  `TiempoPropiedad` ,  `TipoPropiedad` ,  `DescripcionPropiedad`) VALUES(  '{$_POST['IdCliente']}' ,  'Propiedad' ,  '{$_POST['Descripcion']}' ,  '{$_POST['Observacion']}' ,  '{$_POST['DireccionPropiedad']}' ,  '{$_POST['TiempoPropiedad']}' ,  '{$_POST['TipoPropiedad']}' ,  '{$_POST['DescripcionPropiedad']}') "; 
        mysql_query($sql) or die(mysql_error()); 
        redirect($url_referencia);
    }
    if(isset($_POST['EleccionVehiculo'])) {
        foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
        $sql = "INSERT INTO `garantecliente` ( `IdCliente` ,  `Tipo` ,  `Descripcion` ,  `Observacion` ,  `TipoVehiculo` ,  `EstadoVehiculo` ,  `UsoVehiculo` ,  `DescripcionVehiculo`  ) VALUES(  '$IdCliente' ,  '{$_POST['Tipo']}' ,  '{$_POST['Descripcion']}' ,  '{$_POST['Observacion']}', '{$_POST['TipoVehiculo']}' ,  '{$_POST['EstadoVehiculo']}' ,  '{$_POST['UsoVehiculo']}' ,  '{$_POST['DescripcionVehiculo']}') "; 
        mysql_query($sql) or die(mysql_error()); 
        redirect($url_referencia);
    }
?>

    <div class="Container100">
        <br/>
        <br/>
        <div class="Container100">
            <div class="ContainerIndent TextAlCenter">
                <h5>Datos del Garante</h5>
            </div>
            <hr/>
        </div>
        <div class="ContainerIndent">
            <div class="Container100">
                <div class="ContainerIndent">
                    <p>
                        <b>Seleccione un Tipo:</b>
                        <div class="btn-group" data-toggle="buttons">
                            <button type="button" onclick="elegirPropiedad()" class="btn btn-primary">
                                    Propiedad
                                </button>
                            <button type="button" onclick="elegirVehiculo()" class="btn btn-primary">
                                    Veh&iacute;culo
                                </button>
                        </div>
                    </p>
                </div>
            </div>

            <div id="propiedad" class="collapse in">

                <form method="post" action="" data-toggle="validator" role="form">
                    <div class="Container50 MaintanceResponsive">
                        <div class="ContainerIndent">
                            <p>
                                <b>Ingrese una Descripci&oacute;n (Opcional):</b><br />
                                <textarea type='text' name='Descripcion' placeholder="Descripci&oacute;n" class="md-textarea"></textarea>
                            </p>
                        </div>
                    </div>
                    <div class="Container50 MaintanceResponsive">
                        <div class="ContainerIndent">
                            <p>
                                <b>Ingrese una Observaci&oacute;n (Opcional):</b><br />
                                <textarea type='text' name='Observacion' placeholder="Observaci&oacute;n" class="md-textarea"></textarea>
                            </p>
                        </div>
                    </div>
                    <br/>
                    <div class="Container100">
                        <div class="ContainerIndent TextAlCenter">
                            <h5>Datos de la Propiedad</h5>
                        </div>
                        <hr/>
                    </div>
                    <div class="Container50 MaintanceResponsive">
                        <div class="ContainerIndent">
                            <p>
                                <b>Ingrese una Direcci&oacute;n:</b><br />
                                <textarea type='text' name='DireccionPropiedad' placeholder="Direcci&oacute;n" class="md-textarea"></textarea>
                            </p>
                            <p>
                                <b>Tiempo de la Propiedad:</b><br/>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="TiempoPropiedad">
                                    <div class="input-group-addon">A&ntilde;o(s)</div>
                                </div>
                            </p>
                        </div>
                    </div>
                    <div class="Container50 MaintanceResponsive">
                        <div class="ContainerIndent">
                            <p>
                                <b>Ingrese una Descripci&oacute;n de la Propiedad (Opcional):</b><br />
                                <textarea type='text' name='DescripcionPropiedad' placeholder="Descripci&oacute;n" class="md-textarea"></textarea>
                            </p>
                            <p>
                                <b>Seleccione el Tipo de Propiedad:</b>
                                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                                    <select name="TipoPropiedad" class="mdl-selectfield__select">
                                        <option value="" selected></option>
                                        <option value="Propia">Propia</option>
                                        <option value="Alquilada">Alquilada</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                    <label class="mdl-textfield__label" for="TipoPropiedad">Tipo de Propiedad</label>
                                    <span class="mdl-selectfield__error">Seleccione un tipo de propiedad</span>
                                </div>
                            </p>
                        </div>
                    </div>
                    <div class="Container100">
                        <div class="ContainerIndent">
                            <p>
                                <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="regresar()">
                                        Cancelar
                                    </button>
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type='submit' style="color: white;">
                                        Agregar
                                    </button>
                                <input type="hidden" value="Propiedad" name="Tipo" />
                                <input type="hidden" value="<?php echo $IdCliente; ?>" name="IdCliente" />
                                <input type='hidden' value='1' name='EleccionPropiedad' />
                            </p>
                        </div>
                    </div>
                </form>
            </div>
            <div id="vehiculo" class="collapse">
                <form method="post" action="" data-toggle="validator" role="form">
                    <div class="Container50 MaintanceResponsive">
                        <div class="ContainerIndent">
                            <p>
                                <b>Ingrese una Descripci&oacute;n (Opcional):</b><br />
                                <textarea type='text' name='Descripcion' placeholder="Descripci&oacute;n" class="md-textarea"></textarea>
                            </p>
                        </div>
                    </div>
                    <div class="Container50 MaintanceResponsive">
                        <div class="ContainerIndent">
                            <p>
                                <b>Ingrese una Observaci&oacute;n (Opcional):</b><br />
                                <textarea type='text' name='Observacion' placeholder="Observaci&oacute;n" class="md-textarea"></textarea>
                            </p>
                        </div>
                    </div>
                    <br/>
                    <div class="Container100">
                        <div class="ContainerIndent TextAlCenter">
                            <h5>Datos del Veh&iacute;culo</h5>
                        </div>
                        <hr/>
                    </div>
                    <div class="Container50 MaintanceResponsive">
                        <div class="ContainerIndent">
                            <p>
                                <b>Seleccione el Estado del Veh&iacute;culo:</b>
                                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                                    <select name="EstadoVehiculo" class="mdl-selectfield__select">
                                        <option value="" selected></option>
                                        <option value="Propio">Nuevo</option>
                                        <option value="Alquilado">Usado</option>
                                    </select>
                                    <label class="mdl-textfield__label" for="EstadoVehiculo">Estado del Veh&iacute;culo</label>
                                    <span class="mdl-selectfield__error">Seleccione el estado del veh&iacute;culo</span>
                                </div>
                            </p>
                            <p>
                                <b>Uso del Veh&iacute;culo:</b><br/>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="UsoVehiculo">
                                    <div class="input-group-addon">A&ntilde;o(s)</div>
                                </div>
                            </p>
                        </div>
                    </div>
                    <div class="Container50 MaintanceResponsive">
                        <div class="ContainerIndent">
                            <p>
                                <b>Seleccione el Tipo de Veh&iacute;culo:</b>
                                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                                    <select name="TipoVehiculo" class="mdl-selectfield__select">
                                        <option value="" selected></option>
                                        <option value="Propio">Propio</option>
                                        <option value="Alquilado">Alquilado</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                    <label class="mdl-textfield__label" for="TipoVehiculo">Tipo de Veh&iacute;culo</label>
                                    <span class="mdl-selectfield__error">Seleccione un tipo de veh&iacute;culo</span>
                                </div>
                            </p>
                            <p>
                                <b>Ingrese una Descripci&oacute;n del Veh&iacute;culo (Opcional):</b><br />
                                <textarea type='text' name='DescripcionVehiculo' placeholder="Descripci&oacute;n" class="md-textarea"></textarea>
                            </p>
                        </div>
                    </div>
                    <div class="Container100">
                        <div class="ContainerIndent">
                            <p>

                                <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="regresar()">
                                        Cancelar
                                    </button>
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type='submit' style="color: white;">
                                        Agregar
                                    </button>
                                <input type="hidden" name="Tipo" value="Vehiculo" />
                                <input type="hidden" name="IdCliente" value="<?php echo $IdCliente; ?>" />
                                <input type='hidden' value='1' name='EleccionVehiculo' />
                            </p>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        var elegirPropiedad = function() {
            $('#propiedad').collapse('show');
            $('#vehiculo').collapse('hide');
        };
        var elegirVehiculo = function() {
            $('#vehiculo').collapse('show');
            $('#propiedad').collapse('hide');
        };

        var regresar = function() {
            window.location.href = '<?php echo $url_referencia; ?>';
        };

    </script>
    <?php 
        require_once("config/page/footer.php"); 
    ?>
