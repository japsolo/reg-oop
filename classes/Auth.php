<?php
	class Auth
	{
		public function __construct() {
			session_start();

			if( isset($_COOKIE['rememberUser']) && !$this->isLoged()) {
				$this->logIn($_COOKIE['rememberUser']);
			}
		}

		public function logIn($userEmail) {
			$_SESSION['userEmail'] = $userEmail;
			header('location: profile.php');
			exit;
		}

		function isLoged() {
			return isset($_SESSION['userEmail']);
		}
	}
