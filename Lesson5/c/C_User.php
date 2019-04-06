<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 03.04.2019
 * Time: 22:30
 */
include_once "m/User.php";

class C_User extends C_Base
{
    public function action_index()
    {
        if ($_SESSION['loginStatus']) {
            $this->title .= '::Личный кабинет';
            $status = "Здравствуйте, " . $_SESSION['userName'];
            $this->content = $this->Template('v/v_user_index.php', array('status' => $status));
        } else {
            if ($_POST['getLogin']) {
                $login = new User;
                if ($login->login($_POST['login'], $_POST['password'])) {
                    $this->title .= '::Личный кабинет';
                    $status = "Авторизация прошла успешно";
                    $this->content = $this->Template('v/v_user_index.php', array('status' => $status));
                } else {
                    $this->title .= '::Авторизация';
                    $status = "Имя или пароль введены неверно, введите правильные имя и пароль";
                    $this->content = $this->Template('v/v_user_login.php', array('status' => $status));
                }
            }
            $this->title .= '::Авторизация';
            $status = "Введите имя и пароль";
            $this->content = $this->Template('v/v_user_login.php', array('status' => $status));
        }
    }

    public function action_logout()
    {
        $login = new User;
        $login->logout();
        $this->title .= '::Авторизация';
        $status = "Вы успешно разлогинились, снова введите имя и пароль";
        $this->content = $this->Template('v/v_user_login.php', array('status' => $status));
    }
}