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
                $this->session->loginUser($userId, $username);

				// Redirect user to account page
				header("Location:" . WEBROOT . "account/index");
			}
		}else{
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
}