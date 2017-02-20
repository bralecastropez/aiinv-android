<?php
    require_once("config/db/session.php"); 
    $url_referencia = $_GET['Referencia'];
    if(isset($_GET['IdDireccionCliente'])) {
        $direccion_cliente = mysql_fetch_array(mysql_query("SELECT * FROM `direccioncliente` WHERE `IdDireccionCliente` = '" .  $_GET["IdDireccionCliente"] . "'"));
    } 

    switch ($_GET['Accion']) {
        case 'Agregar':
            $page_title = "Agregar Dirección";
            if(isset($_POST['Added'])) {
                foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
                $IdCliente = $_GET['IdCliente'];
                $sql = "INSERT INTO `direccioncliente` (IdCliente, Direccion, Descripcion) VALUES ('$IdCliente' ,  '{$_POST['Direccion']}' ,'{$_POST['Descripcion']}')"; 
                mysql_query($sql) or die(mysql_error()); 
                //echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
                redirect($url_referencia);
            }
            break;
            
        case 'Eliminar':
            $page_title = "Eliminar Dirección";
            if(isset($_POST['Deleted'])) {
                foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
                $sql = "DELETE FROM `direccioncliente` WHERE `IdDireccionCliente` = " . $direccion_cliente['IdDireccionCliente']; 
                mysql_query($sql) or die(mysql_error()); 
                //echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
                redirect($url_referencia);
            }
            break;
        
        case 'Modificar':
            $page_title = "Modificar Dirección";
            if(isset($_POST['Modified'])) {
                foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
                $sql = "UPDATE `direccioncliente` SET `Direccion` =  '{$_POST['Direccion']}' ,  `Descripcion` =  '{$_POST['Descripcion']}'   WHERE `IdDireccionCliente` = " . $direccion_cliente['IdDireccionCliente']; 
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
                <b>Ingrese un Direcci&oacute;n: </b><br/>
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" type="text" maxlength="50" required name="Direccion" id="Direccion" />
                    <label class="mdl-textfield__label" for="Direccion">Direcci&oacute;n</label>
                    <span class="mdl-textfield__error">Debe ingresar una direcci&oacute;n v&aacute;lida</span>
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
                    <b>Direcci&oacute;n: </b><br/>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" readonly disabled type="text" maxlength="50" required name="Direccion" id="Direccion" value="<?php echo stripslashes($direccion_cliente['Direccion']); ?>" />
                        <label class="mdl-textfield__label" for="Direccion">Direcci&oacute;n</label>
                        <span class="mdl-textfield__error">Debe ingresar una direcci&oacute;n v&aacute;lida</span>
                    </div>
                </p>
                <p>
                    <b>Descripci&oacute;n:</b><br />
                    <textarea type='text' name='Descripcion' readonly disabled placeholder="Descripci&oacute;n" class="md-textarea"><?php echo stripslashes($direccion_cliente['Descripcion']);?></textarea>
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
                    <b>Ingrese un Direcci&oacute;n: </b><br/>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" maxlength="50" required name="Direccion" id="Direccion" value="<?php echo stripslashes($direccion_cliente['Direccion']); ?>" />
                        <label class="mdl-textfield__label" for="Direccion">Direcci&oacute;n</label>
                        <span class="mdl-textfield__error">Debe ingresar una direcci&oacute;n v&aacute;lida</span>
                    </div>
                </p>
                <p>
                    <b>Ingrese una Descripci&oacute;n (Opcional):</b><br />
                    <textarea type='text' name='Descripcion' placeholder="Descripci&oacute;n" class="md-textarea"><?php echo stripslashes($direccion_cliente['Descripcion']);?></textarea>
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
                    window.location.href = '<?php echo $url_referencia; ?>';
                }

            </script>
