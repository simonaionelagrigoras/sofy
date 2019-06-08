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
    protected $repository;

    public function __construct()
    {
        parent::__construct();
        require(ROOT . 'Models/Repository.php');
        require(ROOT . 'Models/UserRepository.php');
        $this->repository = new Repository();
        $this->userRepo   = new UserRepository();

    }

   public  function getList()
    {
        $this->session->loginUser(1, 'test');
        $userId = $this->session->getCurrentUser();
        $response = $this->userRepo->getUserRepositories($userId);
        echo json_encode($response);
    }

    public function getAvailableRepositories()
    {
        $repositoriesList = $this->repository->getMainRepositories();
        echo json_encode($repositoriesList);
    }

    public function getAvailableVersions($params)
    {
        echo json_encode($params);
    }

}