<?php
namespace App\Controllers;

use App\Controller;
use App\Request;
use App\Session;

final class DashboardController extends Controller {
	function __construct(Request $request, Session $session) {
		parent::__construct($request, $session);
	}
	
	public function index() {
		// obtenir dades
		$data = [];
    
		$title = "Dashboard";
		$data['title'] = $title;

		$email = $this->session->get('email');
		$passwd = $this->session->get('passwd');
    
		$user = $this->getUser($email, $passwd);
    $this->qb->clearQuery();
    if (!$user or !isset($user)) {
			$this->redirect('/auth');
		} else {
      if ($user->userRole == 2) {
		  	$this->redirect('/admin');
      }
    }
    
    $userId = $user->id;
    $username = $user->username;
    
    $data['email'] = $email;
    $data['userId'] = $userId;
    $data['username'] = $username;
    
    $rents = $this->qb
      ->select([
        'BOOK_RENT.initDate',
        'BOOK_RENT.returnDateScheduled','BOOK_RENT.returnDateActual','BOOK_RENT.returnDateExtended',
        'BOOK_RENT.price','BOOK_RENT.statusId',
        'BOOKS.img', 'BOOKS.title'
        ])
      ->from('BOOKS')
      ->appendToQuery(" INNER JOIN BOOK_RENT ON BOOK_RENT.bookId = BOOKS.id ")
      ->where("BOOK_RENT.userId = '$userId'")
      ->exec()->fetch();
    $this->qb->clearQuery();
    if (!isset($rents)) {
      $rents = [];
    }
    
    $this->qb->clearQuery();
    
    $data['rents'] = $rents;
		// renderitzar vista
		return view('dashboard', $data);
	}
}
?>