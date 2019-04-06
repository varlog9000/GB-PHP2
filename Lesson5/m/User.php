<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 05.04.2019
 * Time: 16:01
 */

class User
{
    protected $loginStatus;
    protected $userName;
    protected $userId;
    protected $logDepth = 5; // Глубина лога

    public function __construct()
    {
        $this->setLoginStatus(isset($_SESSION['loginStatus']) ? $_SESSION['loginStatus'] : null);
        $this->setUserName(isset($_SESSION['userName']) ? $_SESSION['userName'] : null);
        $this->setUserId(isset($_SESSION['userId']) ? $_SESSION['userId'] : null);
    }

    public function getLoginStatus()
    {
        return $this->loginStatus;
    }

    /**
     * @return int
     */
    public function getLogDepth()
    {
        return $this->logDepth;
    }

    public function setLoginStatus($status)
    {
        $this->loginStatus = $status;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function login($username, $password)
    {
        if ($username == "" && $password == "") {
            return false;
        } else {
            $users = include __DIR__ . '/../data/users.php';
            foreach ($users as $user) {
                if ($user['username'] == $username && $user['password'] == $password) {
                    $this->setLoginStatus(true);
                    $this->setUserName($username);
                    $this->setUserId($user['id']);
                    $_SESSION['loginStatus'] = $this->getLoginStatus();
                    $_SESSION['userName'] = $this->getUserName();
                    $_SESSION['userId'] = $this->getUserId();
                    $_SESSION['userLog'] = [];
                    return true;
                }
            }
            return false;
        }
    }

    public function log($title)
    {
//        $depth = $this->getLogDepth();
        if (count($_SESSION['userLog']) >= 5) {
            array_shift($_SESSION['userLog']);
        }

        $_SESSION['userLog'][] = ['link' => $_SERVER['REQUEST_URI'], 'title' => $title];
    }

    public function getLog()
    {

    }

    public function logout()
    {
//        $this->setUserId(null);
//        $this->setUserName(null);
//        $this->setLoginStatus(false);
        session_destroy();
    }

}