<?php
   require_once("session.php");
   if(session_destroy()) {
      	header("Location: ../../login.php");
   }
