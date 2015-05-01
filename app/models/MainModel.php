<?php 

class MainModel
{

	/**
	* Every model needs a database connection, passed to the model
	* @param object $db A PDO database connection
	*/
	public $db;
	function __construct($db) {
		try {
			$this->db = $db;
		} catch (PDOException $e) {
			exit('Database connection could not be established.');
		}
	}
	
	function selectAll($table) {
		$sql = "SELECT * FROM `".$table."`";
		$query = $this->db->query($sql);
		if(! $query) return false;
		$result = array();
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $row;
		}
		return $result;
	}
	
	function select($id) {
		$query = 'select * from `'.$this->_table.'` where `id` = \''.$id.'\'';
		return $query;    
	}
	public function querySqlWithTryCatch($sql){
		try {
			$query = $this->db->prepare($sql);
			$query->execute();
		} catch (PDOException $e) {
			exit(CONNECTION_FAILED);
		}
		return $query;
	}
	public function getArrayResult($query){
		if(! $query) return false;
		$result = array();
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $row;
		}
		return $result;
	}

	/**
	* Set session with prefix key
	* @param string $key
	* @param string $value
	*/
	public function setSession($key, $value)
	{
		$k = SES_PR . '_' . $key;
		$_SESSION[$k] = $value;
		return true;
	}
	/**
	* Get session with prefix key
	* @param string $key
	* @param string $value 
	*/
	public function getSession($key){
		$k = SES_PR . '_' . $key;
		if( isset($_SESSION[$k]) ) {
			return $_SESSION[$k];
		}
	return false;
	}
	/**
	* destroy session with prefix key
	* @param string $key
	* @param string $value 
	*/
	public function unsetSession($key){
		$k = SES_PR . '_' . $key;
		if(isset($_SESSION[$k]) ) {
			unset($_SESSION[$k]);
			return true;
		}
	return false;
	}
}