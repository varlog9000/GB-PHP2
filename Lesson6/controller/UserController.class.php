<?php

class UserController extends Controller
{
    public $view = 'user';
    public $title;
    public $link;

    public function __construct()
    {
        parent::__construct();
        $this->title .= ' | Личный кабинет';
//        $this->link = Db();
    }


    function index($data)
    {
        if (empty($_SESSION['user_id'])) {
            header("location:index.php?path=user/login");
        }
        return [];
    }

    public function login($data)
    {
        if (isset($_REQUEST['knock-knock'])) {
            $passHash = Sql::password($_REQUEST['login'], $_REQUEST['password']);
            $user_id = Sql::getRow("SELECT * FROM users WHERE `user_login`='?' AND `user_password`='?'", [$_REQUEST['login'], $passHash]);
            print_r($user_id);
//            $_SESSION['user_id']=
//            header("location:index.php?path=user");
        }
    }

    public function reg($data)
    {
        $reg_error = '';
        if (isset($_REQUEST['reg'])) {
            if ($_REQUEST['pass1'] == $_REQUEST['pass2'] && !empty($_REQUEST['pass1']) && !empty($_REQUEST['login']) && !empty($_REQUEST['user_name'])) {
                $login = $_REQUEST['login'];
                $answer = Sql::getRows("SELECT * FROM users WHERE user_login=?", [$login]);
                if (empty($answer)) {
                    $passHash = Sql::password($_REQUEST['login'], $_REQUEST['pass1']);
                    $newUserId = Sql::insert("INSERT INTO users (user_name,user_login,user_password) VALUES (?,?,?)", [$_REQUEST['user_name'], $_REQUEST['login'], $passHash]);
                    if ($newUserId > 0) {
                        header("location:index.php?path=user");
                    }
                } else {
                    $reg_error = 'Пользователь с таким логином существует';
                }
            } else {
                $reg_error = 'Введенные пароли не совпадают';
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header("location:index.php?path=user");
    }

}