<?php

namespace App;

final class Request{
	protected string $controller;
	protected string $action;
	protected string $method;
	protected string $params;
	protected array $arrURI;

	function __construct(){
		$reqString = \htmlentities($_SERVER['REQUEST_URI']);
		$this->arrURI = explode('/',$reqString);
		array_shift($this->arrURI);

		$this->extractURI();
		$this->setMethod(\htmlentities($_SERVER['REQUEST_METHOD']));
	}

	function setController($controller){
		$this->controller=$controller;
	}

  function getParams(){
      return $this->params;
    }

  function setParams($params){
		$this->params=$params;
	}
  
	function getController(){
		return $this->controller;
	}

	function setAction($action){
		$this->action=$action;
	}
	function getAction(){
		return $this->action;
	}

	function getMethod(){
		return $this->method;
	}
	function setMethod($method){
		$this->method=$method;
	}

	private function extractURI():void{     
		$length=count($this->arrURI);
		//estudi de casos possibles
		switch($length){
			case 1: //only controller
				if($this->arrURI[0]==""){
					$this->setController('home');
				}else{
					$this->setController($this->arrURI[0]);
				}
				$this->setAction('index');
				break;
      
			case 2: //controller & action
				$this->setController($this->arrURI[0]);
				if($this->arrURI[1]==""){
					$this->setAction('index');
				}else{
					$this->setAction($this->arrURI[1]);
				}
				break;
      case 3: // cont. & act & params
                    $this->setController($this->arrURI[0]);
                    $this->setAction($this->arrURI[1]);
                    $this->params=($this->arrURI[2]);
                break;
		}
	}

	public function get($field) {
		if ($this->getMethod() == 'GET') {
			return filter_input(INPUT_GET, $field, FILTER_DEFAULT);
		} else {
			return null;
		}
	}
	public function post($field) {
		if ($this->getMethod() == 'POST') {
			return filter_input(INPUT_POST, $field, FILTER_DEFAULT);
		} else {
			return null;
		}
	}
}