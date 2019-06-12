<?php
/**
 * Created by PhpStorm.
 * User: Grig
 * Date: 11.06.2019
 * Time: 22:33
 */

class termsController extends Controller
{
    protected $user;
    protected $helper;
    protected $session;

    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->render("index");
    }
}