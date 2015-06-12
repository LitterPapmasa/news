<?php

class Auth
{
	protected static $yes = false;
	
    protected static $userList = [
            'litter'=>'123',
            'user'=>'1'
    ];

	public static function start()
	{
		session_start();
	}
	
    public static function check($login, $pass)
    {
         $res = (!empty($login) and (self::$userList[$login] == $pass));
         return $res;
    }

    public static function calcId($login)
    {
        if (false !== ($res = md5($login.md5('pass')))) {
        	return $res;
        } else {
        	return false;
        }
    }

    public static function checkLoginActive()
    {
    	if (isset($_SESSION['auth']) and  $_SESSION['auth'] === 'set') {
    		return true;
    	}
    	
    	// check cookies set
        if (isset($_COOKIE['user']) and
                isset($_COOKIE['userId'])) {
            $login = $_COOKIE['user'];
            $id = $_COOKIE['userId'];
            if ($res = (array_key_exists($login, self::$userList) 
            	  		and $id == self::calcId($login))) {
            	  			var_dump('chekLogin_cookie_ok');           	
            }            
            return $res;
        } else {
        	return false;
        }
    }


    public static function setCookie($login)
    {
    	$_SESSION['auth'] = 'set';
        setcookie("user", $login, time() + 84000, "/" );
        setcookie("userId",self::calcId($login) , time() + 84000, "/" );        
    }
    

    public static function unsetCookieAuth() {
    	unset($_SESSION['auth']);
        setcookie("user", '', 1, "/");
        setcookie("userId", '', 1, "/");
        
    }

}