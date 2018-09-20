<?php
	require_once 'Validator.php';

	class RegisterValidator extends Validator
	{
		private $name;
		private $email;
		private $password;
		private $passwordConfirm;
		private $country;
		private $image;

		public function __construct($post, $files)
		{
			$this->name = isset($post['name']) ? $post['name'] : '';
			$this->email = isset($post['email']) ? $post['email'] : '';
			$this->password = isset($post['password']) ? $post['password'] : '';
			$this->passwordConfirm = isset($post['rePassword']) ? $post['rePassword'] : '';
			$this->country = isset($post['country']) ? $post['country'] : '';
			$this->avatar = isset($files['avatar']) ? $files['avatar'] : '';
		}

		public function isValid()
		{
			if ( empty($this->name) ) {
				$this->addError('name', 'Escribí tu nombre completo');
			}

			if ( empty($this->email) ) {
				$this->addError('email', 'Escribí tu correo electrónico');
			} else if ( !filter_var($this->email, FILTER_VALIDATE_EMAIL) ) {
				$this->addError('email', 'Escribí un correo válido');
			} // else if ( emailExist($email) ) {
				// $this->addError('email', 'Ese email ya fue registrado');
			//}

			if ( empty($this->password) || empty($this->passwordConfirm) ) {
				$this->addError('password', 'La contraseña no puede estar vacía');
			} elseif ( $this->password != $this->passwordConfirm) {
				$this->addError('password', 'Las contraseñas no coinciden');
			} elseif ( strlen($this->password) < 4 || strlen($this->passwordConfirm) < 4 ) {
				$this->addError('password', 'La contraseña debe tener más de 4 caracteres');
			}

			if ( empty($this->country) ) {
				$this->addError('country', 'Elegí un país');
			}

			if ( $this->avatar['error'] !== UPLOAD_ERR_OK ) {
				$this->addError('avatar', 'Ché subite una imagen');
			} else {
				$ext = pathinfo($this->avatar['name'], PATHINFO_EXTENSION);
				if ( !in_array($ext, ALLOWED_IMAGE_TYPES) ) {
					$this->addError('avatar', 'Formato de imagen no permitido');
				}
			}

			return empty($this->getAllErrors());
		}

		public function getName()
		{
			return $this->name;
		}

		public function getEmail()
		{
			return $this->email;
		}

		public function getPassword()
		{
			return $this->password;
		}

		public function getCountry()
		{
			return $this->country;
		}

		public function getImage() {
			return $this->image;
		}
	}
