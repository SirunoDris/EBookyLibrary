<?php

namespace App\Database;

class DB {
	private $query = [];
	private $fields = [];
	private $conditions = [];
	private $from = [];
  private  string $table;

	protected \PDO $pdo;

	function __construct($pdo) {
		$this->pdo = $pdo;
	}

  function getTable(){
      return $this->table;
    }

  function setTable($table){
      $this->table=$table;
    }

	function appendToQuery(string $s):self {
		$this->query[] = $s;
		return $this;
	}
	function clearQuery() {
		$this->query = [];
	}

	function select(array $fields = ["*"]):self {
		$sql = "SELECT ";
		$fieldsStr = implode(',', $fields);

		$this->appendToQuery($sql . $fieldsStr);
		return $this;
	}
	function insert(string $table, array $entries):self {
		$sql = "INSERT INTO $table VALUES ";
		
		$entries_count = count($entries);
		for ($i=0; $i < $entries_count; $i++) {
			$sql .= "(";
			$entry = $entries[$i];
			$fields_count = count($entry);
			for ($j=0; $j < $fields_count; $j++) {
				$fieldval = $entry[$j];
				$fieldval_out = $fieldval;
				$sql .= $fieldval_out;
				if ($j < $fields_count - 1) {
					$sql .= ",";
				}
			}
			$sql .= ")";
			if ($i < $entries_count - 1) {
				$sql .= ",";
			}
		}
		$this->appendToQuery($sql);
		return $this;
	}
	function delete(array $data=null):self {
		$sql = "DELETE ";

		$this->appendToQuery($sql);
		return $this;
	}

	function from(string $table):self {
		$this->appendToQuery(" FROM $table");
		return $this;
	}

	function where(string $condition):self {
		$this->appendToQuery(" WHERE $condition");
		return $this;
	}
	function and_cond(array $conditions, bool $or=false):string {
		$result = "(";
		$i = 0;
		$cond_count = count($conditions);
		foreach ($conditions as $k => $v) {
			$result .= "$k = $v";
			if ($i < $cond_count-1) {
				$result .= ($or) ? " OR " : " AND ";
			}
			$i++;
		}
		$result .= ")";
		return $result;
	}
	

	function limit(int $n):self {
		$this->appendToQuery(" LIMIT {$n}");
		return $this;
	}
  function orderBy(string $table, bool $desc = false):self {
		$this->appendToQuery(" ORDER BY $table ".(($desc)?"DESC ":""));
		return $this;
	}
	function __toString() {
		return join($this->query);
	}

	function selectCount():self {
		$sql = "SELECT COUNT(*) AS LEN ";

		$this->appendToQuery($sql);
		return $this;
	}

	function semicolon($queryArray=null):self {
		$this->appendToQuery(";");
		return $this;
	}

	function exec($queryArray=null):self {
		$this->appendToQuery(";");
		$sql = join($this->query);
		//var_dump($sql);

		$this->stmt = $this->query($sql);
		
		$this->stmt->execute();
		return $this;
	}
  function qry():self {
		$this->appendToQuery(";");
		$sql = join($this->query);

		$this->stmt = $this->query($sql);
		return $this;
	}
	

	function fetch():?array{
		$rows = $this->stmt->fetchAll(\PDO::FETCH_OBJ);
		if ($rows) {
			return $rows;
		}
		return null;
	}

	function query($sql){
		return $stmt = $this->pdo->query($sql);
	}
}