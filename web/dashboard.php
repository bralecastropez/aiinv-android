<?php
    require_once("config/db/session.php");
    $page_title = "AIINV - Dashboard";
    require_once("config/page/header.php");
    $Rol = (int) $_SESSION['login_user_rol'];
    if($Rol == 2) {
        redirect("dashboardCliente.php");
    } else if($Rol == 1) {
        redirect("dashboardAdmin.php");
    }
?>
    <h4>SuperUltraMegaHexa Dashboard</h4>
    <?php require_once("config/page/footer.php"); ?>
