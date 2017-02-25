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

</head>

<body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
        <header class="demo-header mdl-layout__header">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title ShowMax">
                        AIINV - <?php echo $page_title; ?>
                    </span>
                <span class="mdl-layout-title ShowMin">
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
                <a class="mdl-navigation__link" href="">
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
                <a class="mdl-navigation__link" href="">
                    <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i>
                    <span class="visuallyhidden">Help</span>
                </a>
            </nav>
        </div>
