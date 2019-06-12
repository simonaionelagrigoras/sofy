<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 20:23
 */

class accountController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->getCurrentUser()){
            header('Location: /user/login');
        }
    }

    function index()
    {
        $this->render("index");
    }

    function repositories()
    {
        $this->render("repositories");
    }

    function settings()
    {
        $this->render("settings");
    }

    function messages()
    {
        $this->render("messages");
    }

    function logout()
    {
        $this->session->logoutUser();
        header("Location: " . WEBROOT);
    }

}