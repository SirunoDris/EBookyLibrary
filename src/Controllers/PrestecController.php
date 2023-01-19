<?php
namespace App\Controllers;

use App\Controller;
use App\Container;
use App\Request;
use App\Session;
use App\Model;
use App\Models\Book;
use App\Models\User;

final class ReservaController extends Controller {
	function __construct(Request $request, Session $session) {
		parent::__construct($request, $session);
	}
	
	public function index() {
		// obtenir dades
		$data = [];

		$title = "Prestec";

		$email = $this->session->get('email');
		$passwd = $this->session->get('passwd');
		$user = $this->getUser($email, $passwd);
		if ($user) {
			$username = $user->username;
			$data['username'] = $username;
			$data['email'] = $email;
		}

		$data['title'] = $title;
    $cataleg = $this->qb->select(['*'])->from('BOOKS')->exec()->fetch();

		// renderitzar vista
		return view('prestec');
	}

   function prestec(){
      //crear prèstec
       $id=$this->request->getParams();
       $llibre=new Llibre();
       $book=$llibre->find(['id'=>$id])[0];  
      $data=(array)$book;
      $llibre->setData($data);
      $prestec=new Prestec($this->user, $llibre);
      $prestec->save();
    }

	public function logout() {
		$this->session->set('email', null);
		$this->session->set('passwd', null);
		$this->index();
	}

	
}
?>