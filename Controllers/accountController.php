<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 20:23
 */

class accountController extends Controller
{
    protected $userRepo;

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->getCurrentUser()){
            header('Location: /user/login');
        }
        require(ROOT . 'Models/UserRepository.php');
        $this->userRepo   = new UserRepository();

        if(!isset($_SESSION['total_size'])){
            $userId = $this->session->getCurrentUser();
            $size = $this->userRepo->getTotalSizeForUSer($userId);
            $this->session->setTotalSize($size);
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