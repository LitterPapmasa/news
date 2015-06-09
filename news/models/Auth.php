<?php

class Auth
{
    protected $login, $pass;

    protected static $userList = [
            'litter'=>'123',
            'user'=>'1'
    ];


    public function check($login, $pass)
    {
        return !empty($login) and (self::$userList[$login] == $pass);
    }

    public function calcId($login)
    {
        return md5($login.md5('pass'));
    }

    public static function checkLoginActive()
    {
        if (isset($_COOKIE['user']) and
                isset($_COOKIE['userId'])) {
            $login = $_COOKIE['user'];
            $id = $_COOKIE['userId'];
            $res =  (array_key_exists($login, self::$userList) 
            		and $id == $this->calcId($login));
            var_dump($res);
            die;
            return (bool)$res;
        } else {
        	return false;
        }
    }


    public function setCookie($login)
    {
        setcookie("user", $login, time() + 84000);
        setcookie("userId",$this->calcId($login) , time() + 84000);
    }

    public function unsetCookieAuth() {
        setcookie("user", '', 1);
        setcookie("userId", '', 1);
    }

}