<?php

class Varien_Object implements ArrayAccess{

	protected $data = array();

	public function __construct(){
		// $this->data = array(
		// 	'name'	=>	'hvd',
		// 	'age'	=>	32,
		// 	'hometown'	=>	'vn'
		// );
	}

	// protected function _getData($key){
	// 	return isset($this->data[$key]) ? $this->data[$key]	: null;
	// }

	public function __call($method, $args){
		$property = substr($method, 0, 3);
		switch ($property){
			case "get":
				$key = strtolower(preg_replace("/\B([A-Z])/", '_$1', substr($method, 3)));				
				return isset($this->data[$key]) ? $this->data[$key] : null;
			case "set":
				// echo "test";
				$key = strtolower(preg_replace("/\B([A-Z])/", '_$1', substr($method, 3)));
				// echo $key;
				$this->data[$key] = isset($args[0]) ? $args[0] : null;				
				// echo $this->data[$key];
				return $this->data[$key];
			default:
				throw new Exception("Don't exist this method");				
		}
	}

	public function getData($key=false){
		if($key){
			$result = isset($this->data[$key]) ? $this->data[$key] : null;
			return $result;
		}
		return $this->data;
	}

	public function __set($key, $value){
		$this->data[$key] = $value;
	}

	public function __get($key){
		return isset($this->data[$key]) ? $this->data[$key] : null;
	}

	public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    
    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }	
}