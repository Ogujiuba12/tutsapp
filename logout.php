<?php 
	session_start();
	session_unset($_SESSION['user']);
	session_destroy();
	unset($_SESSION['id']);
	unset($_SESSION['username']);
	unset($_SESSION['email']);
	unset($_SESSION['verify']);
	header('location: index.php');
?>