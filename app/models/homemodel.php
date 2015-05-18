<?php 
class HomeModel extends MainModel{
	public function selectPhone($id){
		$sql = "SELECT * FROM `products` WHERE name_id = '$id'";
		$query = $this->db->query($sql);
		return $this->getArrayResult($query);
	}
}


 ?>