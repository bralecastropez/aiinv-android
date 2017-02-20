<?php
    require_once("config/db/session.php");
    $page_title = "Agregar Referencia";
    $page_maintance = true;
    require_once("config/page/header.php");
    
    if(isset($_GET['IdCliente'])) {
        $IdCliente = (int) $_GET['IdCliente'];
    }

    if(isset($_GET['Referencia'])) {
        $url_referencia = $_GET['Referencia'];
    }
    
    if (isset($_POST['submitted'])) { 
        foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
        $sql = "INSERT INTO `referenciacliente` ( `IdCliente` ,  `Nombre` ,  `DPI` ,  `Telefono` ,  `DescripcionTelefono` ,  `Correo` ,  `Direccion` ,  `NombreEmpresa` ,  `NitEmpresa` ,  `TelefonoEmpresa` ,  `CorreoEmpresa` ,  `DireccionEmpresa`  ) VALUES(  '{$_POST['IdCliente']}' ,  '{$_POST['Nombre']}' ,  '{$_POST['DPI']}' ,  '{$_POST['Telefono']}' ,  '{$_POST['DescripcionTelefono']}' ,  '{$_POST['Correo']}' ,  '{$_POST['Direccion']}' ,  '{$_POST['NombreEmpresa']}' ,  '{$_POST['NitEmpresa']}' ,  '{$_POST['TelefonoEmpresa']}' ,  '{$_POST['CorreoEmpresa']}' ,  '{$_POST['DireccionEmpresa']}'  ) "; 
        mysql_query($sql) or die(mysql_error()); 
        redirect($url_referencia);
    } 
