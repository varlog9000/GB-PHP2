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
        $login_user = new User;
        if ($_SESSION['loginStatus']) {
            $this->title .= '::Личный кабинет';
            $status = "Здравствуйте, " . $_SESSION['userName'];
            User::log($this->title);
            $log=$_SESSION['userLog'];
            $this->content = $this->Template('v/v_user_index.php', array('status' => $status, 'log' => $log));
        } else {
            if ($_POST['login-button']) {
//                C_Controller::debug($login_user->login($_POST['login'], $_POST['password']));
                if ($login_user->login($_POST['login'], $_POST['password'])) {
//                    header('Location:index.php?c=user');
//                    echo "Залогинились";
                    $this->title .= '::Личный кабинет';
                    $status = "Авторизация прошла успешно, здравствуйте, " . $_SESSION['userName'];
                    $this->content = $this->Template('v/v_user_index.php', array('status' => $status));
                } else {
                    $this->title .= '::Авторизация';
                    $status = "Имя или пароль введены неверно, введите правильные имя и пароль";
                    $this->content = $this->Template('v/v_user_login.php', array('status' => $status));
                }
            } else {
                $this->title .= '::Авторизация';
                $status = "Введите имя и пароль";
                $this->content = $this->Template('v/v_user_login.php', array('status' => $status));
            }
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