<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 20:23
 */

class accountController extends Controller
{
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
}