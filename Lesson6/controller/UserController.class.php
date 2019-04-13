<?php

class UserController extends Controller
{
    public $view = 'user';
    public $link;
    public $userAuth;
    public $statusMessage;

    public function __construct()
    {
        parent::__construct();
        $this->title .= ' | Личный кабинет';
        $this->userAuth = new UserAuth();
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
            $id_user = $this->userAuth->userAuthorisation();
            if (is_numeric($id_user) && $id_user >= 1) {
                $_SESSION['user_id'] = $id_user;
                $this->cart->transferGoodsFromSessionToDb();
                header("location:index.php?path=user");
            } else {
                $this->statusMessage = 'Нет пользователя с такой комбинацией имени и пароля';
            }
        } else {
            return false;
        }
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
                if (empty($this->userAuth->is_exist_user($_REQUEST['login']))) {
                    $newUserId = $this->userAuth->createUser();
                    if ($newUserId > 0) {
                        header("location:index.php?path=user");
                    }
                } else {
                    $this->statusMessage = 'Пользователь с таким логином существует';
//                    return ['reg_error'=> $reg_error];
                }
            } else {
                $this->statusMessage = 'Заполните все поля: имя, логин, пароль';
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