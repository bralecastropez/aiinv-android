<?php
    require_once("config/db/session.php"); 
    $page_title = "AIINV - Editar Cliente";
    $tab_content = '<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
                        <a href="#scroll-tab-1" class="mdl-layout__tab is-active">Datos Personales</a>
                        <a href="#scroll-tab-2" class="mdl-layout__tab">Datos Adicionales</a>
                        <a href="#scroll-tab-3" class="mdl-layout__tab">Garantes</a>
                        <a href="#scroll-tab-4" class="mdl-layout__tab">Referencias</a>
                        <a href="#scroll-tab-5" class="mdl-layout__tab" disabled>Prestamos</a>
                    </div>';
    $EstadosCiviles = array("Soltero", "Casado", "Viudo", "Divorciado");
    $Sexos = array("Masculino", "Femenino", "Otro");

    require_once("config/page/header.php");
    require_once("config/page/maintance_imports.php");

    if (isset($_GET['IdCliente']) ) { 
        $IdCliente = (int) $_GET['IdCliente']; 
        if (isset($_POST['submitted'])) { 
            foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
            $sql = "UPDATE `cliente` SET  `IdGrupo` =  '{$_POST['IdGrupo']}' ,  `CodigoCliente` =  '{$_POST['CodigoCliente']}' ,  `Nombre` =  '{$_POST['Nombre']}' ,  `Apellido` =  '{$_POST['Apellido']}' ,  `Sexo` =  '{$_POST['Sexo']}' ,  `FechaNacimiento` =  '{$_POST['FechaNacimiento']}' ,  `DPI` =  '{$_POST['DPI']}' ,  `NIT` =  '{$_POST['NIT']}' ,  `LimiteCredito` =  '{$_POST['LimiteCredito']}' ,  `EstadoCivil` =  '{$_POST['EstadoCivil']}' ,  `FechaRegistro` =  '{$_POST['FechaRegistro']}' ,  `FechaModificacion` =  '{$_POST['FechaModificacion']}'   WHERE `IdCliente` = '$IdCliente' "; 
            mysql_query($sql) or die(mysql_error()); 
            echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
            echo "<a href='listarClientes.php'>Back To Listing</a>"; 
        } 
        $row = mysql_fetch_array ( mysql_query("SELECT * FROM `cliente` WHERE `IdCliente` = '$IdCliente' ")); 
?>



    <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <h5>
                        Datos del Cliente
                        <br/>
                        <div class="mdl-card__actions mdl-card--border"></div>
                    </h5>
                    <form action='' method='POST'>
                        <div class="col-md-6">
                            <p>
                                <b>Grupo:</b><br />
                                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                                    <select id="IdGrupo" name="IdGrupo" class="mdl-selectfield__select" required>
                                    <?php
                                        $query_grupo = mysql_query("SELECT * FROM `grupo`") or trigger_error(mysql_error()); 
                                        while($grupo = mysql_fetch_array($query_grupo)){ 
                                            foreach($grupo AS $key => $value) { $grupo[$key] = stripslashes($value); } 
                                    ?>
                                        <option value="<?php echo $grupo['IdGrupo']; ?>" 
                                                <?php if($grupo['IdGrupo'] == $row['IdGrupo']) { echo "selected";} ?> >
                                            <?php echo $grupo['Nombre']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                    <label class="mdl-textfield__label" for="IdGrupo">Grupo</label>
                                    <span class="mdl-selectfield__error">Seleccione un Grupo</span>
                                </div>
                            </p>
                            <p>
                                <b>Nombre: </b><br/>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="text" maxlength="50" required pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" name="Nombre" id="Nombre" value="<?= stripslashes($row['Nombre']) ?>" />
                                    <label class="mdl-textfield__label" for="Nombre">Nombre</label>
                                    <span class="mdl-textfield__error">Debe ingresar un nombre v&aacute;lido</span>
                                </div>
                            </p>
                            <p>
                                <b>C&oacute;digo del Cliente: </b><br/>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="text" name="CodigoCliente" id="CodigoCliente" placeholder="C&oacute;digo del Cliente" value="<?= stripslashes($row['CodigoCliente']) ?>" />
                                    <label class="mdl-textfield__label" for="CodigoCliente">C&oacute;digo del Cliente</label>
                                    <span class="mdl-textfield__error">Debe ingresar un c&oacute;digo v&aacute;lido</span>
                                </div>
                            </p>
                            <p>
                                <b>DPI: </b><br/>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="text" name="DPI" id="DPI" value="<?= stripslashes($row['DPI']) ?>" />
                                    <label class="mdl-textfield__label" for="DPI">DPI</label>
                                    <span class="mdl-textfield__error">Debe ingresar un n&uacute;mero valido</span>
                                </div>
                            </p>
                            <p>
                                <b>Estado Civil:</b>
                                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                                    <select id="EstadoCivil" name="EstadoCivil" class="mdl-selectfield__select" required>
                                        <?php 
                                            foreach($EstadosCiviles AS $key => $estado) { 
                                                if ($estado == $row['EstadoCivil'])  {
                                                    echo "<option value='" . $estado . "' selected>" . $estado . "</option>";
                                                } else {
                                                    echo "<option value='" . $estado . "'>" . $estado . "</option>";
                                                }
                                            } 
                                        ?>
                                    </select>
                                    <!--<label class="mdl-textfield__label" for="EstadoCivil">Estado Civil</label>-->
                                    <span class="mdl-selectfield__error">Seleccione un estado</span>
                                </div>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <b>Sexo:</b>
                                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                                    <select id="Sexo" name="Sexo" class="mdl-selectfield__select" required>
                                        <?php 
                                            foreach($Sexos AS $key => $sexo) { 
                                                if ($estado == $row['Sexo'])  {
                                                    echo "<option value='" . $sexo . "' selected>" . $sexo . "</option>";
                                                } else {
                                                    echo "<option value='" . $sexo . "'>" . $sexo . "</option>";
                                                }
                                            } 
                                        ?>
                                    </select>
                                    <!--<label class="mdl-textfield__label" for="Sexo">Sexo</label>-->
                                    <span class="mdl-selectfield__error">Seleccione un sexo</span>
                                </div>
                            </p>
                            <p>
                                <b>Apellido: </b><br/>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" required type="text" maxlength="50" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" name="Apellido" id="Apellido" value="<?= stripslashes($row['Apellido']) ?>" />
                                    <label class="mdl-textfield__label" for="Apellido">Apellido</label>
                                    <span class="mdl-textfield__error">Debe ingresar un apellido v&aacute;lido</span>
                                </div>
                            </p>
                            <p>
                                <b>Fecha de Nacimiento:</b><br />
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input type="text" id="FechaNacimiento" required name="FechaNacimiento" class="mdl-textfield__input" value="<?= stripslashes($row['FechaNacimiento']) ?>">
                                    <label class="mdl-textfield__label" for="FechaNacimiento">Fecha de Nacimiento</label>
                                    <span class="mdl-textfield__error">Debe seleccionar una fecha v&aacute;lida</span>
                                </div>
                            </p>
                            <p>
                                <b>NIT: </b><br/>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="text" name="NIT" id="NIT" value="<?= stripslashes($row['NIT']) ?>" />
                                    <label class="mdl-textfield__label" for="NIT">NIT</label>
                                    <span class="mdl-textfield__error">Debe ingresar un n&uacute;mero valido</span>
                                </div>
                            </p>
                            <p>
                                <b>L&iacute;mite de Cr&eacute;dito:</b>
                                <div class="input-group">
                                    <span class="input-group-addon">Q</span>
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="LimiteCredito" id="LimiteCredito" required value="<?= stripslashes($row['LimiteCredito']) ?>" />
                                        <span class="mdl-textfield__error">Debe ingresar un n&uacute;mero v&aacute;lido</span>
                                    </div>
                                    <span class="input-group-addon">.00</span>
                                </div>
                            </p>
                        </div>
                        <p>
                            <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="window.location.href='listarClientes.php'">
                                Cancelar
                            </button>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type='submit' style="color: white;">
                                Editar
                            </button>
                            <input type='hidden' value='1' name='submitted' />
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="mdl-layout__tab-panel" id="scroll-tab-2">
        <div class="page-content">
            <br/>
            <br/>
            <div class="Container100 Responsive">
                <div class="ContainerIndent TextAlCenter">
                    <h5>Telefonos</h5>
                </div>
                <hr/>
            </div>
            <div class="col-md-12" id="crud_telefonos">
                <table class="mdl-data-table mdl-js-data-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">Tel&eacute;fono</th>
                            <th class="mdl-data-table__cell--non-numeric">Descripci&oacute;n</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query_telefono = mysql_query("SELECT * FROM `telefonocliente` WHERE `IdCliente` = " . $IdCliente) or trigger_error(mysql_error()); 
                            while($telefono = mysql_fetch_array($query_telefono)){ 
                                foreach($telefono AS $key => $value) { $telefono[$key] = stripslashes($value); } 
                        ?>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">
                                    <?php echo $telefono['Telefono']; ?>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric">
                                    <?php echo $telefono['Descripcion']; ?>
                                </td>
                                <td>
                                    <div class="ShowMin Fright">
                                        <button id="demo-menu-lower-right<?php echo $telefono['IdTelefonoCliente']; ?>" class="mdl-button mdl-js-button mdl-button--icon">
                                          <i class="material-icons">more_vert</i>
                                        </button>

                                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right<?php echo $telefono['IdTelefonoCliente']; ?>">
                                            <a onclick="EliminarTelefono(<?php echo $telefono['IdTelefonoCliente']; ?>)">
                                                <li class="mdl-menu__item">
                                                    <button class="mdl-button mdl-js-button mdl-button--icon" onclick="ModificarTelefono(<?php echo $telefono['IdTelefonoCliente']; ?>)">
                                                        <i class="material-icons">create</i>
                                                    </button> Editar
                                                </li>
                                            </a>
                                            <a onclick="EliminarTelefono(<?php echo $telefono['IdTelefonoCliente']; ?>)">
                                                <li class="mdl-menu__item">
                                                    <button class="mdl-button mdl-js-button mdl-button--icon" onclick="EliminarTelefono(<?php echo $telefono['IdTelefonoCliente']; ?>)">
                                                        <i class="material-icons">delete</i>
                                                    </button> Eliminar
                                                </li>
                                            </a>
                                        </ul>
                                    </div>
                                    <div class="ShowMax Fright">
                                        <button class="mdl-button mdl-js-button mdl-button--primary" onclick="ModificarTelefono(<?php echo $telefono['IdTelefonoCliente']; ?>)">
                                        <i class="material-icons">create</i>
                                    </button>
                                        <button class="mdl-button mdl-js-button mdl-button--accent" onclick="EliminarTelefono(<?php echo $telefono['IdTelefonoCliente']; ?>)">
                                        <i class="material-icons">delete</i>
                                    </button>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>
                <button class="pull-right mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" onclick="AgregarTelefono()">
                  <i class="material-icons">add</i>
                </button>
            </div>
            <br/>
            <div class="Container100 Responsive">
                <div class="ContainerIndent TextAlCenter">
                    <h5>Direcciones</h5>
                </div>
                <hr/>
            </div>
            <div class="col-md-12" id="crud_direcciones">
                <table class="mdl-data-table mdl-js-data-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">Direcci&oacute;n</th>
                            <th class="mdl-data-table__cell--non-numeric">Descripci&oacute;n</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query_direccion = mysql_query("SELECT * FROM `direccioncliente` WHERE `IdCliente` = " . $IdCliente) or trigger_error(mysql_error()); 
                            while($direccion = mysql_fetch_array($query_direccion)){ 
                                foreach($direccion AS $key => $value) { $direccion[$key] = stripslashes($value); } 
                        ?>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">
                                    <?php echo $direccion['Direccion']; ?>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric">
                                    <?php echo $direccion['Descripcion']; ?>
                                </td>
                                <td>
                                    <div class="Fright ShowMin">
                                        <button id="demo-menu-lower-right<?php echo $direccion['IdDireccionCliente']; ?>" class="mdl-button mdl-js-button mdl-button--icon">
                                          <i class="material-icons">more_vert</i>
                                        </button>

                                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right<?php echo $direccion['IdDireccionCliente']; ?>">
                                            <a onclick="ModificarDireccion(<?php echo $direccion['IdDireccionCliente']; ?>)">
                                                <li class="mdl-menu__item">
                                                    <button class="mdl-button mdl-js-button mdl-button--icon" onclick="ModificarDireccion(<?php echo $direccion['IdDireccionCliente']; ?>)">
                                                <i class="material-icons">create</i>
                                            </button>Editar
                                                </li>
                                            </a>
                                            <a onclick="EliminarDireccion(<?php echo $direccion['IdDireccionCliente']; ?>)">
                                                <li class="mdl-menu__item">
                                                    <button class="mdl-button mdl-js-button mdl-button--icon" onclick="EliminarDireccion(<?php echo $direccion['IdDireccionCliente']; ?>)">
                                                <i class="material-icons">delete</i>
                                            </button>Eliminar
                                                </li>
                                            </a>
                                        </ul>
                                    </div>

                                    <div class="Fright ShowMax">
                                        <button class="mdl-button mdl-js-button mdl-button--primary" onclick="ModificarDireccion(<?php echo $direccion['IdDireccionCliente']; ?>)">
                                            <i class="material-icons">create</i>
                                        </button>
                                        <button class="mdl-button mdl-js-button mdl-button--accent" onclick="EliminarDireccion(<?php echo $direccion['IdDireccionCliente']; ?>)">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>
                <button class="pull-right mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" onclick="AgregarDireccion()">
                  <i class="material-icons">add</i>
                </button>
            </div>
            <br/>
            <div class="Container100 Responsive">
                <div class="ContainerIndent TextAlCenter">
                    <h5>Correos Electronicos</h5>
                </div>
                <hr/>
            </div>
            <div class="col-md-12" id="crud_correos">
                <table class="mdl-data-table mdl-js-data-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">Correo</th>
                            <th class="mdl-data-table__cell--non-numeric">Descripci&oacute;n</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query_correo = mysql_query("SELECT * FROM `correocliente` WHERE `IdCliente` = " . $IdCliente) or trigger_error(mysql_error()); 
                            while($correo = mysql_fetch_array($query_correo)){ 
                                foreach($correo AS $key => $value) { $correo[$key] = stripslashes($value); } 
                        ?>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">
                                    <?php echo $correo['Correo']; ?>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric">
                                    <?php echo $correo['Descripcion']; ?>
                                </td>
                                <td>
                                    <button class="mdl-button mdl-js-button mdl-button--primary" onclick="ModificarCorreo(<?php echo $correo['IdCorreoCliente']; ?>)">
                                    <i class="material-icons">create</i>
                                </button>
                                    <button class="mdl-button mdl-js-button mdl-button--accent" onclick="EliminarCorreo(<?php echo $correo['IdCorreoCliente']; ?>)">
                                    <i class="material-icons">delete</i>
                                </button>
                                </td>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>
                <button class="pull-right mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" onclick="AgregarCorreo()">
                  <i class="material-icons">add</i>
                </button>
            </div>
        </div>
    </section>
    <section class="mdl-layout__tab-panel" id="scroll-tab-3">
        <div class="page-content">

        </div>
    </section>
    <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
        <div class="page-content">
            <!-- Your content goes here -->
        </div>
    </section>

    <?php } 
        require_once("config/page/footer.php"); 
        require_once("config/page/maintance_imports.php"); 
    ?>
    <script type="text/javascript">
        function AdjustIframeHeightOnLoad() {
            document.getElementById("form-iframe").style.height = document.getElementById("form-iframe").contentWindow.document.body.scrollHeight + "px";
        }

        function AdjustIframeHeight(i) {
            document.getElementById("form-iframe").style.height = parseInt(i) + "px";
        }

    </script>

    <div class="modal fade" id="modal_telefono" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 id="module_title"></h4>

                </div>
                <iframe id="form-iframe" style="margin:0; width:100%; border:none; overflow:hidden;" scrolling="no" onload="AdjustIframeHeightOnLoad()"></iframe>
            </div>
        </div>
    </div>
    <?php
        $actual_link = str_replace("&Tab=0", "", $actual_link);
        $actual_link = str_replace("&Tab=1", "", $actual_link);
        $actual_link = str_replace("&Tab=2", "", $actual_link);
        $actual_link = str_replace("&Tab=3", "", $actual_link);
        $actual_link = str_replace("&Tab=4", "", $actual_link);
        $actual_link = str_replace("&Tab=5", "", $actual_link);
        $actual_link = str_replace("/", "%2F", $actual_link);
        $actual_link = str_replace("?", "%3F", $actual_link);
        $actual_link = str_replace("&", "%26", $actual_link);
    ?>

        <script type="text/javascript">
            var ModificarTelefono = function(IdTelefonoCliente) {
                window.location.href = "mantenimientoTelefono.php?IdTelefonoCliente=" + IdTelefonoCliente +
                    "&Accion=Modificar&Referencia=<?php echo $actual_link; ?>%26Tab=1%23crud_telefonos";
            };

            var EliminarTelefono = function(IdTelefonoCliente) {
                /*document.getElementById("form-iframe").src = "config/frames/frame_crud_telefono.php?IdTelefonoCliente=" + IdTelefonoCliente +
                    "&Accion=Eliminar&Referencia=<?php //echo $actual_link; ?>#crud_telefonos";
                document.getElementById("module_title").innerHTML = TituloMantenimiento;*/
                window.location.href = "mantenimientoTelefono.php?IdTelefonoCliente=" + IdTelefonoCliente +
                    "&Accion=Eliminar&Referencia=<?php echo $actual_link; ?>%26Tab=1%23crud_telefonos";
            };

            var AgregarTelefono = function() {
                window.location.href = "mantenimientoTelefono.php?Accion=Agregar&IdCliente=<?php echo $IdCliente; ?>&Referencia=<?php echo $actual_link; ?>%26Tab=1%23crud_telefonos";
            };

        </script>
        <script type="text/javascript">
            var ModificarDireccion = function(IdDireccionCliente) {
                window.location.href = "mantenimientoDireccion.php?IdDireccionCliente=" + IdDireccionCliente +
                    "&Accion=Modificar&Referencia=<?php echo $actual_link; ?>%26Tab=1%23crud_direcciones";
            };

            var EliminarDireccion = function(IdDireccionCliente) {
                window.location.href = "mantenimientoDireccion.php?IdDireccionCliente=" + IdDireccionCliente +
                    "&Accion=Eliminar&Referencia=<?php echo $actual_link; ?>%26Tab=1%23crud_direcciones";
            };

            var AgregarDireccion = function() {
                window.location.href = "mantenimientoDireccion.php?Accion=Agregar&IdCliente=<?php echo $IdCliente; ?>&Referencia=<?php echo $actual_link; ?>%26Tab=1%23crud_direcciones";
            };

        </script>
        <script type="text/javascript">
            var ModificarCorreo = function(IdCorreoCliente) {
                window.location.href = "mantenimientoCorreo.php?IdCorreoCliente=" + IdCorreoCliente +
                    "&Accion=Modificar&Referencia=<?php echo $actual_link; ?>%26Tab=1%23crud_correos";
            };

            var EliminarCorreo = function(IdCorreoCliente) {
                window.location.href = "mantenimientoCorreo.php?IdCorreoCliente=" + IdCorreoCliente +
                    "&Accion=Eliminar&Referencia=<?php echo $actual_link; ?>%26Tab=1%23crud_correos";
            };

            var AgregarCorreo = function() {
                window.location.href = "mantenimientoCorreo.php?Accion=Agregar&IdCliente=<?php echo $IdCliente; ?>&Referencia=<?php echo $actual_link; ?>%26Tab=1%23crud_correos";
            };

        </script>
        <?php if (isset($_GET['Tab'])) { ?>
        <script type='text/javascript'>
            jQuery(document).ready(function($) {
                $(".mdl-layout__tab:eq(<?php echo $_GET['Tab']; ?>) span").click();
            });

        </script>
        <?php } ?>
