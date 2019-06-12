<?php
/**
 * Created by PhpStorm.
 * User: Grig
 * Date: 12.06.2019
 * Time: 23:01
 */

class helpController extends Controller
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