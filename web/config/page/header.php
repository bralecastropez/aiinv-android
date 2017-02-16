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
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
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
                <div class="mdl-layout__header-row">
                    <span class="mdl-layout-title">
                        <?php echo $page_title; ?>
                    </span>
                    <div class="mdl-layout-spacer"></div>
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
                <?php 
                    if (isset($tab_content)) {
                        echo $tab_content;    
                    }
                    
                ?>
            </header>
            <div class="mdl-layout__drawer">
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
            </div>

            <main class="mdl-layout__content">
                <div class="page-content">
