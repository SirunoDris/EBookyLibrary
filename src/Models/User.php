<?php
	class User extends Model
	{
		private int $id;
		protected string $username;
		protected string $email;
		protected string $passwd;
		protected string $userRole;
    protected string $balance;
		
	}

public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

public function getUsername() {
		return $this->username;
	}

	public function setUsername($Username) {
		$this->username = $username;
	}

public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

public function getPasswd() {
		return $this->passwd;
	}

	public function setPasswd($passwd) {
		$this->passwd = $passwd;
	}

public function getUserRole() {
		return $this->userRole;
	}

	public function setUserRole($userRole) {
		$this->userRole = $userRole;
	}

public function getBalance() {
		return $this->balance;
	}

	public function setBalance($balance) {
		$this->balance = $balance;
	}

	
?>