<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.03.2019
 * Time: 23:38
 */

class Admin extends User
{
    // Имеет право создавать пользователей
    public function createUser($name, $login, $pass, $role, $email, $phone1, $phone2)
    {

    }

    // Имеет право редактировать Права ролей пользователей на чтение и запись
    public function setRoleUserRightRead($role, $userRightRead)
    {
// Выбирает из базы роль того или иного пользователя и меняет ее параметры
    }

    public function setRoleUserRightWrite($role, $userRightWrite)
    {
// Выбирает из базы роль того или иного пользователя и меняет ее параметры
    }


}