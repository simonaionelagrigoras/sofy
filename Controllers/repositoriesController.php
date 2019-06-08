<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 21:12
 */

class repositoriesController extends Controller
{
    protected $userRepo;

    public function __construct()
    {
        parent::__construct();
        require(ROOT . 'Models/UserRepository.php');
        $this->userRepo   = new UserRepository();
        header("Content-Type: application/json; charset=UTF-8");
    }

    function getList()
    {
        $this->session->loginUser(1, 'test');
        $userId = $this->session->getCurrentUser();
        $response = $this->userRepo->getUserRepositories($userId);
        echo json_encode($response);
    }

}