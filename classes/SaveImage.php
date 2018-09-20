<?php
	abstract class SaveImage
	{
		public static $imageName;

		public static function uploadImage($image)
		{
			$imgName = $image['name'];
			$ext = pathinfo($imgName, PATHINFO_EXTENSION);

			$theOriginalFile = $image['tmp_name'];

			$finalName = uniqid('user_img_') .  '.' . $ext;

			$theFinalFile = USER_IMAGE_PATH . $finalName;

			move_uploaded_file($theOriginalFile, $theFinalFile);

			self::$imageName = $finalName;
		}
	}
