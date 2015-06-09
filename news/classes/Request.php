<?php

abstract class Request
{
	public static function getPost()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$postData = [];
			foreach ($_POST as $key=>$value){
				$postData[$key] = Filter::input($value);
			}
			return $postData;
		} else {
			return false;
		}

	}
}