<?php
namespace App\Controllers;

use App\Controller;
use App\Container;
use App\Request;
use App\Session;
use App\Model;
use App\Models\Book;
use App\Models\User;

final class CatalogController extends Controller {
	function __construct(Request $request, Session $session) {
		parent::__construct($request, $session);
	}
	
	public function index() {
		// obtenir dades
		$data = [];

		$title = "Catalog";

		$email = $this->session->get('email');
		$passwd = $this->session->get('passwd');
		$user = $this->getUser($email, $passwd);
    $this->qb->clearQuery();
		if ($user) {
			$username = $user->username;
			$data['username'] = $username;
			$data['email'] = $email;
		} else {
      $this->redirect('/auth');
    }
    
    $cataleg = $this->qb->select(['*'])->from('BOOKS')->exec()->fetch();
    $this->qb->clearQuery();
    
    $data['title'] = $title;
    $data['cataleg'] = $cataleg;

    
    $llibres= $this->qb->select(['BOOKS__AUTHORS.bookId','BOOKS__AUTHORS.authorId','AUTHORS.fullname'])
      ->appendToQuery(" FROM (")
      ->appendToQuery("(BOOKS__AUTHORS INNER JOIN BOOKS ON BOOKS__AUTHORS.bookId = BOOKS.id)")
      ->appendToQuery(" INNER JOIN AUTHORS ON BOOKS__AUTHORS.authorId = AUTHORS.id")
      ->appendToQuery(")")
      ->exec()->fetch()
    ;
    $data['llibres'] = $llibres;
    $this->qb->clearQuery();

    $books__authors = [];
    $books__authors_view = [];
    foreach ($llibres as $llibr) {
      $bId = $llibr->bookId;
      $aName = $llibr->fullname;
      if (isset($books__authors[$bId])) {
        $books__authors[$bId][] = $aName;
      } else {
        $books__authors[$bId] = [$aName];
      }
    }
    foreach ($books__authors as $bId => $aNameArr) {
      $books__authors_view[$bId] = implode(", ", $aNameArr);
    }

    $data['books__authors_view'] = $books__authors_view;
		// renderitzar vista
		return view('catalog',$data);
	}

  public function reserva(){
    $data = [];
    $data['title'] = "Reservar ebook";
    
		$email = $this->session->get('email');
		$passwd = $this->session->get('passwd');
    $user = $this->getUser($email, $passwd);
    $this->qb->clearQuery();
		if ($user) {
			$username = $user->username;
			$data['username'] = $username;
			$data['email'] = $email;
		} else {
      $this->redirect('/dashboard');
    }
    
    $bookId = $this->request->getParams();
    //var_dump($bookId);
    $llibre=(new Book())->find(['id'=>$bookId])[0];
    $data['llibre'] = $llibre;
    
    return view('reserva',$data);
  }

	public function logout() {
		$this->session->set('email', null);
		$this->session->set('passwd', null);
		$this->index();
	}
}
?>