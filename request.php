<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 18:08
 */

class Request
{
    public $url;
    public $action;
    public $controller;
    public $params;

    public function __construct()
    {
        $this->url = $_SERVER["REQUEST_URI"];
    }
}