<?php
    require_once("config/db/session.php"); 
    $page_title = "Agregar Cliente";
    $page_maintance = true;
    require_once("config/page/header.php");

    $idcli = mysql_fetch_array(mysql_query("select (max(IdCliente) + 1) as 'idcli' from cliente"))['idcli']; 
    
    if ($idcli < 9) {
        $CodigoCliente = "CLI00000" . $idcli;
    } else {
        if ($idcli > 100) {
            if ($idcli > 1000) {
                $CodigoCliente = "CLI00" . $idcli;
            } else {
                $CodigoCliente = "CLI000" . $idcli;
            }
        } else {
            $CodigoCliente = "CLI0000" . $idcli;
        }
    }

    if (isset($_POST['submitted'])) { 
        foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
        $sql = "INSERT INTO `cliente` ( `IdGrupo` ,  `CodigoCliente` ,  `Nombre` ,  `Apellido` ,  `Sexo` ,  `FechaNacimiento` ,  `DPI` ,  `NIT` ,  `LimiteCredito` ,  `EstadoCivil`) VALUES(  '{$_POST['IdGrupo']}' ,  '{$_POST['CodigoCliente']}' ,  '{$_POST['Nombre']}' ,  '{$_POST['Apellido']}' ,  '{$_POST['Sexo']}' ,  '{$_POST['FechaNacimiento']}' ,  '{$_POST['DPI']}' ,  '{$_POST['NIT']}' ,  '{$_POST['LimiteCredito']}' ,  '{$_POST['EstadoCivil']}' ) "; 
        mysql_query($sql) or die(mysql_error()); 
        redirect("modificarCliente.php?IdCliente=" . $idcli);        
    } 
?>


    <form action='' method='POST' style="margin: 20px;" data-toggle="validator" role="form">
        <h5>
            Datos del Cliente
            <br/>
            <div class="mdl-card__actions mdl-card--border"></div>
        </h5>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <p><b>Seleccione un Grupo:</b></p>
                        <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                            <select id="IdGrupo" name="IdGrupo" class="mdl-selectfield__select" required>
                                <option value=""></option>
                                <?php
                                    $query_grupo = mysql_query("SELECT * FROM `grupo`") or trigger_error(mysql_error()); 
                                    while($grupo = mysql_fetch_array($query_grupo)){ 
                                        foreach($grupo AS $key => $value) { $grupo[$key] = stripslashes($value); } 
                                ?>
                                <option value="<?php echo $grupo['IdGrupo']; ?>">
                                    <?php echo $grupo['Nombre']; ?>
                                </option>
                                <?php } ?>
                                </select>
                            <label class="mdl-textfield__label" for="IdGrupo">Grupo</label>
                            <span class="mdl-selectfield__error">Seleccione un Grupo</span>
                        </div>
                    </div><br/>
                    <div>
                        <p><b>Ingrese un Nombre: </b></p>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" type="text" maxlength="50" required pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" name="Nombre" id="Nombre" />
                            <label class="mdl-textfield__label" for="Nombre">Nombre</label>
                            <span class="mdl-textfield__error">Debe ingresar un nombre v&aacute;lido</span>
                        </div>
                    </div><br/>
                    <div>
                        <p><b>Ingrese un C&oacute;digo del Cliente: </b></p>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" type="text" name="CodigoCliente" id="CodigoCliente" placeholder="C&oacute;digo del Cliente" value="<?php echo $CodigoCliente; ?>" />
                            <label class="mdl-textfield__label" for="CodigoCliente">C&oacute;digo del Cliente</label>
                            <span class="mdl-textfield__error">Debe ingresar un c&oacute;digo v&aacute;lido</span>
                        </div>
                    </div><br/>
                    <div>
                        <p><b>DPI: </b></p>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input dpi" type="text" name="DPI" id="DPI" />
                            <label class="mdl-textfield__label" for="DPI">DPI</label>
                            <span class="mdl-textfield__error">Debe ingresar un n&uacute;mero valido</span>
                        </div>
                    </div><br/>
                    <div>
                        <p><b>Seleccione un Estado Civil:</b></p>
                        <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                            <select id="EstadoCivil" name="EstadoCivil" class="mdl-selectfield__select" required>
                                <option value=""></option>
                                <option value="Soltero">Soltero</option>
                                <option value="Casado">Casado</option>
                                <option value="Viudo">Viudo</option>
                                <option value="Divorciado">Divorciado</option>
                            </select>
                            <label class="mdl-textfield__label" for="EstadoCivil">Estado Civil</label>
                            <span class="mdl-selectfield__error">Seleccione un estado</span>
                        </div>
                    </div><br/>
                </div>
                <div class="col-md-6">
                    <div>
                        <p><b>Seleccione un Sexo:</b></p>
                        <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                            <select id="Sexo" name="Sexo" class="mdl-selectfield__select" required>
                                    <option value="" selected></option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            <label class="mdl-textfield__label" for="Sexo">Sexo</label>
                            <span class="mdl-selectfield__error">Seleccione un sexo</span>
                        </div>
                    </div><br/>
                    <div>
                        <p><b>Ingrese un Apellido: </b></p>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" required type="text" maxlength="50" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" name="Apellido" id="Apellido" />
                            <label class="mdl-textfield__label" for="Apellido">Apellido</label>
                            <span class="mdl-textfield__error">Debe ingresar un apellido v&aacute;lido</span>
                        </div>
                    </div><br/>
                    <div>
                        <p><b>Seleccione una Fecha de Nacimiento:</b></p>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input type="text" id="FechaNacimiento" required name="FechaNacimiento" class="mdl-textfield__input">
                            <label class="mdl-textfield__label" for="FechaNacimiento">Fecha de Nacimiento</label>
                            <span class="mdl-textfield__error">Debe seleccionar una fecha v&aacute;lida</span>
                        </div>
                    </div><br/>
                    <div>
                        <p><b>NIT: </b></p>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input nit" type="text" name="NIT" id="NIT" />
                            <label class="mdl-textfield__label" for="NIT">NIT</label>
                            <span class="mdl-textfield__error">Debe ingresar un n&uacute;mero valido</span>
                        </div>
                    </div><br/>
                    <div>
                        <p><b>L&iacute;mite de Cr&eacute;dito:</b></p>
                        <div class="input-group">
                            <span class="input-group-addon">Q</span>
                            <div class="mdl-textfield mdl-js-textfield">
                                <input class="mdl-textfield__input creditodecimal" type="text" name="LimiteCredito" id="LimiteCredito" required />
                                <span class="mdl-textfield__error">Debe ingresar un n&uacute;mero v&aacute;lido</span>
                            </div>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div><br/>
                </div>

            </div>
        </div>


        <div>
            <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="window.location.href='listarGrupos.php'">
                Cancelar
            </button>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type='submit' style="color: white;">
                Agregar
            </button>
            <input type='hidden' value='1' name='submitted' />
        </div><br/>
    </form>


    <?php require_once("config/page/footer.php"); ?>
