<?php
namespace App\Models;

class BookRent extends Model {
	protected int $userId;
  protected int $bookId;
	protected string $title;
	protected string $iniDate;
  protected string $returnDate;
  protected string $realDate;
  protected string $extend;
  protected int $price;
  
  public function __construct(array $data=null){
    $this->table = 'BOOK_RENT';
    $this->qb = Container::get('database');
		$this->qb->setTable($this->table);
    if ($data) {
			$this->data = $data;
		}
  }
  
	public function getUserId() {
		return $this->userId;
	}
	public function getBookId() {
		return $this->BookId;
	}
	public function getTitle() {
		return $this->title;
	}
	public function getIniDate() {
		return $this->initDate;
	}
  public function getReturnDate() {
		return $this->returnDate;
	}
  public function getRealDate() {
		return $this->realDate;
	}
  public function getExtend() {
		return $this->extend;
	}
  public function getPrice() {
		return $this->price;
	}

	public function setUserId($userid) {
		$this->userId = $userId;
	}
	public function setBookId($bookId) {
		$this->bookId = $bookId;
	}
	public function setTitle($title) {
		$this->title = $title;
	}
	public function setIniDate($inidate) {
		$this->inidate = $inidate;
	}
  public function setReturnDate($returnDate) {
		$this->returnDate = $returnDate;
	}
  public function setRealDate($realDate) {
		$this->realDate = $realDate;
	}
  public function setExtend($extend) {
		$this->extend = $extend;
	}
  public function setPrice($price) {
		$this->price = $price;
	}
  
}