<?php
    require_once("config/db/session.php");
    $page_title = "AIINV - Eliminar Grupo";
    require_once("config/page/header.php");
    if (isset($_GET['IdGrupo']) ) { 
        $IdGrupo = (int) $_GET['IdGrupo']; 
        if (isset($_POST['submitted'])) { 
            foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
            $sql = "DELETE FROM `grupo` WHERE `IdGrupo` = '$IdGrupo' "; mysql_query($sql) or die(mysql_error()); 
            redirect("listarGrupos.php");
        } 
        $row = mysql_fetch_array ( mysql_query("SELECT * FROM `grupo` WHERE `IdGrupo` = '$IdGrupo' ")); 
?>
    <form action='' method='POST' style="margin: 20px;">
        <p>
            <b>Ingrese un Nombre:</b><br />
            <input placeholder="Nombre" type='text' name='Nombre' disabled required data-error="Este campo es requerido" value="<?= stripslashes($row['Nombre']) ?>" />
        </p>
        <p>
            <b>Ingrese una Descripci&oacute;n (Opcional):</b><br />
            <textarea type='text' disabled name='Descripcion' placeholder="Descripci&oacute;n" class="md-textarea"><?= stripslashes($row['Descripcion']) ?></textarea>
        </p>
        <p>
            <h5 style="margin: 20px;">¿Desea eliminar el registro?</h5>
            <button type="button" class="mdl-button mdl-js-button mdl-button--accent" onclick="window.location.href='listarGrupos.php'">
                Cancelar
            </button> | <button style="margin-left: 10px; color: white;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type='submit'>
                Eliminar
            </button>
            <input type='hidden' value='1' name='submitted' />
        </p>
    </form>
    <?php } require_once("config/page/footer.php"); ?>