?>

    <div class="Container100 Responsive">
        <div class="ContainerIndent Responsive">
            <br/>
            <form method="post" action="" data-toggle="validator" role="form">
                <div class="Container50 Responsive">
                    <div class="ContainerIndent Responsive">
                        <div class="Container100">
                            <div class="ContainerIndent TextAlCenter">
                                <h5>Datos del Referente</h5>
                            </div>
                            <hr/>
                        </div>
                        <div>
                            <p><b>Ingrese un Nombre Completo: </b>
                                <p/>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="text" maxlength="50" required pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" name="Nombre" id="Nombre" />
                                    <label class="mdl-textfield__label" for="Nombre">Nombre</label>
                                    <span class="mdl-textfield__error">Debe ingresar un nombre v&aacute;lido</span>
                                </div>
                        </div><br/>
                        <div>
                            <p><b>Ingrese un DPI: </b>
                                <p/>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input dpi" required type="text" name="DPI" id="DPI" />
                                    <label class="mdl-textfield__label" for="DPI">DPI</label>
                                    <span class="mdl-textfield__error">Debe ingresar un n&uacute;mero valido</span>
                                </div>
                        </div><br/>
                        <div>
                            <p><b>Ingrese un N&uacute;mero de Tel&eacute;fono: </b></p>
                            <div class="mdl-textfield mdl-js-textfield">
                                <input class="mdl-textfield__input telefono" required type="text" maxlength="50" name="Telefono" id="Telefono" />
                                <label class="mdl-textfield__label" for="Telefono">N&uacute;mero de Tel&eacute;fono</label>
                                <span class="mdl-textfield__error">Debe ingresar un n&uacute;mero de tel&eacute;fono v&aacute;lido</span>
                            </div>
                        </div><br/>
                        <div>
                            <p><b>Seleccione una Descripci&oacute;n para el Tel&eacute;fono: </b></p>
                            <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                                <select id="DescripcionTelefono" name="DescripcionTelefono" class="mdl-selectfield__select" required>
                                                <option value="Personal">Personal</option>
                                                <option value="Oficina">Oficina</option>
                                                <option value="Familia">Familia</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                <span class="mdl-selectfield__error">Seleccione una descripci&oacute;n</span>
                            </div>
                        </div><br/>
                        <div>
                            <p><b>Ingrese un Correo Electr&oacute;nico: </b>
                                <p/>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="email" maxlength="50" name="Correo" id="Correo" />
                                    <label class="mdl-textfield__label" for="Correo">Correo Electr&oacute;nico</label>
                                    <span class="mdl-textfield__error">Debe ingresar un correo electr&oacute;nico v&aacute;lido</span>
                                </div>
                        </div><br/>
                        <div>
                            <p><b>Ingrese una Direcci&oacute;n: </b>
                                <p/>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="text" maxlength="50" required name="Direccion" id="Direccion" />
                                    <label class="mdl-textfield__label" for="Direccion">Direcci&oacute;n</label>
                                    <span class="mdl-textfield__error">Debe ingresar una direcci&oacute;n v&aacute;lida</span>
                                </div>
                        </div><br/>
                    </div>
                </div>
                <div class="Container50 Responsive">
                    <div class="ContainerIndent Responsive">
                        <div class="Container100">
                            <div class="ContainerIndent TextAlCenter">
                                <h5>Datos de la Empresa</h5>
                            </div>
                            <hr/>
                        </div>
                        <div>
                            <p><b>Ingrese el Nombre de la Empresa: </b></p>
                            <div class="mdl-textfield mdl-js-textfield">
                                <input class="mdl-textfield__input" type="text" maxlength="50" required pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" name="NombreEmpresa" id="NombreEmpresa" />
                                <label class="mdl-textfield__label" for="NombreEmpresa">Nombre</label>
                                <span class="mdl-textfield__error">Debe ingresar un nombre v&aacute;lido</span>
                            </div>
                        </div><br/>
                        <div>
                            <p><b>Ingrese el NIT de la Empresa: </b></p>
                            <div class="mdl-textfield mdl-js-textfield">
                                <input class="mdl-textfield__input nit" required type="text" name="NitEmpresa" id="NitEmpresa" />
                                <label class="mdl-textfield__label" for="NitEmpresa">NIT</label>
                                <span class="mdl-textfield__error">Debe ingresar un n&uacute;mero valido</span>
                            </div>
                        </div><br/>
                        <div>
                            <p><b>Ingrese Correo Electr&oacute;nico de la Empresa: </b></p>
                            <div class="mdl-textfield mdl-js-textfield">
                                <input class="mdl-textfield__input" type="email" maxlength="50" name="CorreoEmpresa" id="CorreoEmpresa" />
                                <label class="mdl-textfield__label" for="CorreoEmpresa">Correo Electr&oacute;nico</label>
                                <span class="mdl-textfield__error">Debe ingresar un correo electr&oacute;nico v&aacute;lido</span>
                            </div>
                        </div><br/>
                        <div>
                            <p><b>Ingrese un N&uacute;mero de Tel&eacute;fono de la Empresa: </b></p>
                            <div class="mdl-textfield mdl-js-textfield">
                                <input class="mdl-textfield__input telefono" type="text" maxlength="50" name="TelefonoEmpresa" id="TelefonoEmpresa" />
                                <label class="mdl-textfield__label" for="TelefonoEmpresa">N&uacute;mero de Tel&eacute;fono</label>
                                <span class="mdl-textfield__error">Debe ingresar un n&uacute;mero de tel&eacute;fono v&aacute;lido</span>
                            </div>
                        </div><br/>
                        <div>
                            <p><b>Ingrese la Direcci&oacute;n de la Empresa: </b>
                                <p/>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="text" maxlength="50" required name="DireccionEmpresa" id="DireccionEmpresa" />
                                    <label class="mdl-textfield__label" for="DireccionEmpresa">Direcci&oacute;n</label>
                                    <span class="mdl-textfield__error">Debe ingresar una direcci&oacute;n v&aacute;lida</span>
                                </div>
                        </div><br/>
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
                            <input type='hidden' value='1' name='submitted' />
                            <input type='hidden' value='<?php echo $IdCliente; ?>' name='IdCliente' />
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php require_once("config/page/footer.php"); ?>

    <script type="text/javascript">
        var regresar = function() {
            window.location.href = '<?php echo $url_referencia; ?>';
        }

    </script>
