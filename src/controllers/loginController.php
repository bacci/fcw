<?php

namespace Fcw\Controllers;

class LoginController extends Controller
{

	public function teste()
	{
		return $this->app->response->withRedirect('/login');
	}
	
	public function index()
	{
		
		if($_GET["logar"]) {
			$this->login(["app_username" => "giancarlo.bacci", "app_password" => "teste"]);
		}
		
		if($this->checkLogin()) {
			echo "Logado";
		} else {
			echo "Nao logado";
		}
		
		$data = [
			"page_name" => "Login",
			"page_title" => "Login"
		];
		
		return $this->app->view->render($this->app->response, 'login.phtml', $data);
	}
	
	public function logout()
	{
		$this->logoff();
		
		return $this->app->response->withRedirect("/login");
	}
	
	public function login($data) {
		
		if($this->validateUser($data["app_username"], $data["app_password"])) {
			$_SESSION["app_username"] = $data["app_username"];
			$_SESSION["app_password"] = md5($data["app_password"]);
			
			
			if (isset($data['remember_me'])) {
				//Add additional member to cookie array as per requirement
				setcookie("app_username", $_SESSION['app_username'], time() + 60 * 60 * 24 * 100, "/");
				setcookie("app_password", $_SESSION['app_password'], time() + 60 * 60 * 24 * 100, "/");
				return;
			}
		}
	}
	
	public function logoff()
	{
		unset($_SESSION['app_username']);
		unset($_SESSION['app_password']);
		
		session_unset();
		session_destroy();
		
		setcookie ("app_username", "",time()-60*60*24*100, "/");
		setcookie ("app_password", "",time()-60*60*24*100, "/");
	}
	
	public function validateUser($usr, $pass)
	{
		$user = [
			"id" => 1,
			"name" => "giancarlo.bacci"
		];
		$player = [
			"firstname" => "Giancarlo",
			"lastname" => "Bacci",
		];
		
		$data = [
			"page_name" => "Login",
			"page_title" => "Login",
			"user" => $user,
			"player" => $player
		];
		
		return ["app_username" => $usr, "app_password" => $pass, "data" => $data];
	}
	
	public function checkLogin()
	{
		if(isset($_SESSION['app_username']) AND isset($_SESSION['app_password']))
			return true;
		elseif(isset($_COOKIE['app_username']) && isset($_COOKIE['app_password']))
		{
			$cookie_user = $this->validateUser($_COOKIE['app_username'],$_COOKIE['app_password']);
			
			if($cookie_user)
			{
				$this->login($cookie_user);
				return true;
			}
			else
			{
				$this->logoff();
				return false;
			}
		}
		else
			return false;
	}
}