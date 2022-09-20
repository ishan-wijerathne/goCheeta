<?php

class RATES
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function updateRates($category_id, $branch_from, $branch_to, $milage, $rate, $modified_by)
	{
		try
		{
            $modified_date = date("Y-m-d H:i:s");
			$stmt = $this->conn->prepare("SELECT id FROM rates WHERE category_id=:category_id AND ((branch_from=:branch_from AND branch_to=:branch_to) OR (branch_from=:branch_to AND branch_to=:branch_from))");
			$stmt->execute(array(':category_id'=>$category_id, ':branch_from'=>$branch_from, ':branch_to'=>$branch_to));
			$rates=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() > 0)
			{	
				$stmt = $this->conn->prepare("UPDATE rates SET category_id=:category_id, branch_from=:branch_from, branch_to=:branch_to, milage=:milage, rate=:rate, modified_by=:modified_by, modified_date=:modified_date WHERE id=:id");
				$stmt->bindparam(":id", $rates['id']);
				$stmt->bindparam(":category_id", $category_id);
				$stmt->bindparam(":branch_from", $branch_from);
				$stmt->bindparam(":branch_to", $branch_to);
				$stmt->bindparam(":milage", $milage);
				$stmt->bindparam(":rate", $rate);
                $stmt->bindparam(":modified_by", $modified_by);
                $stmt->bindparam(":modified_date", $modified_date);	
				$stmt->execute();	
				return 'true';	
			}
			else
			{		
				$stmt = $this->conn->prepare("INSERT INTO rates(category_id, branch_from, branch_to, milage, rate, modified_by, modified_date) 
														   VALUES(:category_id, :branch_from, :branch_to, :milage, :rate, :modified_by, :modified_date)");
				$stmt->bindparam(":category_id", $category_id);
				$stmt->bindparam(":branch_from", $branch_from);
				$stmt->bindparam(":branch_to", $branch_to);
				$stmt->bindparam(":milage", $milage);
				$stmt->bindparam(":rate", $rate);
                $stmt->bindparam(":modified_by", $modified_by);
                $stmt->bindparam(":modified_date", $modified_date);
				$stmt->execute();
				return 'true';	
			}
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}				
	}
	
	public function selectBranches()
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM branches ORDER BY branch ASC");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function selectRates($category_id, $branch_from, $branch_to)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM rates WHERE category_id=:category_id AND ((branch_from=:branch_from AND branch_to=:branch_to) OR (branch_from=:branch_to AND branch_to=:branch_from))");
			$stmt->execute(array(':category_id'=>$category_id, ':branch_from'=>$branch_from, ':branch_to'=>$branch_to));
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function selectCategories()
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM categories ORDER BY category ASC");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
}
?>