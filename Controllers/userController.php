<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 18:34
 */

class userController extends Controller
{
    protected $user;
    protected $helper;
    protected $session;

    public function __construct()
    {
        parent::__construct();
		require(ROOT . 'Models/User.php');
		require(ROOT . 'Helpers/UserHelper.php');
		$this->user    = new User();
		$this->helper  = new UserHelper();
    }

    function index()
    {
        if($this->session->getCurrentUser()){
            header('Location: /account/index');
        }
        $this->render("login");
    }

    function login()
    {
        $this->render("login");
    }

	function loginPost($email = null, $password = null)
	{
		$email    = isset($_POST['email'])    ? $_POST['email']    : $email;
		$password = isset($_POST['password']) ? $_POST['password'] : $password;
		if(!empty($email) && !empty($password))
		{
			$dbPass = $this->user->getFieldByEmail($email, 'password');
			if(password_verify($password, $dbPass)){
				// Password is correct, so start a new session
				$userId   = $this->user->getFieldByEmail($email, 'entity_id');
				$username = $this->user->getFieldByEmail($email, 'name');
                $this->session->loginUser($userId, $username, $email);

				// Redirect user to account page
				header("Location:" . WEBROOT . "account/index");
			}
		}else{
            $this->session->setErrorMessage('Invalid email or password');
			header("Location:" . WEBROOT . "user/login");
		}
	}

	function create()
	{
		$validation = $this->helper->validateRegistrationData($_POST);

		if (!isset($validation['error']))
		{
			$password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
			if ($this->user->create($_POST["name"], $_POST["email"], $password))
			{
				$this->loginPost($_POST["email"], trim($_POST['password']));
			}
		}

		$this->render("login");
	}

	public function logoutUser()
	{
		session_destroy();
	}

    public function changeAccountDetails($params)
    {
        $userId = $this->session->getCurrentUser();
        if(!$userId){
            header("Location:" . WEBROOT . "user/login");
        }

        $name     = isset($_POST['name'])     ? $_POST['name']    : null;
        $email    = isset($_POST['email'])    ? $_POST['email']    : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        if((!empty($email) || !empty($name)) && !empty($password))
        {
            $dbPass = $this->user->getFieldByEmail($email, 'password');
            if(password_verify($password, $dbPass)){
                $this->user->update($userId, $name, $email);
                $this->session->setCurrentUserName($name);
                $this->session->setCurrentUserEmail($email);
                // Redirect user to account page
                $this->session->setSuccessMessage('You have successfully changed your account data');
                header("Location:" . WEBROOT . "account/settings");
            }else{
                $this->session->setErrorMessage('Wrong Password');
                header("Location:" . WEBROOT . "account/settings");
            }
        }else{
            $this->session->setErrorMessage('Invalid data');
            header("Location:" . WEBROOT . "account/settings");
        }
    }

    public function changePassword($params)
    {
        $userId = $this->session->getCurrentUser();
        if(!$userId){
            header("Location:" . WEBROOT . "user/login");
        }

        $password = isset($_POST['password']) ? $_POST['password'] : null;
        $newPassword = isset($_POST['password_change']) ? $_POST['password_change'] : null;
        if(!empty($password) && !empty($newPassword))
        {
            $dbPass = $this->user->getFieldById($userId, 'password');
            if(password_verify($password, $dbPass)){
                $newPassword = password_hash(trim($newPassword), PASSWORD_DEFAULT);
                $this->user->updatePassword($userId, $newPassword);

                // Redirect user to settings page
                $this->session->setSuccessMessage('You have successfully changed your password');
                header("Location:" . WEBROOT . "account/settings");
            }else{
                $this->session->setErrorMessage('Wrong Password');
                header("Location:" . WEBROOT . "account/settings");
            }
        }else{
            $this->session->setErrorMessage('Invalid data');
            header("Location:" . WEBROOT . "account/settings");
        }
    }
}