<?php
namespace App\Controllers;

use App\Controller;
use App\Request;
use App\Session;

final class HomeController extends Controller {
	function __construct(Request $request, Session $session) {
		parent::__construct($request, $session);
	}
	
	public function index() {
		// obtenir dades
		$data = [];

		$title = "Home";

		$email = $this->session->get('email');
		$passwd = $this->session->get('passwd');
		$user = $this->getUser($email, $passwd);
		if ($user) {
			$username = $user->username;
			$data['username'] = $username;
			$data['email'] = $email;
		}

		$data['title'] = $title;

		// renderitzar vista
		return view('home', $data);
	}

	public function prueba() {
		echo "Prueba - HomeController";
	}

	public function logout() {
		$this->session->set('email', null);
		$this->session->set('passwd', null);
		$this->index();
	}

	
}
?>