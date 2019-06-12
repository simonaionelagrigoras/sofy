<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 18:10
 */

class Controller
{
    protected $session;
    protected $success;
    protected $error;
    var $vars = [];
    var $layout = "default";

    public function __construct()
    {
        require(ROOT . 'Models/Session.php');
        $this->session = new Session();
        $this->success = '';
        $this->error  = '';
    }


    public function setData($key, $value)
    {
        $this->vars[$key] = $value;
    }

    public function setSuccessMessage($message){
        $this->success = $message;
    }

    public function setErrorMessage($message){
        $this->error = $message;
    }

    public function render($filename, $default = false)
    {
        extract($this->vars);
        $controllerName = str_replace('Controller', '', get_class($this));
        $containerClass = $this->getContainerClass($controllerName);

        $baseUrl    = isset($_SERVER['HTTPS']) ? 'https://' . $_SERVER['HTTP_HOST'] : 'http://' . $_SERVER['HTTP_HOST'];
        $isLoggedIn = is_null($this->session->getCurrentUser()) ? false : true;
        $userName   = $this->session->getCurrentUserName();
        $accMenu    = $controllerName == 'account' ? $this->getMenuSelected($filename) : '';
        $userName = $this->session->getCurrentUserName();
        $email    = $this->session->getCurrentUserEmail();

        $viewDir = $default ? 'Default' : ucfirst($controllerName);

        ob_start();
        require(ROOT . "Views/" . $viewDir . '/' . $filename . '.php');
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

    public function notFound()
    {
        $this->render('not-found', true);
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

    protected function getMenuSelected($action)
    {
        switch($action){
            case 'index':
                $currentMenuOption = 'profile';
                break;
            case 'repositories':
            case 'settings':
            case 'messages':
                $currentMenuOption = $action;
                break;
            default:
                $currentMenuOption = 'profile';
        }

        return $currentMenuOption;
    }

}
