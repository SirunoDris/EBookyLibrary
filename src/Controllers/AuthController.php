<?php

namespace App\Controllers;

use App\Container;
use App\Controller;
use App\Request;
use App\Session;

final class AuthController extends Controller {
	function __construct(Request $request, Session $session) {
		parent::__construct($request, $session);
	}

	public function index() {
		$email = $this->session->get('email');
		$passwd = $this->session->get('passwd');
		if (
			isset($email) && isset($passwd)
		) {
			$this->redirect('/dashboard');
		}
		// renderitzar vista
		return view('auth', ['title' => 'Log in']);
	}
	public function signin() {
		$email = $this->request->post('email');
		$passwd = $this->request->post('passwd');

		$this->auth($email, $passwd);
		//var_dump($users);
	}

	// Redirigeix al dashboard de l'usuari o a auth un altre cop.
	private function auth(string $email, string $passwd) {
		$user = $this->getUser($email, $passwd);

		if ($user) {
			$this->session->set('email',$email);
			$this->session->set('passwd',$passwd);
			$this->redirect('/catalog');
		} else {
			$this->session->set('error',"Session failed");
			$this->redirect('/auth');
		}
	}
}