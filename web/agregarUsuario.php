<?php
include('config/db/db_conf.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `Usuario` ( ) VALUES(  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added row.<br />"; 
echo "<a href='listarUsuario.php'>Back To Listing</a>"; 
} 
?>

    <form action='' method='POST'>
        <p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' />
    </form>
