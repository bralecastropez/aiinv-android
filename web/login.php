<?php
    require_once("config/db/login.php"); 
    $page_title = "Iniciar Sesión";
    require_once("config/page/header.php"); 
?>
    <!-- Wide card with share menu button -->
    <style>
        /*.demo-card-wide.mdl-card {
                width: 80%;
            }*/
        
        .demo-card-wide>.mdl-card__title {
            color: #fff;
            height: 176px;
            background: url('img/splash_screen.png') center / cover;
            background-size: 50% 100%;
            background-repeat: no-repeat;
        }
        
        .demo-card-wide>.mdl-card__menu {
            color: black;
        }

    </style>
    <br/>

    <div class="ShowMin">
        <div class="demo-card-wide mdl-card mdl-shadow--2dp Hei80 Unselectable ContainerIndent Wid90">
            <!--<div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Bienvenido</h2>
        </div>-
        <div class="mdl-card__supporting-text">

        </div>-->
            <div class="mdl-card__actions mdl-card--border">

                <div>
                    <form method="post" action="">
                        <div class="card-block">

                            <label><?php echo $error . "<br/>"; ?></label>

                            <div class="md-form">
                                <i class="fa fa-user prefix"></i>
                                <input type="text" id="username" name="username" class="form-control" required>
                                <label data-error="Este campo es requerido" for="username">Usuario</label>
                            </div>

                            <div class="md-form">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" id="password" name="password" class="form-control" required>
                                <label data-error="Este campo es requerido" for="password">Contrase&ntilde;a</label>
                            </div>

                            <input type="hidden" value="1" name="login" />

                            <div class="text-xs-center">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                <label style="color: white;">Ingresar</label>
                            </button>
                            </div>

                        </div>
                    </form>

                    <!--Footer-->
                    <div class="modal-footer">
                        <div class="options">
                            <p>¿No est&aacute; registrado? <a href="#">Registrarme</a></p>
                            <p>¿Olvid&oacute; su <a href="#"> Contrase&ntilde;a?</a></p>
                        </div>
                    </div>

                </div>
                <!--/Form without header-->

            </div>
            <div class="mdl-card__menu">
                <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                          <i class="material-icons">info</i>
                        </button>
            </div>
        </div>
    </div>
    <div class="ShowMax">
        <div class="demo-card-wide mdl-card mdl-shadow--2dp Hei80 Unselectable ContainerIndent Wid50">
            <!--<div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Bienvenido</h2>
        </div>-
        <div class="mdl-card__supporting-text">

        </div>-->
            <div class="mdl-card__actions mdl-card--border">

                <div>
                    <form method="post" action="">
                        <div class="card-block">

                            <label><?php echo $error . "<br/>"; ?></label>

                            <div class="md-form">
                                <i class="fa fa-user prefix"></i>
                                <input type="text" id="username" name="username" class="form-control" required>
                                <label data-error="Este campo es requerido" for="username">Usuario</label>
                            </div>

                            <div class="md-form">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" id="password" name="password" class="form-control" required>
                                <label data-error="Este campo es requerido" for="password">Contrase&ntilde;a</label>
                            </div>

                            <input type="hidden" value="1" name="login" />

                            <div class="text-xs-center">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                <label style="color: white;">Ingresar</label>
                            </button>
                            </div>

                        </div>
                    </form>

                    <!--Footer-->
                    <div class="modal-footer">
                        <div class="options">
                            <p>¿No est&aacute; registrado? <a href="#">Registrarme</a></p>
                            <p>¿Olvid&oacute; su <a href="#"> Contrase&ntilde;a?</a></p>
                        </div>
                    </div>

                </div>
                <!--/Form without header-->

            </div>
            <div class="mdl-card__menu">
                <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                          <i class="material-icons">info</i>
                        </button>
            </div>
        </div>
    </div>



    <?php
        require_once("config/page/footer.php");
    ?>
