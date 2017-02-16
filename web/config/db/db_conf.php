<?php

    $db_host = "localhost";
	$db_user = "root";
	$db_pass = "root";
	$db_name = "aiinv";


   	$connection= @mysql_connect($db_host, $db_user, $db_pass);
	$conexion  = @mysql_connect($db_host, $db_user, $db_pass);

	$db = mysql_select_db($db_name, $connection);

	if (!$conexion) {
	    die("No se pudo conectar : " . mysql_error());
	}

	if (! mysql_select_db($db_name) ) {
	    die("No se puede usar base de datos : " . mysql_error());
	}

    function is_session_started() {
		if ( php_sapi_name() !== 'cli' ) {
		    if ( version_compare(phpversion(), '5.4.0', '>=') ) {
		        return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
		    } else {
		        return session_id() === '' ? FALSE : TRUE;
		    }
		} 
		return FALSE;
	}

   	function redirect($url){
	    if (headers_sent()){
	      die('<script type="text/javascript">window.location.href="' . $url . '";</script>');
	    }else{
	      header('Location: ' . $url);
	      die();
	    }    
	}

	function redirectParent($url){
	    if (headers_sent()){
	      die('<script type="text/javascript">parent.document.location.href="' . $url . '";</script>');
	    }else{
	      header('Location: ' . $url);
	      die();
	    }    
	}