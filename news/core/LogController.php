<?php

class LogController 
{

	public function addError($message)
	{
		$data = date("Y-m-d H:i:s");
		$text = $data . " | " . $message ."\r\n"; 
		error_log($text, 3, __DIR__."/../logs/log-errors.log");
	}
	
	
	public function indexAction()
	{
		$this->readlogs();
	}
	
	public function readlogs()
	{
		$errors = file_get_contents(INDEX_URL."/logs/log-errors.log");
		
		$view = new View();
		$view->errors = $errors;
		$view->render('logs\errors.php');
	}
	
}