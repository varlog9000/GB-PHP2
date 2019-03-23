<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.03.2019
 * Time: 20:26
 */

class User
{
    private $id; // Идентификатор пользователя
    private $name; // Имя пользователя
    private $login; // Логин
    private $passHash; // Хеш пароля
    private $role; // Роль пользователя в системе
    private $email; // Почта пользователя
    private $phone1; // Контактные телефоны
    private $phone2;
    private $roleRightsRead = []; // Здесь долны быть списки объектов, к которым у Пользователя есть доступ для чтения
    private $roleRightsWrite = []; // Здесь долны быть списки объектов, к которым у Пользователя есть доступ для записи

    // Установка значений параметров которые пользователю разрешено менять
    public function setEmail($email)
    {
        $this->email = $email;
        $_SESSION['userEmail'] = $this->email;
    }

    public function setPhone($phone1, $phone2)
    {
        $this->phone1 = $phone1;
        $this->phone2 = $phone2;
        $_SESSION['userPhone1'] = $this->phone1;
        $_SESSION['userPhone2'] = $this->phone2;
    }

    public function setPass($pwd1, $pwd2) // Смена пароля
    {
        if ($pwd1 == $pwd2) {
            $this->passHash = $this->generatePassHash($pwd1);
            return true;
        } else {
            return null;
        }
    }

    // Чтение значений параметров, который пользователь может читать
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPassHash()
    {
        return $this->passHash;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone1()
    {
        return $this->phone1;
    }

    public function getPhone2()
    {
        return $this->phone2;
    }

    public function getRightsRead()
    {
        return $this->roleRightsRead;
    }

    public function getRightsWrite()
    {
        return $this->roleRightsWrite;
    }


    public function __construct($userLoginName = null, $userPassword = null) // Вызызаем конструктор при каждом запуске,
        // проверяем авторизован ли пользователь в переменной $_SESSION['userLoggedIn'] ,
        // если неавторизован и переданы имя и пароль - проверяем пользователя на наличие в БД
    {
        if (!$_SESSION['userLoggedIn']) {
            // Если не залогинен, то логиним по имени и паролю из формы
            $this->userLogin($userLoginName, $userPassword);
        } else{
            // если залогинен, то берем из сессии данные и заполняем переменные объекта
            $this->id= $_SESSION['userId'];
            $this->name= $_SESSION['userName'];
            $this->login = $_SESSION['userLoginName']; //
            $this->role= $_SESSION['userRole'] ;
            $this->email= $_SESSION['userEmail'];
            $this->phone1 =$_SESSION['userPhone1'];
            $this->phone2 = $_SESSION['userPhone2'];
            $this->roleRightsRead = $_SESSION['userRightsRead'];
            $this->roleRightsWrite = $_SESSION['userRightsWrite'];
        }
    }


    public function userLogin($userLoginName, $userPassword) // Проверяем есть ли пользователь в БД
    {
        /* делаем запрос к БД и пробиваем есть ли такой полпользователь
        Проверяем наличие полей в БД $userLoginName и generatePassHash($userPassword)*/
        $userExist = true; // - результат работы функции проверки

        if ($userExist) {
            $_SESSION['userLoginName'] = $userLoginName;
            $_SESSION['userPassword'] = $userPassword;
            $_SESSION['userLoggedIn'] = true;
            $_SESSION['relativeDay'] = 0; // Переменная показывающая на сколько дней от текущего момента отличается дата,
            // сыбытия которой мы будем отображать и редактировать. В прошлой версии проекта логика работала вокруг этой
            // переменной. В этой итеррации проекта неисключено, что перейду на другой алгоритм.
            $_SESSION['userId'] = $this->id; // Достаем из базы Идентификатор пользователя
            $_SESSION['userName'] = $this->name; //  Достаем из базы Имя пользователя
            $_SESSION['userRole'] = $this->role; // Достаем из базы  Роль пользователя в системе
            $_SESSION['userEmail'] = $this->email; // Достаем из базы  Почту пользователя
            $_SESSION['userPhone1'] = $this->phone1; // Достаем из базы  Контактные телефоны
            $_SESSION['userPhone2'] = $this->phone2;
            $_SESSION['userRightsRead'] = $this->rightsRead = []; // Достаем из базы списки объектов, к которым у Пользователя есть доступ для чтения
            $_SESSION['userRightsWrite'] = $this->RrightsWrite = []; // Достаем из базы  списки объектов, к которым у Пользователя есть доступ для записи
            return true;
        } else {
            session_destroy();
            return false;
        }
    }


    public function generatePassHash($pass) // Генератор хеша пароля
    {
        return md5($pass);
    }
}