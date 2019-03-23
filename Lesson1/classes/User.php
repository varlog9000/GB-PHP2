<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.03.2019
 * Time: 20:26
 */

class User
{
    private $id;
    private $name;
    private $login;
    private $passHash;
    private $pass;
    private $role;
    private $email;
    private $phone1;
    private $phone2;
    private $rightsRead = ['my-task'=>[]]; // Здесь долны быть описаны объекты, к которым у Пользователя есть доступ для чтения
    private $rightsWrite = []; // Здесь долны быть описаны объекты, к которым у Пользователя есть доступ для записи

    public function __construct($id, $name, $login, $pass, $role, $email, $phone1, $phone2)
    {
//        $params = [$id, $this->set($this->id, $id);, $login, $pass, $role, $email, $phone1, $phone2];

        $this->set($this->id, $id);
        $this->set($this->name, $name);
        $this->set($this->login, $login);
        $this->set($this->pass, $pass);
        $this->set($this->email, $email);
        $this->set($this->phone1, $phone1);
        $this->set($this->phone2, $phone2);
        $this->set($this->id, $id);
    }

$a=;
    public function set($variable, $value)
    {
        $this->$variable = $value;
    }

    public function get($param)
    {
        return $this->$param;
    }

    public function renewPassword($pwd1, $pwd2)
    {
        if ($pwd1 == $pwd2) {
            $this->passHash = self::getPassHash($pwd1);
            return true;
        } else {
            return null;
        }
    }

    static function getPassHash($pass)
    {
        return md5($pass);
    }
}