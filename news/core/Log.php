<?php

class Log
{

	public static function write($message)
	{
		$data = date("Y-m-d H:i:s");
		$text = $data . " | " . $message ."\r\n";
		error_log($text, 3, __DIR__."/../logs/log-errors.log");
	}

	public static function read()
	{
		return file_get_contents(__DIR__."/../logs/log-errors.log");
	}

}