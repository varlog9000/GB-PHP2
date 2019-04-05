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
        $login = new User;

        if ($_POST['getLogin']) {
            $text = $login->login($_POST['login'], $_POST['password']);
        }

        $this->title .= '::Авторизация';
//        $text = Text::text_get();
        $this->content = $this->Template('v/v_user_index.php', array('text' => $text));
    }

    public function action_login()
    {
        $this->title .= '::Авторизация';
//        $text = Text::text_get();
        $this->content = $this->Template('v/v_user_index.php', array('text' => $text));
    }
}