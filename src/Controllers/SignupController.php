<?php

namespace App\Controllers;

use App\Controller;
use App\Request;
use App\Session;

final class SignupController extends Controller {
	function __construct(Request $request, Session $session) {
		parent::__construct($request, $session);
	}

	public function index() {
		// renderitzar vista
		return view('signup', ['title' => 'Sign up']);
	}

	public function signup() {
		$newUser;

		$username = $this->request->post('username');
		$email = $this->request->post('email');
		$passwd = $this->request->post('passwd');
		$passwdConfirm = $this->request->post('passwd-confirm');
		$userRole = intval($this->request->post('user-role'));
		/*
		$data = [
			'username'=>$username,
			'email'=>$email,
			'passwd'=>$passwd,
			'userRole'=>$userRole
		];
		*/
		
		$alreadyExists = $this->auth($email, $passwd);

		if (!$alreadyExists) {
			if ($passwd == $passwdConfirm) {
				$newUser = $this->signupAction($username, $email, $passwd, $userRole);
				//echo "NEW USER: ".var_dump($newUser)."<br>";
			}
			if ($newUser) {
				$this->session->set('email',$email);
				$this->session->set('passwd',$passwd);
				$this->redirect('/dashboard');
			}
			/*
			var_dump($username);
			var_dump($email);
			var_dump($passwd);
			var_dump($passwdConfirm);
			var_dump($userRole);
			*/
		}
		//var_dump($users);
	}
	private function auth($email, $passwd) {
		$user = $this->getUser($email, $passwd);
		if ($user) {
			// If user already exists, redirect back to the signup page.
			$this->redirect('/signup');
			return true;
		}
		return false;
	}
	private function signupAction($username, $email, $passwd, $userRole) {
		$passH = password_hash($passwd, PASSWORD_BCRYPT, ['cost'=>9]);
		try {
			$this->qb->clearQuery();
			$userMax = $this->qb->
				select(["MAX(id)"])->
				from('USERS')->
				limit(1)->
				exec()->
				fetch()[0]
			;
			$userId = array_values(get_object_vars($userMax))[0] + 1;
			$this->qb->clearQuery();
			$this->qb->insert('USERS', [[$userId, "'$username'", "'$email'", "'$passH'", $userRole, 0.0]])->qry();

			$this->qb->clearQuery();
			return $this->getUser($email, $passwd);
			
		} catch (\Exception $ex) {
			die($ex);
		}
	}
}