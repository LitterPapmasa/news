<?php
 
class AuthController {

	public function indexAction()
	{
		$this->loginAction();	
	}
	
	public function loginAction()
	{
		$view = new View;
		
		if (false !== Auth::checkLoginActive()){
			header("Location: " . INDEX_URL . "/news/insert");			
			exit;
		}
		
		if (false !== ($posts = Request::getPost())) {
			$errors = [
					'login'=>'',
					'pass'=>''	
			];
			
			var_dump('login:'.$posts['login'].'<br>');
			var_dump('pass:'.$posts['pass']);
			if (empty($posts['login'])) {
				$errors['login'] = "Не заполнено поле \"login\"";
			}
			if (empty($posts['pass'])) {
				$errors['pass'] = "Не заполнено поле \"password\"";
			}
			if (!empty($errors['login']) or !empty($errors['pass'])){
					
				$view->message = $errors['login'] . '<br>' . $errors['pass'];
				$view->render('forms/auth-form.php');
			} else {	
				
				if (false !== Auth::check($posts['login'], $posts['pass'])) {
					Auth::setCookie($posts['login']);
					var_dump("auth 2");
					header("Location: " . INDEX_URL . "/news/insert");								
					exit;	
				} else {
					$view->render('forms/auth-form.php');
				}								
			}
		}
				
	}
	
	public function cookAction()
	{
		$auth = new Auth;
		$auth->setCookie('litter');		
	}
	

	public function iscookAction()
	{
		var_dump(Auth::checkLoginActive());		
	}
	
	public function logoutAction()
	{
		$auth = new Auth();
		$auth->unsetCookieAuth();
	}
}