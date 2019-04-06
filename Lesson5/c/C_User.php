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
            $status = "";
            $this->content = $this->Template('v/v_user_index.php', array('text' => $status));
        } else {
            if ($_POST['getLogin']) {
                $login = new User;
                if ($login->login($_POST['login'], $_POST['password'])) {
                    $_SESSION['loginStatus'] = $login->getLoginStatus();
                    $_SESSION['userName'] = $login->getUserName();
                    $_SESSION['userId'] = $login->getUserId();
                    $this->title .= '::Личный кабинет';
                    $status = "Эавторизация прошла успешно";
                    $this->content = $this->Template('v/v_user_index.php', array('text' => $status));
                }
            }
            $this->title .= '::Авторизация';
            $status = "Введите имя и пароль";
            $this->content = $this->Template('v/v_user_login.php', array('text' => $status));
        }
    }

    public function action_logout()
    {
        $this->title .= '::Авторизация';
        $status = "Вы успешно разлогинились, снова введите имя и пароль";
        $this->content = $this->Template('v/v_user_login.php', array('text' => $status));
    }
}