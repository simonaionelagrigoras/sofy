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
            if (!file_exists($repoSource)) {
                mkdir($repoSource, 0777, true);
            }
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
        $repoId = $this->repository->getRepoIdByVersion($params['repository_version']);
        if(empty($app)){
            if(isset($params['new_app'])){
                $repoSource = ROOT . 'repo/' . $repo . '/' . $params['repository_version'] . '/' . $params['new_app'];
                if (!file_exists($repoSource)) {
                    mkdir($repoSource . '/x86_64/Packages', 0777, true);
                    echo json_encode(['success' => 'Got to next step', 'new_app' => $params['new_app'], 'repository_id' => $repoId], JSON_PRETTY_PRINT);
                    return;
                }
            }else{
                echo json_encode(['error' => 'Invalid Application'], JSON_PRETTY_PRINT);
                return;
            }
        }else{
            echo json_encode(['success' => 'Got to next step', 'repository_id' => $repoId], JSON_PRETTY_PRINT);
            return;
        }
    }

    public function uploadApp($params){
        ini_set('display_errors',1);
        error_reporting(E_ALL);
        if(isset($params['repository_version'])) {
            $repo = isset($params['repository_name']) ? $params['repository_name'] : $this->repository->getRepoByVersion($params['repository_version']);
        }else{
            echo json_encode(['error' => 'Invalid Repository'], JSON_PRETTY_PRINT);
            return;
        }

        $target_dir =  ROOT . 'repo/' . $repo . '/' . $params['repository_version'] . '/' . $params['repository_app'] . '/x86_64/Packages';

        if(!file_exists($target_dir)){
            echo json_encode(['error' => 'Invalid Repository']);
            return;
        }
        $target_file = $target_dir  . '/' . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(!in_array($fileType,['txt','md','zip', 'gzip', 'tgz', 'rpm'])) {
            echo json_encode(['error' => 'Invalid file format']);
            return;
        }
        move_uploaded_file( $_FILES['file']['tmp_name'], $target_file);
        $result = ['file_uploaded' => $params['repository_app'] . '/x86_64/Packages' .  basename($_FILES["file"]["name"])];
        echo json_encode($result);
    }

    public function createRepo($params)
    {
        if(isset($params['repository_id'])) {
            $repoId =  $params['repository_id'];
        }else{
            echo json_encode(['error' => 'Invalid Repository'], JSON_PRETTY_PRINT);
            return;
        }

        $userId = $this->session->getCurrentUser();
        $tags = isset($params['repository_tags']) && strlen(trim($params['repository_tags'])) ? explode(',', trim($params['repository_tags'])) : null;
        $parsedTags = !is_null($tags) ? json_encode($tags) : null;
        $this->userRepo->create($userId, $repoId, $params['repository_file'], 34, json_encode($parsedTags));
        $result = ['success' => true, 'message' => "Application repository successfully created"];
        echo json_encode($result);
    }
}