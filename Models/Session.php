<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 15:52
 */

class Session{

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function loginUser($userId, $userName)
    {
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id']   = $userId;
        $_SESSION['user_name'] = $userName;
    }

    public function logoutUser()
    {
        session_destroy();
    }

    public function getCurrentUser()
    {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }

    public function getCurrentUserName()
    {
        return isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
    }

}