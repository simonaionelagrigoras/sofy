<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 18:34
 */

class userController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->render("login");
    }

    function login()
    {
        $this->render("login");
    }
}