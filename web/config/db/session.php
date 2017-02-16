<?php
    require_once('db_conf.php');

   	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	if ( is_session_started() === FALSE ) {
		session_start();
	}

	if (isset( $_SESSION['login_user'])) {
		$user_check = $_SESSION['login_user'];
		$ses_sql=mysql_query("select nick from usuario where nick='$user_check'", $connection);
		$row = mysql_fetch_assoc($ses_sql);
		$login_session =$row['nick'];
		$Rol = $_SESSION['login_user_rol'];
		if(!isset($login_session)){
			mysql_close($connection); 
			if ($now > $_SESSION['expire']) {
				$now = time();
            	session_destroy();
		        header("Location: login.php");
	        } else {
				if(validarUrl($Rol, $actual_link)) {

				} else {
					header("Location: index.php");
				}
			}
			/*if (strpos($actual_link, 'miCuenta') !== false) {

			} else {
	        	switch ($Rol) {
	        		case 1:
						header("location: dashboardAdmin.php"); 
	        			break;
	        		case 2:
	        			header("location: dashboardVentas.php"); 
	        			break;
	        		case 3:
	        			header("location: miCuenta.php"); 
	        			break;
	        		default:
	        			header("location: index.php"); 
	        			break;
	        	}
	        	//header("location: index.php"); 
			}*/
		}
	} else {
		if (strpos($actual_link, "index") == true || 
            strpos($actual_link, "crearCuenta") == true || 
            strpos($actual_link, "contactanos") == true) {

		} else {
			if (strpos($actual_link, 'login') === false) {
				header('Location: login.php');	
			}
		}
	}
