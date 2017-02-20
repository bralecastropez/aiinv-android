<?php
    require_once("config/db/session.php");
    $page_title = "Agregar Grupo";
    $page_maintance = true;
    require_once("config/page/header.php");
    if (isset($_POST['submitted'])) { 
        foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
        $sql = "INSERT INTO `grupo` ( `Nombre` ,  `Descripcion`  ) VALUES(  '{$_POST['Nombre']}' ,  '{$_POST['Descripcion']}'  ) "; 
        mysql_query($sql) or die(mysql_error()); 
        redirect("listarGrupos.php"); 
    } 
?>
    <form action='' method='POST' style="margin: 20px;">
        <p>
            <b>Ingrese un Nombre:</b><br />
            <input placeholder="Nombre" type='text' name='Nombre' required data-error="Este campo es requerido" />
        </p>
        <p>
            <b>Ingrese una Descripci&oacute;n (Opcional):</b><br />
            <textarea type='text' name='Descripcion' placeholder="Descripci&oacute;n" class="md-textarea"></textarea>
        </p>
        <p>
            <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="window.location.href='listarGrupos.php'">
                Cancelar
            </button>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type='submit' style="color: white;">
                Agregar
            </button>
            <input type='hidden' value='1' name='submitted' />
        </p>
    </form>
    <?php require_once("config/page/footer.php"); ?>
