<?php

class UserController extends Controller
{
    public $view = 'user';
    public $title;
    public $link;
    public $statusMessage;

    public function __construct()
    {
        parent::__construct();
        $this->title .= ' | Личный кабинет';
        new UserAuth;
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
        $this->title .= ' | Авторизация';
        $reg_error = '';
        if (isset($_REQUEST['knock-knock'])) {
            $passHash = Sql::password($_REQUEST['login'], $_REQUEST['password']);

            $id_user = Sql::getRow('SELECT * FROM `users` WHERE `user_login`=? AND `user_password`=?', [$_REQUEST['login'], $passHash])['id_user'];
            if (is_numeric($id_user) && $id_user >= 1) {
                $_SESSION['user_id'] = $id_user;
                header("location:index.php?path=user");
            } else {
                $this->statusMessage = 'Нет пользователя с такой комбинацией имени и пароля';

            }
        } else {
            $this->statusMessage = 'Введите имя пользователя и пароль';

        }
//        print_r($data);
//        return ['reg_error' => $reg_error];
    }

    /**
     * @param $data
     * @return array
     */
    public function reg($data)
    {
        $this->title .= ' | Регистрация нового пользователя';
        $reg_error = '';
        /** @var TYPE_NAME $_REQUEST */
        if (isset($_REQUEST['reg'])) {
            if ($_REQUEST['pass1'] == $_REQUEST['pass2'] && !empty($_REQUEST['pass1']) && !empty($_REQUEST['login']) && !empty($_REQUEST['user_name'])) {
                $login = $_REQUEST['login'];
                $answer = Sql::getRows('SELECT * FROM `users` WHERE `user_login`=?', [$login]);
                if (empty($answer)) {
                    $passHash = Sql::password($_REQUEST['login'], $_REQUEST['pass1']);
                    $newUserId = Sql::insert('INSERT INTO `users` (`user_name`,`user_login`,`user_password`) VALUES (?,?,?)', [$_REQUEST['user_name'], $_REQUEST['login'], $passHash]);
                    if ($newUserId > 0) {
                        header("location:index.php?path=user");
                    }
                } else {
                    $this->statusMessage = 'Пользователь с таким логином существует';
//                    return ['reg_error'=> $reg_error];
                }
            } else {
                $this->statusMessage = 'Введенные пароли не совпадают';
//                return ['reg_error'=> $reg_error];
            }
        }
//        return ['message'=> $reg_error];
    }

    public function logout()
    {
        session_destroy();
        header("location:index.php?path=user");
    }

}