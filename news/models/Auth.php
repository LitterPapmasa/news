<?php

class Auth
{
    protected $usersList;
    protected $login, $pass;
    
    public function getUsersList()
    {
        $list = [
            'litter'=>'123',
            'user'=>'1'
        ];
        
        return $list;
    }
    
    public function check($login, $pass, $usersList)
    {
        return !empty($login) and ($this->usersList[$login] == $pass);
    }

    public function calcId($login)
    {
        return md5($login.md5('pass'));
    }

    public function checkLoginActive($this->usersList)
    {
        if (isset($_COOKIE['user']) and
                isset($_COOKIE['userId'])) {
            $login = $_COOKIE['user'];
            $id = $_COOKIE['userId'];
            return (array_key_exists($login, $this->usersList) and 
                        $id == calcId($login));
        }
    }
    
    
    public function setCookie($login)
    {
        setcookie("user", $login, time() + 84000);
        setcookie("userId",calcId($login) , time() + 84000);
    }
    
    public function unsetCookieAuth() {
        setcookie("user", '', 1);
        setcookie("userId", '', 1);
    }        
    
}