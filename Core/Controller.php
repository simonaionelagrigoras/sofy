<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 18:10
 */

class Controller
{
    var $vars = [];
    var $layout = "default";

    public function __construct()
    {
    }

    public function setData($key, $value)
    {
        $this->vars[$key] = $value;
    }

    public function render($filename)
    {
        extract($this->vars);
        $controllerName = str_replace('Controller', '', get_class($this));
        $containerClass = $this->getContainerClass($controllerName);
        $baseUrl        = isset($_SERVER['HTTPS']) ? 'https://' . $_SERVER['HTTP_HOST'] : 'http://' . $_SERVER['HTTP_HOST'];

        ob_start();
        require(ROOT . "Views/" . ucfirst($controllerName) . '/' . $filename . '.php');
        $content_for_layout = ob_get_clean();

        if ($this->layout == false)
        {
            $content_for_layout;
        }
        else
        {
            require(ROOT . "Views/Layouts/" . $this->layout . '.php');
        }
    }

    protected function getContainerClass($controllerName)
    {
        if(empty($controllerName))
        {
            return '';
        }
        switch($controllerName){
            case 'about':
                $class = 'about-us';
                break;
            default:
                $class = $controllerName;
        }

        return $class;
    }

}
