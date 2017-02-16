<?php
    require_once("config/db/session.php");
    $page_title = "AIINV - Dashboard";
    require_once("config/page/header.php");
    $Rol = (int) $_SESSION['login_user_rol'];
    if($Rol == 2) {
        redirect("dashboardCliente.php");
    } else if($Rol == 0) {
        redirect("dashboard.php");
    }
?>
    <h4>DashboardAdmin
        <?php echo $Rol; ?>
    </h4>
    <?php require_once("config/page/footer.php"); ?>
