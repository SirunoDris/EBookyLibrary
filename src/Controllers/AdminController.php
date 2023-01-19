<?php
namespace App\Controllers;

use App\Controller;
use App\Container;
use App\Request;
use App\Session;
use App\Model;
use App\Models\Book;
use App\Models\User;
use App\Models\BookRent;

final class AdminController extends Controller {
	function __construct(Request $request, Session $session) {
		parent::__construct($request, $session);
	}
	
	public function index() {
		// obtenir dades
		$data = [];

		$title = "Admin";
		$data['title'] = $title;

		$email = $this->session->get('email');
		$passwd = $this->session->get('passwd');
		$user = $this->getUser($email, $passwd);
    $this->qb->clearQuery();
    
		if ($user) {
			$username = $user->username;
			$data['username'] = $username;
			$data['email'] = $email;
      if ($user->userRole <> 2) {
		  	$this->redirect('/dashboard');
      }
		} else {
			$this->redirect('/auth');
    }

    $lastQuery_rowCount = $this->session->get('admin_lastQuery_rowCount') ?? false;
    if ($lastQuery_rowCount) {
      $data['lastQuery_results'] = $lastQuery_rowCount . " rows affected.";
    }
		$this->session->set('admin_lastQuery_rowCount', null);
    
    $cataleg = $this->qb->select(['*'])->from('BOOKS')->exec()->fetch();
    $this->qb->clearQuery();
    
    $users = $this->qb->select(['*'])->from('USERS')->exec()->fetch();
    $this->qb->clearQuery();
    
    $rent = $this->qb
      ->select([
        'BOOK_RENT.initDate',
        'BOOK_RENT.returnDateScheduled','BOOK_RENT.returnDateActual','BOOK_RENT.returnDateExtended',
        'BOOK_RENT.price','BOOK_RENT.statusId','BOOK_RENT.bookId','BOOK_RENT.userId',
        'BOOKS.img', 'BOOKS.title', 'USERS.username', 'BOOK_RENT_STATUSCODES.codeName'
        ])
      ->from("(((".
             "BOOK_RENT INNER JOIN BOOK_RENT_STATUSCODES ON BOOK_RENT.statusId = BOOK_RENT_STATUSCODES.id) ".
             "INNER JOIN BOOKS ON BOOK_RENT.bookId = BOOKS.id) ".
             "INNER JOIN USERS ON BOOK_RENT.userId = USERS.id) "
        )
      ->orderBy('BOOK_RENT.userId')
      ->exec()->fetch();
    $this->qb->clearQuery();

    $data['cataleg'] = $cataleg;
    $data['users'] = $users;
    $data['rent'] = $rent;
    
		// renderitzar vista
		return view('admin',$data);
    
	}

	public function prueba() {
		echo "Prueba - AdminController";
	}

	public function logout() {
		$this->session->set('email', null);
		$this->session->set('passwd', null);
		$this->index();
	}

	
  public function delUser() {
    $del_userId = $this->request->post('iduser');
    if ( !(is_numeric($del_userId)) ) {
      $this->redirect('/admin');
    }
    $rowCount_rents = $this->qb->delete()->from('BOOK_RENT')->where("userId = $del_userId")->qry()->stmt->rowCount();
    $this->qb->clearQuery();
    $rowCount_users = $this->qb->delete()->from('USERS')->where("id = $del_userId")->qry()->stmt->rowCount();
    $this->qb->clearQuery();
    $rowCount = $rowCount_rents + $rowCount_users;
		$this->session->set('admin_lastQuery_rowCount', $rowCount);
    $this->redirect('/admin');
  }
  public function delBook() {
    $del_bookId = $this->request->post('idbook');
    if ( !(is_numeric($del_bookId)) ) {
      $this->redirect('/admin');
    }
    $rowCount_rents = $this->qb->delete()->from('BOOK_RENT')->where("bookId = $del_bookId")->qry()->stmt->rowCount();
    $this->qb->clearQuery();
    $rowCount_booksAuthors = $this->qb->delete()->from('BOOKS__AUTHORS')->where("bookId = $del_bookId")->qry()->stmt->rowCount();
    $this->qb->clearQuery();
    $rowCount_books = $this->qb->delete()->from('BOOKS')->where("id = $del_bookId")->qry()->stmt->rowCount();
    $this->qb->clearQuery();
    $rowCount = $rowCount_rents + $rowCount_booksAuthors + $rowCount_books;
    
		$this->session->set('admin_lastQuery_rowCount', $rowCount);
    $this->redirect('/admin');
  }
  
  public function delRent() {
    $delRent_userId = $this->request->post('delRent_userId');
    $delRent_bookId = $this->request->post('delRent_bookId');
    if ( !(is_numeric($delRent_userId) && is_numeric($delRent_bookId)) ) {
      $this->redirect('/admin');
    }
    $rowCount = $this->qb->delete()->from('BOOK_RENT')->where($this->qb->and_cond(['userId'=>$delRent_userId, 'bookId'=>$delRent_bookId]))->qry()->stmt->rowCount();
		$this->session->set('admin_lastQuery_rowCount', $rowCount);
    $this->qb->clearQuery();
    $this->redirect('/admin');
  }
}
?>