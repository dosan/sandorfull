<?php 

class OOPModel{
	
	private $db;
	public $mess;
	public $result = array();
	/**
	 * 
	 * @param [type] $db   [description]
	 * @param [type] $mess [description]
	 */
	function __construct($db, $mess) {
		try {
			$options = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
			$this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . 'oophp', DB_USER, DB_PASS, $options);
			//default charset utf8
			$this->db->exec("set names utf8");
		} catch (PDOException $e) {
			exit('Database connection could not be established.');
		}
	}
	public function select(){
		if ($_GET['search']) {
			try {
				$sql = 'SELECT make, yearmade, mileage, price, description
				FROM cars
				LEFT JOIN makes USING (make_id)
				WHERE make LIKE :make AND yearmade >= :yearmade AND price <= :price
				ORDER BY price';
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(':make', '%' . $_GET['make'] . '%');
				$stmt->bindParam(':yearmade',  $_GET['yearmade'], PDO::PARAM_INT);
				$stmt->bindParam(':price',  $_GET['price'], PDO::PARAM_INT);
				$stmt->execute();
				$stmt->bindColumn( 'make', $make);
				$stmt->bindColumn(2, $year);
				$errorInfo = $this->db->errorInfo();
				if (isset($errorInfo[2])) {
					$this->result['error'] = $errorInfo[2];
				}
				$this->result['result'] = $stmt->fetchall();
			} catch (Exception $e) {
				$this->result['error'] = $e->getMessage();
			}
			return $this->result;
		}
	}

	public function home(){
		try {
			$amount = 200;
			$payer = 'Jane Black';
			$payee = 'John White';
			$debit = 'UPDATE savings SET balance = balance - :amount WHERE name = :payer';
			$getBalance = 'SELECT balance FROM savings WHERE  name = :payer';
			$credit = 'UPDATE savings SET balance = balance + :amount WHERE name = :payee';

			$pay = $this->db->prepare($debit);
			$pay->bindParam(':amount', $amount);
			$pay->bindParam(':payer', $payer);

			$check = $this->db->prepare($getBalance);
			$check->bindParam(':payer', $payer);

			$receive = $this->db->prepare($credit);
			$receive->bindParam(':amount', $amount);
			$receive->bindParam(':payee', $payee);

			$this->db->beginTransaction();
			$pay->execute();
			if (!$pay->rowCount()) {
				$this->db->rollBack();
				$this->result['error'] = "Transaction failed: could not update $payer's balance.";
			}else{
				//Check the remaining balance in the payer's account
				$check->execute();
				$bal = $check->fetchColumn();
				$check->closeCursor();

				if ($bal < 0) {
					$this->db->rollBack();
					$this->result['error'] = "Transaction failed: insufficient funds in $payer's account.";
				}else{
					$receive->execute();
					if (!$receive->rowCount()) {
						$this->db->rollBack();
						$this->result['error'] = "Transaction failed: could not update $payee's balance.";
					}else{
						$this->db->commit();
					}
				}
			}
			$this->result['balance'] = $this->db->query('SELECT name, balance FROM savings');
			return $this->result;

		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	}

}