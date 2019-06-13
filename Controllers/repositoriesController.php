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
        if(!$this->session->getCurrentUser()){
            header('Location: /user/login');
        }

        require(ROOT . 'Models/Repository.php');
        require(ROOT . 'Models/UserRepository.php');
        $this->repository = new Repository();
        $this->userRepo   = new UserRepository();

    }
    public function listAll()
    {
        $this->render("list");
    }

    public function render($filename, $data = null)
    {
        $controllerName = str_replace('Controller', '', get_class($this));
        $containerClass = $this->getContainerClass($controllerName);

        $baseUrl    = isset($_SERVER['HTTPS']) ? 'https://' . $_SERVER['HTTP_HOST'] : 'http://' . $_SERVER['HTTP_HOST'];
        $isLoggedIn = is_null($this->session->getCurrentUser()) ? false : true;
        $userName   = $this->session->getCurrentUserName();
        $email      = $this->session->getCurrentUserEmail();

        $respositories = $this->userRepo->getAll($this->session->getCurrentUser());

        $viewDir = ucfirst($controllerName);
        $listData = $data;
        $baseRepoPath =  ROOT . 'repo/';

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

    public  function getList()
    {
        $userId = $this->session->getCurrentUser();
        $response = $this->userRepo->getUserRepositories($userId);
        echo json_encode($response);
    }

    public function edit($params)
    {
        if(isset($params['id'])){
            $repoID = $params['id'];
            $repoData = $this->userRepo->getUserRepoDataById($repoID);
            $this->render('edit', $repoData);
        }
    }

    public function save($params)
    {
        if(isset($params['id'])) {
            $resource = null;
            $size     = null;
            $repoId   = $params['id'];
            if(isset($_FILES['resource']) && ($_FILES['resource']['size'] !=0)){

                $repo = $params['repo_name'];
                $repoVersion = $params['repo_version'];
                $currentResource = $params['current_resource'];
                $currentResourcePaths = explode('/', $currentResource);
                if(isset($currentResourcePaths[0]) && file_exists( ROOT . 'repo/' . $repo . '/' . $repoVersion . '/' . $currentResourcePaths[0])){
                    $app = $currentResourcePaths[0];
                    $resource = $app . '/x86_64/Packages/' . $_FILES['resource']['name'];
                    $size     = $_FILES['resource']['size'] / (1024*1024);
                }else{
                    $this->session->setErrorMessage('Something is wrong with the repository resource. Please contact our administrators');
                    header("Location:" . WEBROOT . "repositories/listAll");
                    return;
                }
            }

            if(!is_null($resource)){
                $fileUploaded = $this->uploadFile($repo, $repoVersion, $app);
                if(!isset($fileUploaded['success'])){
                    $this->session->setErrorMessage('An error occured when uploading the file. Please try again later');
                    header("Location:" . WEBROOT . "repositories/listAll");
                    return;
                }else{
                    unlink(ROOT . 'repo/' . $repo . '/' . $repoVersion . '/' . $currentResource);
                }
            }

            $tags = isset($params['tags']) && strlen(trim($params['tags'])) ? explode(',', $params['tags']) : null;

            $parsedTags   = !is_null($tags) ? json_encode($tags) : null;
            $description  = isset($params['description']) ? $params['description'] : null;
            $version      = isset($params['version']) ? $params['version'] : null;
            $officialSite = isset($params['official_site']) ? $params['official_site'] : null;
            $result = $this->userRepo->update($repoId, $resource, $size, $parsedTags, $description, $version, $officialSite);
            if($result){
                $this->session->setSuccessMessage('Repository updated');
                header("Location:" . WEBROOT . "account/settings");
            }else{
                $this->session->setErrorMessage('An error occurred. The repository has not been updated. Please try again later.');

            }
            header("Location:" . WEBROOT . "repositories/listAll");
        }
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
        }else{

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
        if(!in_array($fileType,['txt','md','zip', 'gzip', 'tgz', 'rpm', 'drpm'])) {
            echo json_encode(['error' => 'Invalid file format']);
            return;
        }
        move_uploaded_file( $_FILES['file']['tmp_name'], $target_file);
        $result = ['file_uploaded' => $params['repository_app'] . '/x86_64/Packages/' .  basename($_FILES["file"]["name"])];
        echo json_encode($result);
    }

    protected function uploadFile($repo, $repoVersion, $app)
    {
        $target_dir =  ROOT . 'repo/' . $repo . '/' . $repoVersion . '/' . $app . '/x86_64/Packages';

        if(!file_exists($target_dir)){
            return ['error' => 'Invalid Repository'];
        }
        $target_file = $target_dir  . '/' . basename($_FILES["resource"]["name"]);
        $fileType    = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(!in_array($fileType,['txt','md','zip', 'gzip', 'tgz', 'rpm', 'drpm'])) {
            return ['error' => 'Invalid file format'];

        }
        $upload = move_uploaded_file( $_FILES['resource']['tmp_name'], $target_file);
        return $upload ? ['success' =>true] : ['error'=>'Could not Upload File'];
    }

    public function createRepo($params)
    {
        if(isset($params['repository_id'])) {
            $repoId =  $params['repository_id'];
        }else{
            echo json_encode(['error' => 'Invalid Repository'], JSON_PRETTY_PRINT);
            return;
        }
        $repo     = $this->repository->getRepoById($repoId);
        $repoFile =  ROOT . 'repo/' . $repo->repo_name . '/' . $repo->version . '/' .  $params['repository_file'];
        $size     = filesize($repoFile) / (1024*1024); //filsize in MB
        $userId   = $this->session->getCurrentUser();

        $tags         = isset($params['repository_tags']) && strlen(trim($params['repository_tags'])) ? explode(',', trim($params['repository_tags'])) : null;
        $parsedTags   = !is_null($tags) ? json_encode($tags) : null;
        $description  = isset($params['description']) ? $params['description'] : null;
        $version      = isset($params['version']) ? $params['version'] : null;
        $officialSite = isset($params['official_site']) ? $params['official_site'] : null;
        $this->userRepo->create($userId, $repoId, $params['repository_file'], $size, json_encode($parsedTags), $description, $version, $officialSite);
        $result = ['success' => true, 'message' => "Application repository successfully created"];
        echo json_encode($result);
    }

    public function searchResult($params)
    {
        if(isset($params['search_key']) && strlen(trim($params['search_key']))) {
            $searchKey =  $params['search_key'];
            $userId = $this->session->getCurrentUser();
            $result = $this->userRepo->getSearchResults($userId, $searchKey);
            echo json_encode($result);
        }else{
            echo json_encode(['error' => 'Please enter a search key']);
        }

    }


    public function deleteRepository($params)
    {
        if(isset($params['repository_id'])) {
            $userId = $this->session->getCurrentUser();
            if(!$userId){
                header('Location: /user/login');
            }
            $result = $this->userRepo->getUserRepositoryById($params['repository_id']);
            if(!$result){
                echo json_encode(['error' => 'Repository not found']);
            }else{
                $repoFile =  ROOT . 'repo/' . $result['name'] . '/' . $result['version'] . '/' .  $result['resource'];
                if(file_exists($repoFile)){
                    $deleted = $this->userRepo->delete($userId, $params['repository_id']);
                    if($deleted){
                        unlink($repoFile);
                        echo json_encode(['success' => true, 'message' => "Repo deleted"]);
                    }
                    else {
                        echo json_encode(['success' => false, 'message' => "An error occurred"]);
                    }
                }else{
                    echo json_encode(['success' => false, 'message' => "Repo file doesn't exist"]);
                }
            }
            
        }
    }

    public function getRepoById($params)
    {
        if(isset($params['repository_id'])) {
            $repoId =  $params['repository_id'];
        }else{
            echo json_encode(['error' => 'Invalid Repository'], JSON_PRETTY_PRINT);
            return;
        }
        $result = $this->repository->getRepoById($repoId);
        $repoFile =  ROOT . 'repo/' . $result->repo_name . '/' . $result->version . '/' ;
        echo json_encode($repoFile);
    }
}
