<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 03.04.2019
 * Time: 22:30
 */

class C_User extends C_Base
{
    public function action_login(){
        $this->title .= '::Авторизация';
        $text = text_get();
        $this->content = $this->Template('v/v_index.php', array('text' => $text));
    }
}