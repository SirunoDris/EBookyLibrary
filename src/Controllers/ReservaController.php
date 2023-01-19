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
		$this->redirect('/catalog');
	}

	public function logout() {
		$this->session->set('email', null);
		$this->session->set('passwd', null);
		$this->index();
	}

	public function confirm() {
    $email = $this->session->get('email');
		$passwd = $this->session->get('passwd');
		$user = $this->getUser($email, $passwd);
    $this->qb->clearQuery();
    $userId;
		if ($user) {
			$userId = $user->id;
		} else {
      $this->redirect('/home');
    }
    
    $bookId = $this->request->getParams();
    if (!isset($bookId) || strlen($bookId) == 0) {
      $this->redirect('/catalog');
    }
		//echo "Rent confirmed!" ."<br>";
		//echo "Book ID: ".$bookId ."<br>";
		//echo "User ID: ".$userId ."<br>";
    
    /*
      userId INT(11) not null,
    	bookId INT(11) not null,
    title
    	initDate DATETIME not null DEFAULT NOW(),
    	returnDateScheduled DATETIME,
    	returnDateActual DATETIME,
    	returnDateExtended DATETIME,
    	price DECIMAL(6,2) not null DEFAULT 0.0,
    	statusId INT(5) not null DEFAULT 0,
  img
    */
    $this->qb->insert('BOOK_RENT', [[$userId, $bookId, "'duplTitle'", 'NOW()', 'DATE_ADD(NOW(), INTERVAL 20 DAY)', 'NULL', 'NULL', 0.0, 0, "'duplImgPath'"]])->qry();
    $this->qb->clearQuery();
    //var_dump($this->qb);
    $this->redirect('/dashboard');
	}
  public function cancel() {
    $this->redirect('/catalog');
	}
}
?>