<?php
    require_once("config/db/session.php");
    $page_title = "Editar Garante";
    $page_maintance = true;
    require_once("config/page/header.php");

    $TiposDePropiedad = array("Propia", "Alquilada", "Otro");
    $TiposDeVehiculos = array("Propio", "Alquilado", "Otro");
    $TiposDeEstadoVehiculos = array("Nuevo", "Usado");

    if(isset($_GET['Referencia'])) {
        $url_referencia = $_GET['Referencia'];
    }

    if (isset($_GET['IdGaranteCliente']) ) { 
        $IdGaranteCliente = (int) $_GET['IdGaranteCliente']; 
        if (isset($_POST['EleccionPropiedad'])) { 
            foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
            $sql = "DELETE FROM `garantecliente` WHERE `IdGaranteCliente` = '$IdGaranteCliente' "; 
            mysql_query($sql) or die(mysql_error()); 
            redirect($url_referencia);
        } 
        if (isset($_POST['EleccionVehiculo'])) { 
            foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
            $sql = "DELETE FROM `garantecliente` WHERE `IdGaranteCliente` = '$IdGaranteCliente' "; 
            mysql_query($sql) or die(mysql_error()); 
            redirect($url_referencia);            
        } 
        $garante = mysql_fetch_array(mysql_query("SELECT * FROM `garantecliente` WHERE `IdGaranteCliente` = '$IdGaranteCliente' ")); 
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
            <?php if(strcmp($garante['Tipo'],"Propiedad") == 0): ?>
            <form method="post" action="" data-toggle="validator" role="form">
                <div class="Container50 MaintanceResponsive">
                    <div class="ContainerIndent">
                        <p>
                            <b>Descripci&oacute;n:</b><br />
                            <textarea disabled readonly type='text' name='Descripcion' placeholder="Descripci&oacute;n" class="md-textarea"><?= stripslashes($garante["Descripcion"]) ?></textarea>
                        </p>
                    </div>
                </div>
                <div class="Container50 MaintanceResponsive">
                    <div class="ContainerIndent">
                        <p>
                            <b>Observaci&oacute;n:</b><br />
                            <textarea disabled readonly type='text' name='Observacion' placeholder="Observaci&oacute;n" class="md-textarea"><?= stripslashes($garante["Observacion"]) ?></textarea>
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
                            <b>Direcci&oacute;n:</b><br />
                            <textarea disabled readonly type='text' name='DireccionPropiedad' placeholder="Direcci&oacute;n" class="md-textarea"><?= stripslashes($garante["DireccionPropiedad"]) ?></textarea>
                        </p>
                        <p>
                            <b>Tiempo de la Propiedad:</b><br/>
                            <div class="input-group">
                                <input class="form-control" name="TiempoPropiedad" type="number" disabled readonly min="0" step="1" value='<?= stripslashes($garante["TiempoPropiedad"]) ?>' />
                                <div class="input-group-addon">A&ntilde;o(s)</div>
                            </div>
                        </p>
                    </div>
                </div>
                <div class="Container50 MaintanceResponsive">
                    <div class="ContainerIndent">
                        <p>
                            <b>Descripci&oacute;n de la Propiedad (Opcional):</b><br />
                            <textarea disabled readonly type='text' name='DescripcionPropiedad' placeholder="Descripci&oacute;n" class="md-textarea"><?= stripslashes($garante["DescripcionPropiedad"]) ?></textarea>
                        </p>
                        <p>
                            <b>Tipo de Propiedad:</b>
                            <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                                <select readonly disabled name="TipoPropiedad" class="mdl-selectfield__select">
                                    <?php 
                                            foreach($TiposDePropiedad AS $key => $estado) { 
                                                if ($estado == $garante['TipoPropiedad'])  {
                                                    echo "<option value='" . $estado . "' selected>" . $estado . "</option>";
                                                } else {
                                                    echo "<option value='" . $estado . "'>" . $estado . "</option>";
                                                }
                                            } 
                                        ?>
                                    </select>
                                <span class="mdl-selectfield__error">Seleccione un tipo de propiedad</span>
                            </div>
                        </p>
                    </div>
                </div>
                <div class="Container100">
                    <div class="ContainerIndent">
                        <p>
                            <h5 style="margin: 20px;">¿Desea eliminar el registro?</h5><br/>
                            <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="regresar()">
                Cancelar
            </button>
                            <button style="margin-left: 10px; color: white;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type='submit'>
                Eliminar
            </button>
                            <input type="hidden" value="Propiedad" name="Tipo" />
                            <input type="hidden" value="<?php echo $IdCliente; ?>" name="IdCliente" />
                            <input type='hidden' value='1' name='EleccionPropiedad' />
                        </p>
                    </div>
                </div>
            </form>
            <?php else: ?>
            <form method="post" action="" data-toggle="validator" role="form">
                <div class="Container50 MaintanceResponsive">
                    <div class="ContainerIndent">
                        <p>
                            <b>Descripci&oacute;n:</b><br />
                            <textarea disabled readonly type='text' name='Descripcion' placeholder="Descripci&oacute;n" class="md-textarea"><?= stripslashes($garante["Descripcion"]) ?></textarea>
                        </p>
                    </div>
                </div>
                <div class="Container50 MaintanceResponsive">
                    <div class="ContainerIndent">
                        <p>
                            <b>Observaci&oacute;n:</b><br />
                            <textarea disabled readonly type='text' name='Observacion' placeholder="Observaci&oacute;n" class="md-textarea"><?= stripslashes($garante["Observacion"]) ?></textarea>
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
                            <b>Estado del Veh&iacute;culo:</b>
                            <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                                <select readonly disabled name="EstadoVehiculo" class="mdl-selectfield__select">
                                    <?php 
                                            foreach($TiposDeEstadoVehiculos AS $key => $estado) { 
                                                if ($estado == $garante['EstadoVehiculo'])  {
                                                    echo "<option value='" . $estado . "' selected>" . $estado . "</option>";
                                                } else {
                                                    echo "<option value='" . $estado . "'>" . $estado . "</option>";
                                                }
                                            } 
                                        ?>
                                    </select>
                                <span class="mdl-selectfield__error">Seleccione el estado del veh&iacute;culo</span>
                            </div>
                        </p>
                        <p>
                            <b>Uso del Veh&iacute;culo:</b><br/>
                            <div class="input-group">
                                <input type="number" disabled readonly min="0" step="1" class="form-control" name="UsoVehiculo" value='<?= stripslashes($garante["UsoVehiculo"]) ?>'>
                                <div class="input-group-addon">A&ntilde;o(s)</div>
                            </div>
                        </p>
                    </div>
                </div>
                <div class="Container50 MaintanceResponsive">
                    <div class="ContainerIndent">
                        <p>
                            <b>Tipo de Veh&iacute;culo:</b>
                            <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                                <select readonly disabled name="TipoVehiculo" class="mdl-selectfield__select">
                                        <?php 
                                            foreach($TiposDeVehiculos AS $key => $estado) { 
                                                if ($estado == $garante['TipoVehiculo'])  {
                                                    echo "<option value='" . $estado . "' selected>" . $estado . "</option>";
                                                } else {
                                                    echo "<option value='" . $estado . "'>" . $estado . "</option>";
                                                }
                                            } 
                                        ?>
                                    </select>
                                <span class="mdl-selectfield__error">Seleccione un tipo de veh&iacute;culo</span>
                            </div>
                        </p>
                        <p>
                            <b>Descripci&oacute;n del Veh&iacute;culo:</b><br />
                            <textarea disabled readonly type='text' name='DescripcionVehiculo' placeholder="Descripci&oacute;n" class="md-textarea"><?= stripslashes($garante["DescripcionVehiculo"]) ?></textarea>
                        </p>
                    </div>
                </div>
                <div class="Container100">
                    <div class="ContainerIndent">
                        <p>

                            <h5 style="margin: 20px;">¿Desea eliminar el registro?</h5><br/>
                            <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="regresar()">
                Cancelar
            </button>
                            <button style="margin-left: 10px; color: white;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type='submit'>
                Eliminar
            </button>
                            <input type="hidden" name="Tipo" value="Vehiculo" />
                            <input type="hidden" name="IdCliente" value="<?php echo $IdCliente; ?>" />
                            <input type='hidden' value='1' name='EleccionVehiculo' />
                        </p>
                    </div>
                </div>
            </form>
            <?php endif; ?>

        </div>
    </div>
    <?php } ?>
    <script type="text/javascript">
        var regresar = function() {
            window.location.href = '<?php echo $url_referencia; ?>';
        };

    </script>
    <?php
        require_once("config/page/footer.php"); 
    ?>
