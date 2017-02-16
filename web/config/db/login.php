<?php
    require_once("session.php");
	$error = '';
    if (isset($_SESSION['login_user'])) {
		header("Location: dashboardAdmin.php");
	} else {
		if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $username = mysql_real_escape_string(stripslashes($username));
            $password = strrev(md5(mysql_real_escape_string(stripslashes($password))));

            $query = mysql_query("select * from usuario where Pass='$password' AND Nick='$username'", $connection);
            $rows = (int) mysql_num_rows($query);
            if ($rows === 1) {
                
                $_SESSION['login_user']            = $username; 
                $_SESSION['login_user_id']         = (int) obtenerIdUsuario($username, $password);
                $_SESSION['login_user_rol']        = (int) obtenerRol($username, $password);
                
                header("Location: dashboardAdmin.php"); 
                
            } else {
                $error = "Usuario o Contrase&ntilde;a Incorrectos!";
            }
        }
    }

    function obtenerRol ($Nick, $Pass) {
        $result = mysql_query("select * from usuario where pass='$Pass' AND nick='$Nick'");
        // Rol 1- Admin 2- Cliente 0 - SuperAdmin
        $Rol = (int) 0;
        $IdCliente = (int) 0;
        $IdCobrador = (int) 0;

        if($result === FALSE) { die(mysql_error()); }

        while($row = mysql_fetch_array($result)) {
            $IdCliente = $row['IdCliente'];
            $IdCobrador = $row['IdCobrador'];
        }
        
        if ($IdCliente == 0) {
            $Rol = 1;
            if ($IdCobrador == 0) {
                $Rol = 0;
            }
        } else {
            $Rol = 2;
        }
        return $Rol;
    }

    function obtenerIdUsuario ($Nick, $Pass) {
        $result = mysql_query("select * from usuario where pass='$Pass' AND nick='$Nick'");

        if($result === FALSE) { die(mysql_error()); }

        while($row = mysql_fetch_array($result)) {
            return $row['IdUsuario'];
        }
    }
