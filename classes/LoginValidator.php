<?php
	require_once 'Validator.php';

	class LoginValidator extends Validator
	{
		private $email;
		private $password;

		public function __construct($post)
		{
			$this->email = isset($post['email']) ? $post['email'] : '';
			$this->password = isset($post['password']) ? $post['password'] : '';
		}

		public function isValid()
		{
			if( empty($this->email) ) {
				$this->addError('email', 'El campo de email no puede estar vacío');
			} else if( !filter_var($this->email, FILTER_VALIDATE_EMAIL) ) {
				$this->addError('email', 'Escribí un correo electrónico válido');
			} /*else if ( !$user = getUserByEmail($email) ) {
				$errors['email'] = 'Este correo no pertenece a un registro válido';
			} else if( !password_verify($password, $user['password']) ) {
				$errors['password'] = 'Error de credenciales';
			}*/

			if( empty($this->password) ) {
				$this->addError('password', 'El campo de contraseña no puede estar vacío');
			}

			return empty($this->getAllErrors());
		}

		public function getEmail()
		{
			return $this->email;
		}

		public function getPassword()
		{
			return $this->password;
		}
	}
