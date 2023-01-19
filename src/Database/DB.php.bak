<?php

namespace App\Database;

class DB {
	protected \PDO $pdo;
	function __construct($pdo) {
		$this->pdo = $pdo;
	}

	protected function getColumnsString(array|null $fields):string {
		if (is_array($fields) && count($fields) > 0){
			$columns = implode(',',$fields);
		}else{
			$columns = "*";
		}
		return $columns;
	}
	function selectAll(string $table, array $fields=null):array	{
		
		$columns = $this->getColumnsString($fields);

		$sql = "SELECT {$columns} FROM {$table}";
		
		$stmt = $this->pdo->query($sql);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
		return $rows;
	}

	function selectAllWithJoin($table1,$table2,array $fields=null,string $join1,string $join2):array {
		$columns = $this->getColumnsString($fields);
			
		$inners="{$table1}.{$join1} = {$table2}.{$join2}";
		
		$sql="SELECT {$columns} FROM {$table1} INNER JOIN {$table2} ON {$inners}";
		
		$stmt=$this->query($sql);
		$stmt->execute();
		$rows=$stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $rows;
	}

	function select($table,$fields=null,$not=null,$condition=null){
		if($fields==null){
			$fields=['*'];
		}

		$sql = "SELECT " . implode(",",$fields) .
			" FROM {$table} "
		;
		
		if($condition==null){
			$sql.='';
		}else{
			$sql.="WHERE ";
			if($not!=null){
				$sql.=' NOT ';
			}

			$sql.=implode('=',$condition);
		}
			
		$stmt=$this->query($sql);
		$stmt->execute();
		$rows=$stmt->fetchAll(\PDO::FETCH_OBJ);
		return $rows;
	}

	// només una condició
	function selectWhereWithJoin($table1,$table2,array $fields=null,string $join1,string $join2,array $conditions):array
	{
		if (is_array($fields)){
			$columns=implode(',',$fields);
		}else{
			$columns="*";
		}
		
		$inners="{$table1}.{$join1} = {$table2}.{$join2}";
		$cond="{$conditions[0]}='{$conditions[1]}'";
			
		$sql="SELECT {$columns} FROM {$table1} INNER JOIN {$table2} ON {$inners} WHERE {$cond} ";
	
			
		$stmt=$this->query($sql);
		$stmt->execute();
		$rows=$stmt->fetchAll(\PDO::FETCH_OBJ);
		return $rows;   
	}

	function update(string $table, array $data,$id)
	{
		if ($data){
			$keys=array_keys($data);
			$values=array_values($data);
			$changes="";
			for($i=0;$i<count($keys);$i++){
				$changes.=$keys[$i]."='".$values[$i]."',";
			}
			$changes=substr($changes,0,-1);
			$cond="id='{$id}'";
			$sql="UPDATE {$table} SET {$changes} WHERE {$cond}";
			
			$stmt=$this->query($sql);
			$res=$stmt->execute();
			if($res){
				return true;
			}
		}else{
			return false;
		}
	}

	function remove($tbl,$id){
		$sql="DELETE FROM {$tbl} WHERE id='{$id}'";
		
		$stmt=$this->query($sql);
		$res=$stmt->execute();
		if($res){
			return true;
		}
		else{
			return false;
		}
	}



	public function query($sql){
		return $statement = $this->pdo->prepare($sql);       
	}

	function insert($table,$data):bool {
		if (is_array($data)){
			$columns='';$bindv='';$values=null;
			foreach ($data as $column => $value) {
				$columns.='`'.$column.'`,';
				$bindv.='?,';
				$values[]=$value;
			}
			$columns=substr($columns,0,-1);
			$bindv=substr($bindv,0,-1);

			$sql="INSERT INTO {$table}({$columns}) VALUES ({$bindv})";
				
			try{
					$stmt=$this->query($sql);
					$stmt->execute($values);
					return $this->pdo->lastInsertId();
			}catch(\PDOException $e){
					echo $e->getMessage();
					return false;
			}
				
			return true;
		}
		return false;
	}
}