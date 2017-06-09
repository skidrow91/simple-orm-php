<?php

require_once "./Object.php";

abstract class Entity extends Varien_Object{

	protected $tableName;
	protected $db;

	public function __construct(){
		$this->db = new PDO('mysql:host=172.19.0.2;dbname=orm_test;charset=utf8mb4', 'root', '123456');
	}

	public function save(){
		$class = new ReflectionClass($this);
		$this->tableName = strtolower($class->getShortName());
		$properties = array();
		$values = array();
		// foreach($class->getProperties(ReflectionProperty::IS_PUBLIC) as $property){
		// 	if($property->getName() != 'id'){
		// 		$properties[] = $property->getName();
		// 		$values[] = "?";
		// 	}			
		// }
		foreach($this->getData() as $key=>$property){
			$properties[] = $key;
			$values[] = "?";
		}
		// echo $this->getData($properties[0]);
		// echo "<pre/>";
		// print_r($properties);
		// echo $this->getData($properties[0]);
		// exit();
		$valuesToImplode = implode(",", $values);		
		$propsToImplode = implode(",", $properties);		
		$stm = $this->db->prepare("INSERT INTO ".$this->tableName."(".$propsToImplode.")  VALUES(".$valuesToImplode.")");
		for($i=0; $i<count($values); $i++){
			// echo $this->getData($properties[$i]);
			// $stm->bindParam($i+1, $this->{$properties[$i]});
			$var{$i} = $this->getData($properties[$i]);			
			$stm->bindParam($i+1, $var{$i});
		}		
		$stm->execute();
	}

	public function find($id){
		$class = new ReflectionClass($this);
		$this->tableName = strtolower($class->getShortName());
		$properties = array();
		$values = array();
		$stm = $this->db->prepare("SELECT * FROM ".$this->tableName." WHERE id = ?");
		$stm->bindParam(1, $id);
		$stm->execute();
		if($stm){
			$this->data = $stm->fetch(PDO::FETCH_ASSOC);
		}		
		// echo "<pre/>";
		// print_r($results);
	}
}