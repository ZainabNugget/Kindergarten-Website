<?php
//logout form
session_start();
//destroy the session and go to the homepage
if(session_destroy()){
   header('Location: home.php');
	exit();
 }
?>