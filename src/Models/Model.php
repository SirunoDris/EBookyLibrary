<?php

namespace App\Models;

use App\Database\DB;
use App\Container;

abstract class Model {
	protected DB $qb;
	protected string $table;
	protected array $data;
	protected int $id;

	public function __construct(array $data=null){
		$reflect = new \ReflectionClass($this);
		$this->table = strtoupper($reflect->getShortName()) . 'S';

		$this->qb = Container::get('database');
		$this->qb->setTable($this->table);
		if ($data) {
			$this->data = $data;
		}
	}

	public function get():array {
		return $this->data;
	}

	function save(){
		$this->qb->update($this->table, $this->data);
	}
	function persist(){
		if ($this->data){
				$this->qb->insert($this->data)->exec();
		}
	}
  function hasMany(object $obj,string $foreign_field){
    $table2=strtoupper((new \ReflectionClass($obj))->getShortName()).'S';
    $sql="SELECT * FROM {$this->table} t1 INNER JOIN {$table2} t2 ON t1.id={$table2}.{$foreign_field}";
    $this->qb->query[]=$sql;
    if($this->conditions){
        $this->qb->query->where();
    }
    $rows=$this->qb->query->exec()->fetch();
    return $rows;
  }

  function find(array $conditions) {
    $rows = $this->qb->select(['*'])->from($this->table)->where($this->qb->and_cond($conditions))->exec()->fetch();
    return $rows;
  }
}
