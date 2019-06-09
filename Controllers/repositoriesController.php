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

    public function getAvailableVersions($params = [])
    {
        $versions = [];
        if(isset($params['repository_name'])){
            $versions = $this->repository->getVersions($params['repository_name']);
        }

        echo json_encode($versions);
    }

    public function getAvailableApps($params = [])
    {
        $availableApps = [];
        if(isset($params['repository_version'])){
            $repo = isset($params['repository_name']) ? $params['repository_name'] : $this->repository->getRepoByVersion($params['repository_version']);
            $repoSource = ROOT . 'repo/' . $repo . '/' . $params['repository_version'];
            $availableApps = scandir($repoSource);
            $availableApps = array_diff($availableApps, ['.', '..']);

        }

        echo json_encode($availableApps);
    }

    public function chooseApp($params)
    {
        if(isset($params['repository_version'])) {
            $repo = isset($params['repository_name']) ? $params['repository_name'] : $this->repository->getRepoByVersion($params['repository_version']);
        }else{
            echo json_encode(['error' => 'Invalid Repository'], JSON_PRETTY_PRINT);
            return;
        }
        $app = isset($params['repository_app']) ? $params['repository_app'] : null;
        if(empty($app)){
            if(isset($params['new_app'])){
                $repoSource = ROOT . 'repo/' . $repo . '/' . $params['repository_version'] . '/' . $params['new_app'];
                if (!file_exists($repoSource)) {
                    mkdir($repoSource . '/x86_64/Packages', 0777, true);
                    echo json_encode(['success' => 'Got to next step', 'new_app' => $params['new_app']], JSON_PRETTY_PRINT);
                    return;
                }
            }else{
                echo json_encode(['error' => 'Invalid Application'], JSON_PRETTY_PRINT);
                return;
            }
        }else{
            echo json_encode(['success' => 'Got to next step'], JSON_PRETTY_PRINT);
            return;
        }
    }

    public function uploadApp(){

    }

}