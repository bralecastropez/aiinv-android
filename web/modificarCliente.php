<?php
    require_once("config/db/session.php"); 
    $page_title = "Editar Cliente";
    $page_maintance = true;
    $tab_content = '<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
                        <a href="#scroll-tab-1" class="mdl-layout__tab is-active">Datos Personales</a>
                        <a href="#scroll-tab-2" class="mdl-layout__tab">Datos Adicionales</a>
                        <a href="#scroll-tab-3" class="mdl-layout__tab">Garantes</a>
                        <a href="#scroll-tab-4" class="mdl-layout__tab">Referencias</a>
                        <a href="#scroll-tab-5" class="mdl-layout__tab" disabled>Prestamos</a>
                    </div>';
    require_once("config/page/header.php");

    $EstadosCiviles = array("Soltero", "Casado", "Viudo", "Divorciado");
    $Sexos = array("Masculino", "Femenino", "Otro");

    if (isset($_GET['IdCliente']) ) { 
        $IdCliente = (int) $_GET['IdCliente']; 
        if (isset($_POST['submitted'])) { 
            $FechaModificacion = date("Y-m-d H:i:s");
            foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
            $sql = "UPDATE `cliente` SET  `IdGrupo` =  '{$_POST['IdGrupo']}' ,  `CodigoCliente` =  '{$_POST['CodigoCliente']}' ,  `Nombre` =  '{$_POST['Nombre']}' ,  `Apellido` =  '{$_POST['Apellido']}' ,  `Sexo` =  '{$_POST['Sexo']}' ,  `FechaNacimiento` =  '{$_POST['FechaNacimiento']}' ,  `DPI` =  '{$_POST['DPI']}' ,  `NIT` =  '{$_POST['NIT']}' ,  `LimiteCredito` =  '{$_POST['LimiteCredito']}' ,  `EstadoCivil` =  '{$_POST['EstadoCivil']}' ,  `FechaModificacion` =  '$FechaModificacion'   WHERE `IdCliente` = '$IdCliente' "; 
            mysql_query($sql) or die(mysql_error()); 
            redirect("modificarCliente.php?IdCliente=" . $IdCliente);
        } 
        $row = mysql_fetch_array ( mysql_query("SELECT * FROM `cliente` WHERE `IdCliente` = '$IdCliente' ")); 
?>

    <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
        <div class="page-content">
            <br/>
            <br/>
            <div class="Container100">
                <div class="ContainerIndent TextAlCenter">
                    <h5>
                        Datos del Cliente
                        <button type="button" class="btn btn-primary">
                            &Uacute;ltima Modificaci&oacute;n:
                            <span class="badge">
                                <?= stripslashes($row['FechaModificacion']) ?>
                            </span>
                        </button>
                    </h5>
                </div>
                <div class="mdl-card__actions mdl-card--border"></div>
                <div class="container-fluid">
                    <div class="row">
                        <form action='' method='POST'>
                            <div class="col-md-6">
                                <div>
                                    <p><b>Grupo:</b></p>
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
                                </div><br/>
                                <div>
                                    <p><b>Nombre: </b></p>
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <input class="mdl-textfield__input" type="text" maxlength="50" required pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" name="Nombre" id="Nombre" value="<?= stripslashes($row['Nombre']) ?>" />
                                        <label class="mdl-textfield__label" for="Nombre">Nombre</label>
                                        <span class="mdl-textfield__error">Debe ingresar un nombre v&aacute;lido</span>
                                    </div>
                                </div><br/>
                                <div>
                                    <p><b>C&oacute;digo del Cliente: </b></p>
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <input class="mdl-textfield__input" type="text" name="CodigoCliente" id="CodigoCliente" placeholder="C&oacute;digo del Cliente" value="<?= stripslashes($row['CodigoCliente']) ?>" />
                                        <label class="mdl-textfield__label" for="CodigoCliente">C&oacute;digo del Cliente</label>
                                        <span class="mdl-textfield__error">Debe ingresar un c&oacute;digo v&aacute;lido</span>
                                    </div>
                                </div><br/>
                                <div>
                                    <p><b>DPI: </b></p>
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <input class="mdl-textfield__input" type="text" name="DPI" id="DPI" value="<?= stripslashes($row['DPI']) ?>" />
                                        <label class="mdl-textfield__label" for="DPI">DPI</label>
                                        <span class="mdl-textfield__error">Debe ingresar un n&uacute;mero valido</span>
                                    </div>
                                </div><br/>
                                <div>
                                    <p><b>Estado Civil:</b></p>
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
                                </div><br/>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <p><b>Sexo:</b></p>
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
                                </div><br/>
                                <div>
                                    <p><b>Apellido: </b></p>
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <input class="mdl-textfield__input" required type="text" maxlength="50" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" name="Apellido" id="Apellido" value="<?= stripslashes($row['Apellido']) ?>" />
                                        <label class="mdl-textfield__label" for="Apellido">Apellido</label>
                                        <span class="mdl-textfield__error">Debe ingresar un apellido v&aacute;lido</span>
                                    </div>
                                </div><br/>
                                <div>
                                    <p><b>Fecha de Nacimiento:</b></p>
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <input type="text" id="FechaNacimiento" required name="FechaNacimiento" class="mdl-textfield__input" value="<?= stripslashes($row['FechaNacimiento']) ?>">
                                        <label class="mdl-textfield__label" for="FechaNacimiento">Fecha de Nacimiento</label>
                                        <span class="mdl-textfield__error">Debe seleccionar una fecha v&aacute;lida</span>
                                    </div>
                                </div><br/>
                                <div>
                                    <p><b>NIT: </b></p>
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <input class="mdl-textfield__input" type="text" name="NIT" id="NIT" value="<?= stripslashes($row['NIT']) ?>" />
                                        <label class="mdl-textfield__label" for="NIT">NIT</label>
                                        <span class="mdl-textfield__error">Debe ingresar un n&uacute;mero valido</span>
                                    </div>
                                </div><br/>
                                <div>
                                    <p><b>L&iacute;mite de Cr&eacute;dito:</b></p>
                                    <div class="input-group">
                                        <span class="input-group-addon">Q</span>
                                        <div class="mdl-textfield mdl-js-textfield">
                                            <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="LimiteCredito" id="LimiteCredito" required value="<?= stripslashes($row['LimiteCredito']) ?>" />
                                            <span class="mdl-textfield__error">Debe ingresar un n&uacute;mero v&aacute;lido</span>
                                        </div>
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                </div><br/>
                            </div>
                            <div>
                                <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="window.location.href='listarClientes.php'">
                                Cancelar
                            </button>
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type='submit' style="color: white;">
                                Editar
                            </button>
                                <input type='hidden' value='1' name='submitted' />
                            </div><br/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mdl-layout__tab-panel" id="scroll-tab-2">
        <div class="page-content">
            <br/>
            <br/>
            <div class="Container100">
                <div class="ContainerIndent TextAlCenter">
                    <h5>Tel&eacute;fonos</h5>
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
                                        <button id="demo-menu-lower-right-telefono_cliente<?php echo $telefono['IdTelefonoCliente']; ?>" class="mdl-button mdl-js-button mdl-button--icon">
                                          <i class="material-icons">more_vert</i>
                                        </button>

                                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right-telefono_cliente<?php echo $telefono['IdTelefonoCliente']; ?>">
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
                <button id="add-telefono" class="pull-right mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" onclick="AgregarTelefono()" style="color: white; ">
                  <i class="material-icons">add</i>
                </button>
                <div class="mdl-tooltip" data-mdl-for="add-telefono">
                    Agregar Tel&eacute;fono
                </div>
            </div>
            <br/>
            <div class="Container100">
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
                                        <button id="demo-menu-lower-right-direccion_cliente<?php echo $direccion['IdDireccionCliente']; ?>" class="mdl-button mdl-js-button mdl-button--icon">
                                          <i class="material-icons">more_vert</i>
                                        </button>

                                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right-direccion_cliente<?php echo $direccion['IdDireccionCliente']; ?>">
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
                <button id="add-direccion" style="color: white;" class="pull-right mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" onclick="AgregarDireccion()">
                  <i class="material-icons">add</i>
                </button>
                <div class="mdl-tooltip" data-mdl-for="add-direccion">
                    Agregar Direcci&oacute;n
                </div>
            </div>
            <br/>
            <div class="Container100">
                <div class="ContainerIndent TextAlCenter">
                    <h5>Correos Electr&oacute;nicos</h5>
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

                                    <div class="Fright ShowMin">
                                        <button id="demo-menu-lower-right-correo_cliente<?php echo $correo['IdCorreoCliente']; ?>" class="mdl-button mdl-js-button mdl-button--icon">
                                          <i class="material-icons">more_vert</i>
                                        </button>

                                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right-correo_cliente<?php echo $correo['IdCorreoCliente']; ?>">
                                            <a onclick="ModificarCorreo(<?php echo $correo['IdCorreoCliente']; ?>)">
                                                <li class="mdl-menu__item">
                                                    <button class="mdl-button mdl-js-button mdl-button--icon" onclick="ModificarCorreo(<?php echo $correo['IdCorreoCliente']; ?>)">
                                                <i class="material-icons">create</i>
                                            </button>Editar
                                                </li>
                                            </a>
                                            <a onclick="EliminarCorreo(<?php echo $correo['IdCorreoCliente']; ?>)">
                                                <li class="mdl-menu__item">
                                                    <button class="mdl-button mdl-js-button mdl-button--icon" onclick="EliminarCorreo(<?php echo $correo['IdCorreoCliente']; ?>)">
                                                <i class="material-icons">delete</i>
                                            </button>Eliminar
                                                </li>
                                            </a>
                                        </ul>
                                    </div>

                                    <div class="Fright ShowMax">
                                        <button class="mdl-button mdl-js-button mdl-button--primary" onclick="ModificarCorreo(<?php echo $correo['IdCorreoCliente']; ?>)">
                                            <i class="material-icons">create</i>
                                        </button>
                                        <button class="mdl-button mdl-js-button mdl-button--accent" onclick="EliminarCorreo(<?php echo $correo['IdCorreoCliente']; ?>)">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </div>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>
                <button id="add-correo" style="color: white; " class="pull-right mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" onclick="AgregarCorreo()">
                  <i class="material-icons">add</i>
                </button>
                <div class="mdl-tooltip" data-mdl-for="add-correo">
                    Agregar Correo
                </div>
            </div>
        </div>
    </section>
    <section class="mdl-layout__tab-panel" id="scroll-tab-3">
        <div class="page-content">
            <a id="add-maintance" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" onclick="AgregarGarante()">
                <i class="material-icons" style="color: white;">add</i>
            </a>
            <div class="mdl-tooltip" data-mdl-for="add-maintance">
                Agregar Garante
            </div>
            <br/>
            <br/>
            <div class="Container100">
                <div class="ContainerIndent TextAlCenter">
                    <h5>Garantias del Cliente</h5>
                </div>
                <div class="mdl-card__actions mdl-card--border"></div>
                <div class="container-fluid">
                    <div class="row">
                        <?php
                            $query_garante = mysql_query("SELECT * FROM `garantecliente` WHERE `IdCliente` = '$IdCliente'") or trigger_error(mysql_error()); 
                            while($garante = mysql_fetch_array($query_garante)){ 
                                foreach($garante AS $key => $value) { $garante[$key] = stripslashes($value); } 
                            ?>
                            <div class="mdl-card mdl-shadow--2dp ContainerIndent" style="margin-bottom: 10px;">
                                <div class="mdl-card__title mdl-card--border">
                                    <h2 class="mdl-card__title-text">
                                        <?php echo $garante['Tipo']; ?>
                                    </h2>
                                </div>
                                <div class="mdl-card__supporting-text mdl-card--border">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <h6>Descripci&oacute;n: </h6>
                                            <div>
                                                <?php echo $garante['Descripcion']; ?>
                                            </div><br/>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Observaci&oacute;n: </h6>
                                            <div>
                                                <?php echo $garante['Observacion']; ?>
                                            </div><br/>
                                        </div>

                                        <div class="collapse" id="garante-cliente-<?php echo $garante[ 'IdGaranteCliente']; ?>">
                                            <div class="col-md-12">
                                                <?php if(strcmp($garante['Tipo'],"Propiedad") == 0): ?>
                                                <div class="col-md-6">
                                                    <div>
                                                        <h6>Direcci&oacute;n de la Propiedad: </h6>
                                                        <?php echo $garante['DireccionPropiedad']; ?>
                                                    </div><br/>
                                                    <div>
                                                        <h6>Tiempo de la Propiedad: </h6>
                                                        <?php echo $garante['TiempoPropiedad'] . " A&ntilde;os"; ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div>
                                                        <h6>Tipo de Propiedad: </h6>
                                                        <?php echo $garante['TipoPropiedad']; ?>
                                                    </div><br/>
                                                    <div>
                                                        <h6>Descripci&oacute;n de la Propiedad: </h6>
                                                        <?php echo $garante['DescripcionPropiedad']; ?>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <div class="col-md-6">
                                                    <div>
                                                        <h6>Tipo de Veh&iacute;culo: </h6>
                                                        <?php echo $garante['TipoVehiculo']; ?>
                                                    </div><br/>
                                                    <div>
                                                        <h6>Estado del Veh&iacute;culo: </h6>
                                                        <?php echo $garante['EstadoVehiculo']; ?>
                                                    </div><br/>
                                                </div>
                                                <div class="col-md-6">
                                                    <div>
                                                        <h6>Tiempo de uso del Veh&iacute;culo: </h6>
                                                        <?php echo $garante['UsoVehiculo'] . " A&ntilde;os"; ?>
                                                    </div><br/>
                                                    <div>
                                                        <h6>Descripci&oacute;n del Veh&iacute;culo: </h6>
                                                        <?php echo $garante['DescripcionVehiculo']; ?>
                                                    </div><br/>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button data-toggle="collapse" data-target="#garante-cliente-<?php echo $garante['IdGaranteCliente']; ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">
                                      Ver Detalle
                                    </button>
                                </div>
                                <div class="mdl-card__menu">
                                    <button id="demo-menu-lower-right-garante_cliente<?php echo $garante['IdGaranteCliente']; ?>" class="mdl-button mdl-js-button mdl-button--icon">
                                      <i class="material-icons">more_vert</i>
                                    </button>

                                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right-garante_cliente<?php echo $garante['IdGaranteCliente']; ?>">
                                        <a onclick="ModificarGarante(<?php echo $garante['IdGaranteCliente']; ?>)">
                                            <li class="mdl-menu__item">
                                                <button class="mdl-button mdl-js-button mdl-button--icon" onclick="ModificarGarante(<?php echo $garante['IdGaranteCliente']; ?>)">
                              <i class="material-icons">create</i>
                            </button> Editar
                                            </li>
                                        </a>
                                        <a onclick="EliminarGarante(<?php echo $garante['IdGaranteCliente']; ?>)">
                                            <li class=" mdl-menu__item ">
                                                <button class="mdl-button mdl-js-button mdl-button--icon " onclick="EliminarGarante(<?php echo $garante['IdGaranteCliente']; ?>)">
                              <i class="material-icons ">delete</i>
                            </button> Eliminar
                                            </li>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mdl-layout__tab-panel" id="scroll-tab-4">
        <div class="page-content">
            <a id="add-maintance" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" onclick="AgregarReferencia()">
                <i class="material-icons" style="color: white;">add</i>
            </a>
            <div class="mdl-tooltip" data-mdl-for="add-maintance">
                Agregar Referencia
            </div>
            <br/>
            <br/>
            <div class="Container100">
                <div class="ContainerIndent TextAlCenter">
                    <h5>Referencias del Cliente</h5>
                </div>
                <div class="mdl-card__actions mdl-card--border"></div>
                <div class="container-fluid">
                    <div class="row">
                        <?php
                            $query_referencia = mysql_query("SELECT * FROM `referenciacliente` WHERE `IdCliente` = '$IdCliente'") or trigger_error(mysql_error()); 
                            while($referencia = mysql_fetch_array($query_referencia)){ 
                                foreach($referencia AS $key => $value) { $referencia[$key] = stripslashes($value); } 
                            ?>
                            <div class="mdl-card mdl-shadow--2dp ContainerIndent" style="margin-bottom: 10px;">
                                <div class="mdl-card__title mdl-card--border">
                                    <h2 class="mdl-card__title-text">
                                        <?php echo $referencia['Nombre']; ?>
                                    </h2>
                                </div>
                                <div class="mdl-card__supporting-text mdl-card--border">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div>
                                                <h6>DPI: </h6>
                                                <?php echo $referencia['DPI']; ?>
                                            </div><br/>
                                            <div>
                                                <h6>Tel&eacute;fono: </h6>
                                                <?php echo $referencia['Telefono'] . " - " . $referencia['DescripcionTelefono']; ?>
                                            </div><br/>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <h6>Correo Electr&oacute;nico: </h6>
                                                <?php echo $referencia['Correo']; ?>
                                            </div><br/>
                                            <div>
                                                <h6>Direcci&oacute;n: </h6>
                                                <?php echo $referencia['Direccion']; ?>
                                            </div><br/>
                                        </div>

                                        <div class="collapse" id="referencia-cliente-<?php echo $referencia['IdReferenciaCliente']; ?>">
                                            <div class="col-md-12">
                                                <hr/>
                                                <b>Datos de la Empresa</b>
                                                <hr/>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div>
                                                        <h6>Nombre de la Empresa: </h6>
                                                        <?php echo $referencia['NombreEmpresa']; ?>
                                                    </div><br/>
                                                    <div>
                                                        <h6>Nit de la Empresa: </h6>
                                                        <?php echo $referencia['NitEmpresa']; ?>
                                                    </div><br/>
                                                    <div>
                                                        <h6>Tel&eacute;fono de la Empresa: </h6>
                                                        <?php echo $referencia['TelefonoEmpresa']; ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div>
                                                        <h6>Correo Electr&oacute;nico de la Empresa: </h6>
                                                        <?php echo $referencia['CorreoEmpresa']; ?>
                                                    </div><br/>
                                                    <div>
                                                        <h6>Direcci&oacute;n de la Empresa: </h6>
                                                        <?php echo $referencia['DireccionEmpresa']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button data-toggle="collapse" data-target="#referencia-cliente-<?php echo $referencia['IdReferenciaCliente']; ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">
                                      Ver Detalle
                                    </button>
                                </div>
                                <div class="mdl-card__menu">
                                    <button id="demo-menu-lower-right-referencia_cliente<?php echo $referencia['IdReferenciaCliente']; ?>" class="mdl-button mdl-js-button mdl-button--icon">
                                      <i class="material-icons">more_vert</i>
                                    </button>

                                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right-referencia_cliente<?php echo $referencia['IdReferenciaCliente']; ?>">
                                        <a onclick="ModificarReferencia(<?php echo $referencia['IdReferenciaCliente']; ?>)">
                                            <li class="mdl-menu__item">
                                                <button class="mdl-button mdl-js-button mdl-button--icon" onclick="ModificarReferencia(<?php echo $referencia['IdReferenciaCliente']; ?>)">
                              <i class="material-icons">create</i>
                            </button> Editar
                                            </li>
                                        </a>
                                        <a onclick="EliminarReferencia(<?php echo $referencia['IdReferenciaCliente']; ?>)">
                                            <li class=" mdl-menu__item ">
                                                <button class="mdl-button mdl-js-button mdl-button--icon " onclick="EliminarReferencia(<?php echo $referencia['IdReferenciaCliente']; ?>)">
                              <i class="material-icons ">delete</i>
                            </button> Eliminar
                                            </li>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mdl-layout__tab-panel" id="scroll-tab-5">
        <div class="page-content ">
            <button id="add-maintance" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" style="color: white;">
                Ver Prestamos
            </button>
            <div class="mdl-tooltip" data-mdl-for="add-maintance">
                Ver Prestamos
            </div>
            <br/>
            <br/>
            <div class="Container100">
                <div class="ContainerIndent TextAlCenter">
                    <h5>Prestamos del Cliente</h5>
                </div>
                <div class="mdl-card__actions mdl-card--border"></div>
                <div class="container-fluid">
                    <div class="row">
                        <?php
                            $query_prestamo = mysql_query("SELECT * FROM `prestamo` WHERE `IdCliente` = '$IdCliente'") or trigger_error(mysql_error()); 
                            while($prestamo = mysql_fetch_array($query_prestamo)){ 
                                foreach($prestamo AS $key => $value) { $prestamo[$key] = stripslashes($value); } 
                            ?>
                            <div class="mdl-card mdl-shadow--2dp ContainerIndent" style="margin-bottom: 10px;">
                                <div class="mdl-card__title mdl-card--border">
                                    <h2 class="mdl-card__title-text">
                                        <?php echo $prestamo['Titulo']; ?>
                                    </h2>
                                </div>
                                <div class="mdl-card__supporting-text mdl-card--border">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Total del Prestamo:</b>
                                                <?php echo " Q. " . $prestamo['MontoParcial']; ?>
                                            </div><br/>
                                            <div>
                                                <b>Monto Pagado: </b>
                                                <?php echo " Q. " . $prestamo['MontoPagado']; ?>
                                            </div><br/>
                                            <div>
                                                <b>Monto Pendiente: </b>
                                                <?php echo " Q. " . $prestamo['MontoPendiente']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Cuotas Pagadas:</b>
                                                <?php echo $prestamo['CuotasPagadas']; ?>
                                            </div><br/>
                                            <div>
                                                <b>Cuotas Pendientes: </b>
                                                <?php echo $prestamo['CuotasRestantes']; ?>
                                            </div><br/>
                                            <div>
                                                <b>Cuota Mensual: </b>
                                                <?php echo " Q. " .  $prestamo['CuotaMensual']; ?>
                                            </div>
                                        </div>

                                        <div class="collapse" id="prestamo-cliente-<?php echo $prestamo['IdPrestamo']; ?>">
                                            <div class="col-md-12">
                                                <hr/>
                                                <b>Datos del Prestamo</b>
                                                <hr/>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div>
                                                        <b>C&oacute;digo del Prestamo: </b>
                                                        <?php echo $prestamo['CodigoPrestamo']; ?>
                                                    </div>
                                                    <div>
                                                        <b>Periodo de Pago: </b>
                                                        <?php echo $prestamo['PeriodoPago']; ?>
                                                    </div>
                                                    <div>
                                                        <b>Plazo: </b>
                                                        <?php echo $prestamo['Plazo']; ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div>
                                                        <b>Estado: </b>
                                                        <?php echo $prestamo['Estado']; ?>
                                                    </div>
                                                    <div>
                                                        <b>Inter&eacute;s Mensual: </b>
                                                        <?php echo $prestamo['InteresMensual']; ?>
                                                    </div>
                                                    <div>
                                                        <b>Fecha de Corte: </b>
                                                        <?php echo $prestamo['FechaCorte']; ?>
                                                    </div>
                                                </div>
                                                <hr/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button data-toggle="collapse" data-target="#prestamo-cliente-<?php echo $prestamo['IdPrestamo']; ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">
                                      Ver Detalle
                                    </button>
                                </div>
                            </div>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php } 
        require_once("config/page/footer.php "); 
    ?>
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

        <script type="text/javascript ">
            var ModificarTelefono = function(IdTelefonoCliente) {
                window.location.href = "mantenimientoTelefono.php?IdTelefonoCliente=" + IdTelefonoCliente +
                    " &Accion=Modificar&Referencia=<?php echo $actual_link; ?>%26Tab=1%23crud_telefonos";
            };
            var EliminarTelefono = function(IdTelefonoCliente) {
                window.location.href = "mantenimientoTelefono.php?IdTelefonoCliente=" + IdTelefonoCliente + "&Accion=Eliminar&Referencia=<?php echo $actual_link; ?>%26Tab=1%23crud_telefonos";
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
        <script type="text/javascript">
            var EliminarGarante = function(IdGaranteCliente) {
                window.location.href = "eliminarGaranteCliente.php?IdGaranteCliente=" + IdGaranteCliente +
                    "&Referencia=<?php echo $actual_link; ?>%26Tab=2";
            };

            var ModificarGarante = function(IdGaranteCliente) {
                window.location.href = "modificarGaranteCliente.php?IdGaranteCliente=" + IdGaranteCliente +
                    "&Referencia=<?php echo $actual_link; ?>%26Tab=2";
            };

            var AgregarGarante = function() {
                window.location.href = "agregarGaranteCliente.php?IdCliente=<?php echo $IdCliente; ?>&Referencia=<?php echo $actual_link; ?>%26Tab=2";
            };

        </script>
        <script type="text/javascript">
            var EliminarReferencia = function(IdReferenciaCliente) {
                window.location.href = "eliminarReferenciaCliente.php?IdReferenciaCliente=" + IdReferenciaCliente +
                    "&Referencia=<?php echo $actual_link; ?>%26Tab=3";
            };

            var ModificarReferencia = function(IdReferenciaCliente) {
                window.location.href = "modificarReferenciaCliente.php?IdReferenciaCliente=" + IdReferenciaCliente +
                    "&Referencia=<?php echo $actual_link; ?>%26Tab=3";
            };

            var AgregarReferencia = function() {
                window.location.href = "agregarReferenciaCliente.php?IdCliente=<?php echo $IdCliente; ?>&Referencia=<?php echo $actual_link; ?>%26Tab=3";
            };

        </script>
        <?php if (isset($_GET['Tab'])) { ?>
        <script type='text/javascript'>
            jQuery(document).ready(function($) {
                $(".mdl-layout__tab:eq(<?php echo $_GET['Tab']; ?>) span").click();
            });

        </script>
        <?php } ?>
