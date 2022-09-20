<?php

class BRANCHES
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
	
	public function addBranch($branch, $modified_by)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT id FROM branches WHERE UPPER(branch)=UPPER(:branch)");
			$stmt->execute(array(':branch'=>$branch));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() > 0)
			{	
                return array('error'=>'Branch name already exist');
			}
			else
			{	
                $modified_date = date("Y-m-d H:i:s");	
				$stmt = $this->conn->prepare("INSERT INTO branches(branch, modified_by, modified_date) 
														   VALUES(:branch, :modified_by, :modified_date)");
				$stmt->bindparam(":branch", $branch);
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
	
	public function editBranch($id, $branch, $modified_by)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT id FROM branches WHERE UPPER(branch)=UPPER(:branch) AND id!=:id");
			$stmt->execute(array(':id'=>$id,':branch'=>$branch));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() > 0)
			{
                return array('error'=>'Branch name already exist');
			}
			else
			{
                $modified_date = date("Y-m-d H:i:s");
				$stmt = $this->conn->prepare("UPDATE branches SET branch=:branch, modified_by=:modified_by, modified_date=:modified_date WHERE id=:id");
				$stmt->bindparam(":id", $id);
				$stmt->bindparam(":branch", $branch);
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
	
	public function selectBranchs()
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT u.first_name, u.last_name, b.* FROM branches b INNER JOIN users u ON u.user_id=b.modified_by");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function deleteBranch($id)
	{
		try
		{
            $stmt = $this->conn->prepare("DELETE FROM branches WHERE id=:id");		
            $stmt->execute(array(":id"=>$id));	
			if($stmt->rowCount() > 0)
			{
                return 'true';
			}
			else
			{
                return array('error'=>'DNE');
            }
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
}
?>