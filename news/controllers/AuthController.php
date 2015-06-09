<?php
 
class AuthController {

	public function indexAction()
	{
		$this->loginAction();	
	}
	
	public function loginAction()
	{
		$view = new View;
		$news = new NewsController();
		
		if (false !== Auth::checkLoginActive()){
			var_dump("auth ok");
			$news->indexAction();			
			exit;
		}
		
		if (false !== ($posts = Request::getPost())) {
			$errors = [];
			
			if (empty($posts['login']) and $posts['login'] !== '0') {
				$errors['login'] = "Не заполнено поле \"login\"";
			}
			if (empty($posts['pass']) and $posts['pass'] !== '0') {
				$errors['pass'] = "Не заполнено поле \"password\"";
			}
			if (!isset($errors['login']) or !isset($errors['pass'])){
					
				$view->message = $errors['login'] . '<br>' . $errors['pass'];
				$view->render('forms/auth-form.php');
			} else {
				$auth = new Auth();
				var_dump("auth 2");
				if (false !== $auth->check($posts['login'], $posts['pass'])) {
					$auth->setCookie($posts['login']);
					$news->indexAction();
				} else {
					$view->render('forms/auth-form.php');
				}								
			}
		}
				
	}
	
	public function logoutAction()
	{
		$auth = new Auth();
		$auth->unsetCookieAuth();
	}
}