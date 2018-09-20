<?php
	class User
	{
		protected $id;
		protected $name;
		protected $email;
		protected $password;
		protected $country;
		protected $avatar;

		public function __construct($post)
		{
			$this->name = $post['name'];
			$this->email = $post['email'];
			$this->country = $post['country'];
			$this->password = $post['password'];
		}

		public function setId($id)
		{
			$this->id = $id;
		}

		public function setAvatar($avatarName)
		{
			$this->avatar = $avatarName;
		}

		public function setPasswordHash($password)
		{
			return password_hash($password, PASSWORD_DEFAULT);
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

		public function getavatar()
		{
			return $this->avatar;
		}

		public function getAllData()
		{
			return [
				'id' => $this->id,
				'name' => $this->name,
				'email' => $this->email,
				'country' => $this->country,
				'password' => self::setPasswordHash($this->password),
				'avatar' => $this->avatar,
			];
		}
	}
