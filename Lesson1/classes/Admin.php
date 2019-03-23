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
        // Обращаемся к БД и создаем пользователя с данными параметрами
    }

    // Имеет право удалить пользователя
    public function deleteUser($id)
    {
        // Ищем в БД пользователя по id и удаляем его
    }

    public function setUserName($id, $name)
    {
        // Ищем в БД пользователя по id и меняем ему имя
    }

    public function setUserRole($id, $role)
    {
        // Ищем в БД пользователя по id и меняем ему роль в системе
    }

    public function setUserPhone1($id, $Phone1)
    {
        // Ищем в БД пользователя по id и меняем телефон
    }

    public function setUserPhone2($id, $Phone2)
    {
        // Ищем в БД пользователя по id и меняем телефон
    }

    public function setUserEmail($id, $email)
    {
        // Ищем в БД пользователя по id и меняем почту
    }

    public function setUserPassword($id, $pass1, $pass2)
    {
        if ($pass1 == $pass2) {
            $passHash = $this->generatePassHash($pass1);
            // Обновляем пароль пользователя в БД по его ID
            return true;
        } else {
            return null;
        }
    }

    // Имеет право редактировать Права ролей пользователей на чтение и запись
    public function setRoleUserRightRead($role, $userRightRead)
    {
        // Выбирает из базы роль того и меняет ее параметры
    }

    public function setRoleUserRightWrite($role, $userRightWrite)
    {
        // Выбирает из базы роль того и меняет ее параметры
    }


}