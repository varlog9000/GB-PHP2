<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.04.2019
 * Time: 12:11
 */

class Userauth
{

    public function userAuthorisation()
    {
        $passHash = Sql::password($_REQUEST['login'], $_REQUEST['password']);
        return Sql::getRow('SELECT * FROM `users` WHERE `user_login`=? AND `user_password`=?', [$_REQUEST['login'], $passHash])['id_user'];
    }

    public function is_exist_user($login)
    {
        return Sql::getRows('SELECT * FROM `users` WHERE `user_login`=?', [$login]);;
    }

    public function createUser(){
        $passHash = Sql::password($_REQUEST['login'], $_REQUEST['pass1']);
        return Sql::insert('INSERT INTO `users` (`user_name`,`user_login`,`user_password`) VALUES (?,?,?)', [$_REQUEST['user_name'], $_REQUEST['login'], $passHash]);
    }
}