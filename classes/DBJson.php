<?php
	require_once 'DB.php';
	require_once 'User.php';

	class DBJson extends DB
	{
		private $database;
		private static $allUsers;

		public function __construct($archive)
		{
			$this->database = $archive;
			self::$allUsers = self::getAllUsers();
		}

		public function getAllUsers()
		{
			$allUsersString = file_get_contents($this->database);

			$usersInArray = explode(PHP_EOL, $allUsersString);
			array_pop($usersInArray);

			$finalUsersArray = [];

			foreach ($usersInArray as $oneUser) {
				$finalUsersArray[] = json_decode($oneUser);
			}

			return $finalUsersArray;
		}

		public function generateId(){
			if( count(self::$allUsers) == 0 ) {
				return 1;
			}

			$lastUser = array_pop(self::$allUsers);

			return $lastUser->id + 1;
		}

		public function emailExist($email)
		{
			foreach (self::$allUsers as $oneUser) {
				if ($email == $oneUser->email) {
					return true;
				}
			}

			return false;
		}

		public function getUserByEmail($email)
		{
			foreach (self::$allUsers as $oneUser) {
				if($oneUser->email == $email) {
					$theUser = new User((array) $oneUser);
					$theUser->setId($oneUser->id);
					$theUser->setAvatar($oneUser->avatar);
					return $theUser;
				}
			}

			return false;
		}

		public function saveUser(User $user)
		{
			$userInJsonFormat = json_encode($user->getAllData());

			file_put_contents($this->database, $userInJsonFormat . PHP_EOL, FILE_APPEND);
		}
	}
