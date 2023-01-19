<?php
namespace App;

use App\Container;
use App\Controller;
use App\Database\DB;
use App\Request;
use App\Session;

abstract class Controller {
	protected Request $request;
	protected Session $session;
	protected DB $qb;

	function __construct(Request $request, Session $session) {
		$this->request = $request;
		$this->session = $session;
		$this->qb = Container::get('database');
	}

	public function index() {
		$email = $this->request->post('email');
		$passwd = $this->request->post('passwd');

		return view('home', compact('USERS'));
	}

	public function redirect(string $url) {
		header('Location:' . $url);
	}
	
	public function error() {
		echo "Error";
		//return view('error',['error'=>$request->session()->get('key', 'default');])
	}

	public function getUser( $email, $passwd) {
		if (!(isset($email) && isset($passwd))) {
			return false;
		}
		$user = $this->qb->
			select(['*'])->
			from('USERS')->
			where("email = '$email'")->
			limit(1)->
			exec()->
			fetch()[0]
		?? false;

		if ($user) {
			$passVerified = password_verify($passwd, $user->passwd);
			if ($passVerified) {
				return $user;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}