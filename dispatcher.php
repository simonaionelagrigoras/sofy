<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 18:07
 */

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        try{
            $this->request = new Request();
            Router::parse($this->request->url, $this->request);

            $controller = $this->loadController();

            call_user_func_array([$controller, $this->request->action], $this->request->params);
        }catch (Exception $e){
            return $e->getMessage();
        }

    }

    public function loadController()
    {
        $name = $this->request->controller . "Controller";
        $file = ROOT . 'Controllers/' . $name . '.php';
        require($file);
        $controller = new $name();
        return $controller;
    }

}
