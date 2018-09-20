<?php
	abstract class Validator
	{
		private $errors;

		public function __construct()
		{
			$this->errors = [];
		}

		public function getAllErrors()
		{
			return $this->errors;
		}

		public function fieldHasError($field)
		{
			return isset($this->errors[$field]);
		}

		public function getFieldError($field)
		{
			return isset($this->errors[$field]) ? $this->errors[$field] : false;
		}


		public function addError($field, $error)
		{
			$this->errors[$field] = $error;
		}

		public abstract function isValid();
	}
