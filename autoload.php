<?php

	require_once 'config.php';

	spl_autoload_register(function ($nameClass) {
		include 'classes/' . $nameClass . '.php';
	});

	$DB = new DBJson('data/users.json');
	$Auth = new Auth();
