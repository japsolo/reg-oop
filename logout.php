<?php
	session_start();
	session_destroy();
	setcookie('rememberUser', '', time() - 10);

	header('location: index.php'); 
	exit;