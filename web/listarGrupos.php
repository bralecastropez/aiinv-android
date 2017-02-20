<?php
    require_once("config/db/session.php");
    $page_title = "Grupos";
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

    <a id="add-maintance" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" href="agregarGrupo.php">
        <i class="material-icons" style="color: white;">add</i>
    </a>
    <div class="mdl-tooltip" data-mdl-for="add-maintance">
        Agregar Grupo
    </div>
    <?php
    $result = mysql_query("SELECT * FROM `grupo`") or trigger_error(mysql_error()); 
    while($row = mysql_fetch_array($result)){ 
        foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
    ?>
        <div class="ContainerIndent" style="margin-right: 30px;">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-card--border">
                    <h2 class="mdl-card__title-text">
                        <?php echo $row['Nombre'] . " "; ?>
                    </h2>
                </div>
                <div class="mdl-card__supporting-text mdl-card--border">
                    <div class="col-md-6">
                        Descripci&oacute;n: <br/>
                        <?php echo $row['Descripcion']; ?>
                    </div>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <button class="mdl-button mdl-js-button mdl-button--primary mdl-js-ripple-effect">
                  Ver Cobradores
                </button>
                    <button class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect">
                  Ver Clientes
                </button>
                </div>
                <div class="mdl-card__menu">
                    <button id="demo-menu-lower-right<?php echo $row['IdGrupo']; ?>" class="mdl-button mdl-js-button mdl-button--icon">
                  <i class="material-icons">more_vert</i>
                </button>

                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right<?php echo $row['IdGrupo']; ?>">
                        <!--<a href="verGrupo.php?IdGrupo=<?php //echo $row[ 'IdGrupo']; ?>">
                        <li class="mdl-menu__item">
                            <button class="mdl-button mdl-js-button mdl-button--icon">
                              <i class="material-icons">info</i>
                            </button> Ver
                        </li>
                    </a>-->
                        <a href="modificarGrupo.php?IdGrupo=<?php echo $row[ 'IdGrupo']; ?>">
                            <li class="mdl-menu__item">
                                <button class="mdl-button mdl-js-button mdl-button--icon">
                              <i class="material-icons">create</i>
                            </button> Editar
                            </li>
                        </a>
                        <a href="eliminarGrupo.php?IdGrupo=<?php echo $row[ 'IdGrupo']; ?>">
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

        <?php } require_once("config/page/footer.php"); ?>
