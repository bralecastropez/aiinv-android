<?php
    require_once("config/db/session.php");
    require_once("config/db/handler.php");
    $page_title = "Clientes";
    require_once("config/page/header.php");
?>
    <style>
        .mdl-card {
            width: 100%;
            margin: 10px;
            height: 50px;
        }
        
        .mdl-card>.mdl-card__actions>.pull-right {
            border-top-color: gray;
            padding-right: 10px;
        }
        
        .mdl-card>.mdl-card__actions {
            height: auto;
        }

    </style>
    <a id="add-maintance" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" href="agregarCliente.php">
        <i class="material-icons" style="color: white;">add</i>
    </a>
    <div class="mdl-tooltip" data-mdl-for="add-maintance">
        Agregar Usuario
    </div>

    <?php
    $result = mysql_query("SELECT * FROM `cliente`") or trigger_error(mysql_error()); 
    while($row = mysql_fetch_array($result)){ 
        foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
    ?>
        <div class="ContainerIndent" style="margin-right: 30px;">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-card--border">
                    <h2 class="mdl-card__title-text">
                        <?php echo $row['Nombre'] . " " . $row['Apellido']; ?>
                    </h2>
                </div>
                <div class="mdl-card__supporting-text mdl-card--border">
                    <div class="col-md-6">
                        <div>
                            <b>C&oacute;digo Cliente:</b>
                            <?php echo $row['CodigoCliente']; ?>
                        </div>
                        <div>
                            <b>Grupo:</b>
                            <?php echo ObtenerGrupo($row['IdGrupo'])['Nombre']; ?>
                        </div>
                        <div>
                            <b>L&iacute;mite Cr&eacute;dito:</b> Q.
                            <?php echo $row['LimiteCredito'] ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <b>DPI:</b>
                            <?php echo $row['DPI']; ?>
                        </div>
                        <div>
                            <b>Nit:</b>
                            <?php echo $row['NIT']; ?>
                        </div>
                        <div>
                            <b>Fecha de Modificaci&oacute;n:</b>
                            <?php echo $row['FechaModificacion'] ?>
                        </div>
                    </div>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <button class="mdl-button mdl-js-button mdl-button--primary mdl-js-ripple-effect">
                  Ver Pagos
                </button>
                    <button class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect">
                  Ver Prestamos
                </button>
                </div>
                <div class="mdl-card__menu">
                    <button id="demo-menu-lower-right<?php echo $row['IdCliente']; ?>" class="mdl-button mdl-js-button mdl-button--icon">
                  <i class="material-icons">more_vert</i>
                </button>

                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right<?php echo $row['IdCliente']; ?>">
                        <a href="eliminarCliente.php?IdCliente=<?php echo $row[ 'IdCliente']; ?>">
                            <li class="mdl-menu__item">
                                <button class="mdl-button mdl-js-button mdl-button--icon">
                              <i class="material-icons">info</i>
                            </button> Ver
                            </li>
                        </a>
                        <a href="modificarCliente.php?IdCliente=<?php echo $row[ 'IdCliente']; ?>">
                            <li class="mdl-menu__item">
                                <button class="mdl-button mdl-js-button mdl-button--icon">
                              <i class="material-icons">create</i>
                            </button> Editar
                            </li>
                        </a>
                        <a href="eliminarCliente.php?IdCliente=<?php echo $row[ 'IdCliente']; ?>">
                            <li class="mdl-menu__item">
                                <button class="mdl-button mdl-js-button mdl-button--icon">
                              <i class="material-icons">delete</i>
                            </button> Eliminar
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php require_once("config/page/footer.php"); ?>
