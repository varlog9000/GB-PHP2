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
        $this->link = Pdo();
    }


    function index($data)
    {
        if (!isset($_SESSION['user_id'])) {
            header("location:index.php?path=user/login");
        }
        return [];
    }

    public function login($data)
    {
        if (isset($_REQUEST['login'])) {

        }
    }

    public function reg($data)
    {
        $reg_error = '';
        if (isset($_REQUEST['reg'])) {
            if ($_REQUEST['pass1'] == $_REQUEST['pass2']) {
//                if ($this->link->Select('user', 'user_login', $_REQUEST['login']) == 0) {
                if (Pdo::getRows("SELECT * FROM users WHERE user_login = ?",[$_REQUEST['login']])== 0) {
//                    $passHash = $this->link->Password($_REQUEST['login'], $_REQUEST['pass1']);
                    $passHash = Pdo::password($_REQUEST['login'], $_REQUEST['pass1']);
                    $newUserId = $this->link->Insert('user', ['user_name' => $_REQUEST['user_name'], 'user_login' => $_REQUEST['login'], 'user_password' => $passHash]);
                    if ($newUserId > 0) {
                        $_SESSION['user_id'] = $newUserId;
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

}