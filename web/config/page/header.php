<?php
    //require_once("config/db/session.php");
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>AIINV - DYNAMICS PROGRESSIVE SYSTEMS</title>
        <link rel="shortcut icon" type="image/png" href="img/ic_launcher.png" />

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="css/mdl/MaterialIcons.css" />
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" />

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" />

        <!-- Material Design Bootstrap-->
        <link rel="stylesheet" href="css/mdb.min.css" />

        <!-- MDL -->
        <link rel="stylesheet" href="css/mdl/material.min.css">
        <script type="text/javascript" src="css/mdl/material.min.js"></script>

        <!-- User Styles -->
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/style.css">

        <!-- Primefaces Core -->
        <link rel="stylesheet" href="css/core-layout.css">

        <?php if (isset($page_maintance)): ?>
        <?php if (is_bool($page_maintance) === true): ?>
        <!-- Select -->
        <link rel="stylesheet" href="css/mdl-selectfield/dist/mdl-selectfield.min.css">
        <link rel="stylesheet" href="css/mdl-select/getmdl-select.min.css" />

        <!-- Style for Inputs -->
        <style>
            .mdl-textfield,
            .mdl-selectfield {
                width: 100%;
            }

        </style>

        <!-- Select js -->
        <script src="css/mdl-selectfield/dist/mdl-selectfield.min.js"></script>

        <!-- Date picker -->
        <link rel="stylesheet" href="css/bootstrap-material-datetimepicker.css" />

        <!-- jQuery Mask-Plugin -->
        <script type="text/javascript" src="js/jquery.mask.js"></script>

        <!-- Stepper -->
        <link rel="stylesheet" href="css/mdl-stepper/stepper.min.css">
        <!-- Stepper Javascript minified -->
        <script defer src="css/mdl-stepper/stepper.min.js"></script>

        <?php endif; ?>
        <?php endif; ?>

    </head>

    <body>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <!--Content-->
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                        <h4 class="modal-title" id="myModalLabel">Acerca de </h4>
                    </div>
                    <!--Body-->
                    <div class="modal-body">
                        ...
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
        <div class="demo-layout-waterfall mdl-layout mdl-js-layout mdl-layout--fixed-header">
            <header class="demo-header mdl-layout__header">
                <!--<button class="mdl-layout-icon mdl-button mdl-js-button mdl-button--icon" onclick="history.go(-1);">
                    <i class="material-icons">arrow_back</i>
                </button>-->
                <div class="mdl-layout__header-row">
                    <span class="mdl-layout-title ShowMax">
                        AIINV - <?php echo $page_title; ?>
                    </span>
                    <span class="mdl-layout-title ShowMin">
                        <?php echo $page_title; ?>
                    </span>
                    <div class="mdl-layout-spacer"></div>
                    <!--<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
                        <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
                      <i class="material-icons">search</i>
                    </label>
                        <div class="mdl-textfield__expandable-holder">
                            <input class="mdl-textfield__input" type="text" id="search">
                            <label class="mdl-textfield__label" for="search">Ingresa tu consulta...</label>
                        </div>
                    </div>-->
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
                        <i class="material-icons">more_vert</i>
                      </button>
                    <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
                        <?php if(isset($_SESSION['login_user'])): ?>
                        <li class="mdl-menu__item"><a href="config/db/logout.php">Cerrar Sesi&oacute;n</a></li>
                        <?php endif?>
                        <li class="mdl-menu__item">Cont&aacute;ctanos</li>
                        <li class="mdl-menu__item">Informaci&oacute;n Legal</li>
                        <li class="mdl-menu__item" data-toggle="modal" data-target="#myModal">Acerca De</li>
                    </ul>
                </div>
                <div class="mdl-layout-spacer"></div>
                <?php 
                    if (isset($tab_content)) {
                        echo $tab_content;    
                    }
                    
                ?>
            </header>
            <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
                <header class="demo-drawer-header">
                    <img src="img/ic_profile.png" class="demo-avatar">
                    <div class="demo-avatar-dropdown">
                        <span>hello@example.com</span>
                        <div class="mdl-layout-spacer"></div>
                        <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons" role="presentation">arrow_drop_down</i>
              <span class="visuallyhidden">Accounts</span>
            </button>
                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
                            <li class="mdl-menu__item">hello@example.com</li>
                            <li class="mdl-menu__item">info@example.com</li>
                            <li class="mdl-menu__item"><i class="material-icons">add</i>Add another account...</li>
                        </ul>
                    </div>
                </header>
                <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
                    <a class="mdl-navigation__link" href="dashboard.php">
                        <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i> Inicio
                    </a>
                    <a class="mdl-navigation__link" href="listarGrupos.php">
                        <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">location_city</i> Grupos
                    </a>
                    <a class="mdl-navigation__link" href="listarClientes.php">
                        <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">group_add</i> Clientes
                    </a>
                    <a class="mdl-navigation__link" href="">
                        <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">person_outline</i> Usuarios
                    </a>
                    <a class="mdl-navigation__link" href="">
                        <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">supervisor_account</i> Cobradores
                    </a>
                    <!--
                    <a class="mdl-navigation__link" href="">
                        <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">report</i> Spam
                    </a>
                    <a class="mdl-navigation__link" href="">
                        <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i> Forums
                    </a>
                    <a class="mdl-navigation__link" href="">
                        <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">flag</i> Updates
                    </a>
                    <a class="mdl-navigation__link" href="">
                        <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">local_offer</i> Promos
                    </a>
                    <a class="mdl-navigation__link" href="">
                        <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">shopping_cart</i> Purchases
                    </a>
                    <a class="mdl-navigation__link" href="">
                        <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i> Social
                    </a>
                -->
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-card__actions mdl-card--border"></div>
                    <a class="mdl-navigation__link" href="">
                        <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i>
                        <!--<span style="color: white;" class="visuallyhidden">Help</span>-->
                        <span style="color: lightgray;">Informaci&oacute;n</span>
                    </a>
                </nav>
            </div>
            <!--<div class="mdl-layout__drawer">
                <span class="mdl-layout-title">AIINV</span>
                <nav class="mdl-navigation">
                    <?php if(isset($_SESSION['login_user'])): ?>
                    <a class="mdl-navigation__link" href="config/db/logout.php">Cerrar Sesi&oacute;n</a>
                    <a class="mdl-navigation__link" href="listarUsuarios.php">Usuarios</a>
                    <a class="mdl-navigation__link" href="listarClientes.php">Clientes</a>
                    <a class="mdl-navigation__link" href="listarGrupos.php">Grupos</a>
                    <?php else: ?>
                    <a class="mdl-navigation__link" href="login.php">Iniciar Sesi&oacute;n</a>
                    <a class="mdl-navigation__link" href="">Registrarme</a>
                    <a class="mdl-navigation__link" href="">Cont&aacute;ctanos</a>
                    <a class="mdl-navigation__link" href="">Ayuda</a>
                    <?php endif?>
                </nav>
            </div>-->

            <main class="mdl-layout__content">
                <div class="page-content">
