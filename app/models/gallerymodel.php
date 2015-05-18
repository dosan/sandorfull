<?php

class GalleryModel{

	private $db;
	public $mess;
	/**
	 * 
	 * @param [type] $db   [description]
	 * @param [type] $mess [description]
	 */
	function __construct($db, $mess) {
		$this->mess = $mess;
		try {
			$this->db = $db;
		} catch (PDOException $e) {
			exit('Database connection could not be established.');
		}
	}

	public function getArrayResult($query){
		if(! $query) return false;
		$result = array();
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $row;
		}
		return $result;
	}
	function getCategories() {
		$sql = "SELECT
					g.id,
					g.name,
					count(i.id) as total
				FROM
					`gallery_categories` AS g
				LEFT JOIN `images` AS i ON g.id = i.category
				GROUP BY g.id";
		$query = $this->db->query($sql);
		return $this->getArrayResult($query);
	}
	function getCategory($id) {
		$sql = "SELECT
					g.id,
					g.name,
					count(i.id) as total
				FROM
					`gallery_categories` AS g
				LEFT JOIN `images` AS i ON g.id = i.category
				WHERE g.id = {$id}
				GROUP BY g.id
				";
		$query = $this->db->query($sql);
		return $this->getArrayResult($query);
	}

	public function getDuplicate($case, $select, $from, $where, $equals, $and="", $equals2=""){
		switch ($case) {
			case 1:
				$sql = "SELECT {$select} FROM {$from} WHERE {$where} = '{$equals}'";
				break;
			case 2:
				$sql = "SELECT {$select} FROM {$from} WHERE {$where} = '{$equals}' AND {$and} != '{$equals2}'";
				break;
		}
		$res = $this->db->query($sql);
		if($res->rowCount() > 0){
			return true;
		}
		return false;
	}
	public function getAllImagesByCategory($id){
		$sql = "SELECT * FROM images WHERE category = {$id} ORDER BY display_order ASC";
		$query = $this->db->query($sql);
		return $this->getArrayResult($query);
	}
	public function getTotalImages($id){
		$sql = "SELECT * FROM images WHERE category = {$id}";
		$query = $this->db->query($sql);
		if ($query->rowCount() > 0) {
			return $query->rowCount();
		}else{
			return '0';
		}
	}
	public function getOrder($case, $select, $from, $where, $equal){
		switch ($case) {
			case 1:
				$sql = "SELECT {$select} FROM {$from} WHERE {$where} = '{$equal}' ORDER BY {$select} DESC LIMIT 1";
				break;
		}
		$query = $this->db->query($sql);
		$result = $this->getArrayResult($query);
		//$result = $query->rowCount();
		return ($result[0][$select] + 1);

	}
	public function getFileName($id){
		$sql = "SELECT image FROM images WHERE id = {$id}";
		$query = $this->db->query($sql);
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result['image'];
	}
	public function getImages($category){
		$images = array();
		$sql = "SELECT image FROM images WHERE category = {$category}";
		$query = $this->db->query($sql);
		do {
			array_push($images, $rows['image']);
		} while ($rows = $query->fetch(PDO::FETCH_ASSOC));
		return $images;
	}
	public function insertImage($caption, $new_name, $id, $order){
		$sql = "INSERT INTO images(caption, image, category, display_order)
						VALUES('{$caption}', '{$new_name}', {$id}, {$order})";
		return $this->db->exec($sql);
	}
	public function insertCategory($name){
		$sql = "INSERT INTO gallery_categories(name) VALUES('{$name}')";
		return $this->db->exec($sql);
	}
	public function updateCategory($id, $name){
		$sql = "UPDATE gallery_categories SET name = '{$name}' WHERE id = {$id}";
		return $this->db->exec($sql);
	}
	/**
	 * update category
	 * @param  int $id category id for update
	 * @return bolean
	 */
	public function update($id, $name){
		$sql = "UPDATE gallery_categories SET name = '{$name}' WHERE id = '{$id}'";
		return $this->db->exec($sql);
	}
	public function updateImage($value, $rid){
		$sql = "UPDATE images SET display_order = {$value} WHERE id = '{$rid}'";
		return $this->db->exec($sql);
	}
	/**
	 * [delete post where id = $id]
	 * @param  [int] $id [category id for delete ]
	 * @return [nothing]
	 */
	public function deleteCategory($id)
	{
		$sql = "DELETE FROM gallery_categories WHERE id = '{$id}'";
		return $this->db->exec($sql);
	}
	public function deleteImages($remove){
		$sql = "DELETE FROM images WHERE id IN(";
		$sql .= implode(", ", $remove);
		$sql .= ")";
		return $this->db->exec($sql);
	}
}