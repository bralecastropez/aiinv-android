<?php
    require_once("config/db/session.php"); 
    $url_referencia = $_GET['Referencia'];
    if(isset($_GET['IdTelefonoCliente'])) {
        $telefono_cliente = mysql_fetch_array(mysql_query("SELECT * FROM `telefonocliente` WHERE `IdTelefonoCliente` = '" .  $_GET["IdTelefonoCliente"] . "'"));
    } 

    switch ($_GET['Accion']) {
        case 'Agregar':
            $page_title = "Agregar Teléfono";
            if(isset($_POST['Added'])) {
                foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
                $IdCliente = $_GET['IdCliente'];
                $sql = "INSERT INTO `telefonocliente` (IdCliente, Telefono, Descripcion) VALUES ('$IdCliente' ,  '{$_POST['Telefono']}' ,'{$_POST['Descripcion']}')"; 
                mysql_query($sql) or die(mysql_error()); 
                //echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
                redirect($url_referencia);
            }
            break;
            
        case 'Eliminar':
            $page_title = "Eliminar Teléfono";
            if(isset($_POST['Deleted'])) {
                foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
                $sql = "DELETE FROM `telefonocliente` WHERE `IdTelefonoCliente` = " . $telefono_cliente['IdTelefonoCliente']; 
                mysql_query($sql) or die(mysql_error()); 
                //echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
                redirect($url_referencia);
            }
            break;
        
        case 'Modificar':
            $page_title = "Modificar Teléfono";
            if(isset($_POST['Modified'])) {
                foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
                $sql = "UPDATE `telefonocliente` SET `Telefono` =  '{$_POST['Telefono']}' ,  `Descripcion` =  '{$_POST['Descripcion']}'   WHERE `IdTelefonoCliente` = " . $telefono_cliente['IdTelefonoCliente']; 
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
                <b>Ingrese un Tel&eacute;fono: </b><br/>
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" type="text" maxlength="50" required name="Telefono" id="Telefono" />
                    <label class="mdl-textfield__label" for="Telefono">Tel&eacute;fono</label>
                    <span class="mdl-textfield__error">Debe ingresar un tel&eacute;fono v&aacute;lido</span>
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
            <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="window.location.href='<?php echo $url_referencia; ?>'">
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
                    <b>Tel&eacute;fono: </b><br/>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" readonly disabled type="text" maxlength="50" required name="Telefono" id="Telefono" value="<?php echo stripslashes($telefono_cliente['Telefono']); ?>" />
                        <label class="mdl-textfield__label" for="Telefono">Tel&eacute;fono</label>
                        <span class="mdl-textfield__error">Debe ingresar un tel&eacute;fono v&aacute;lido</span>
                    </div>
                </p>
                <p>
                    <b>Descripci&oacute;n:</b><br />
                    <textarea type='text' name='Descripcion' readonly disabled placeholder="Descripci&oacute;n" class="md-textarea"><?php echo stripslashes($telefono_cliente['Descripcion']);?></textarea>
                </p>
            </div>
            <div class="modal-footer">
                <p><strong>¿Desea eliminar este registro?</strong></p>
                <input type="hidden" name="Deleted" id="Deleted" value="1" />
                <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="window.location.href='<?php echo $url_referencia; ?>'">
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
                    <b>Ingrese un Tel&eacute;fono: </b><br/>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" maxlength="50" required name="Telefono" id="Telefono" value="<?php echo stripslashes($telefono_cliente['Telefono']); ?>" />
                        <label class="mdl-textfield__label" for="Telefono">Tel&eacute;fono</label>
                        <span class="mdl-textfield__error">Debe ingresar un tel&eacute;fono v&aacute;lido</span>
                    </div>
                </p>
                <p>
                    <b>Ingrese una Descripci&oacute;n (Opcional):</b><br />
                    <textarea type='text' name='Descripcion' placeholder="Descripci&oacute;n" class="md-textarea"><?php echo stripslashes($telefono_cliente['Descripcion']);?></textarea>
                </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="Modified" id="Modified" value="1" />
                <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="window.location.href='<?php echo $url_referencia; ?>'">
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
