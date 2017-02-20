<?php
    require_once("config/db/session.php");
    $url_referencia = $_GET['Referencia'];
    if(isset($_GET['IdCorreoCliente'])) {
        $correo_cliente = mysql_fetch_array(mysql_query("SELECT * FROM `correocliente` WHERE `IdCorreoCliente` = '" .  $_GET["IdCorreoCliente"] . "'"));
    } 

    switch ($_GET['Accion']) {
        case 'Agregar':
            $page_title = "AIINV - Agregar Correo Electr&oacute;nico";
            if(isset($_POST['Added'])) {
                foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
                $IdCliente = $_GET['IdCliente'];
                $sql = "INSERT INTO `correocliente` (IdCliente, Correo, Descripcion) VALUES ('$IdCliente' ,  '{$_POST['Correo']}' ,'{$_POST['Descripcion']}')"; 
                mysql_query($sql) or die(mysql_error()); 
                //echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
                redirect($url_referencia);
            }
            break;
            
        case 'Eliminar':
            $page_title = "AIINV - Eliminar Correo Electr&oacute;nico";
            if(isset($_POST['Deleted'])) {
                foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
                $sql = "DELETE FROM `correocliente` WHERE `IdCorreoCliente` = " . $correo_cliente['IdCorreoCliente']; 
                mysql_query($sql) or die(mysql_error()); 
                //echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
                redirect($url_referencia);
            }
            break;
        
        case 'Modificar':
            $page_title = "AIINV - Modificar Correo Electr&oacute;nico";
            if(isset($_POST['Modified'])) {
                foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
                $sql = "UPDATE `correocliente` SET `Correo` =  '{$_POST['Correo']}' ,  `Descripcion` =  '{$_POST['Descripcion']}'   WHERE `IdCorreoCliente` = " . $correo_cliente['IdCorreoCliente']; 
                mysql_query($sql) or die(mysql_error());    
                //echo "<script type='text/javascript'>window.parent.location.reload();</script>";
                redirect($url_referencia);
            }
            break;
        
        default:
            break;
    }
    $page_maintance = true;
    require_once("config/page/header.php"); 
?>

    <?php 
                switch ($_GET['Accion']) {
                    case 'Agregar':
        ?>
    <form method="post" action="" data-toggle="validator" role="form">
        <div class="modal-body">
            <p>
                <b>Ingrese un Correo Electr&oacute;nico: </b><br/>
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" type="email" maxlength="50" required name="Correo" id="Correo" />
                    <label class="mdl-textfield__label" for="Correo">Correo Electr&oacute;nico</label>
                    <span class="mdl-textfield__error">Debe ingresar un correo electr&oacute;nico v&aacute;lido</span>
                </div>
            </p>
            <p>
                <b>Ingrese una Descripci&oacute;n (Opcional):</b><br />
                <textarea type='text' name='Descripcion' id='Descripcion' placeholder="Descripci&oacute;n" class="md-textarea"></textarea>
            </p>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="Added" id="Added" value="1" />
            <input type="hidden" name="IdCliente" id="IdCliente" value="<?php echo $IdCliente; ?>" />
            <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="regresar()">
                Cancelar
            </button>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type='submit' style="color: white;"> Ingresar
                </button>
        </div>
    </form>
    <?php
                        break;
                    case 'Eliminar':
        ?>
        <form method="post" action="" data-toggle="validator" role="form">
            <div class="modal-body">
                <p>
                    <b>Correo Electr&oacute;nico: </b><br/>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" readonly disabled type="email" maxlength="50" required name="Correo" id="Correo" value="<?php echo stripslashes($correo_cliente['Correo']); ?>" />
                        <label class="mdl-textfield__label" for="Correo">Correo Electr&oacute;nico</label>
                        <span class="mdl-textfield__error">Debe ingresar un correo electr&oacute;nico v&aacute;lido</span>
                    </div>
                </p>
                <p>
                    <b>Descripci&oacute;n:</b><br />
                    <textarea type='text' name='Descripcion' readonly disabled placeholder="Descripci&oacute;n" class="md-textarea"><?php echo stripslashes($correo_cliente['Descripcion']);?></textarea>
                </p>
            </div>
            <div class="modal-footer">
                <p><strong>¿Desea eliminar este registro?</strong></p>
                <input type="hidden" name="Deleted" id="Deleted" value="1" />
                <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="regresar()">
                Cancelar
            </button>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type='submit' style="color: white;">
                        Eliminar
                    </button>
            </div>
        </form>

        <?php 
                        break;
                    case 'Modificar':
        ?>
        <form method="post" action="" data-toggle="validator" role="form">
            <div class="modal-body">
                <p>
                    <b>Ingrese un Correo Electr&oacute;nico: </b><br/>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="email" maxlength="50" required name="Correo" id="Correo" value="<?php echo stripslashes($correo_cliente['Correo']); ?>" />
                        <label class="mdl-textfield__label" for="Correo">Correo Electr&oacute;nico</label>
                        <span class="mdl-textfield__error">Debe ingresar un correo electr&oacute;nico v&aacute;lido</span>
                    </div>
                </p>
                <p>
                    <b>Ingrese una Descripci&oacute;n (Opcional):</b><br />
                    <textarea type='text' name='Descripcion' placeholder="Descripci&oacute;n" class="md-textarea"><?php echo stripslashes($correo_cliente['Descripcion']);?></textarea>
                </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="Modified" id="Modified" value="1" />
                <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="regresar()">
                Cancelar
            </button>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type='submit' style="color: white;">
                        Guardar Cambios
                    </button>
            </div>
        </form>
        <?php
                        break;
                }
        
                require_once("config/page/header.php");
        ?>

            <script type="text/javascript">
                var regresar = function() {
                    window.location.href = '<?php $url_referencia; ?>';
                }

            </script>
