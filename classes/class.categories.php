<?php

class categories
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
	
	public function addCategory($category, $icon, $modified_by)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT id FROM categories WHERE UPPER(category)=UPPER(:category)");
			$stmt->execute(array(':category'=>$category));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() > 0)
			{	
                return array('error'=>'category name already exist');
			}
			else
			{	
                $modified_date = date("Y-m-d H:i:s");	
				$stmt = $this->conn->prepare("INSERT INTO categories(category, icon, modified_by, modified_date) 
														   VALUES(:category, :icon, :modified_by, :modified_date)");
				$stmt->bindparam(":category", $category);
				$stmt->bindparam(":icon", $icon);
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
	
	public function editCategory($id, $category, $icon, $modified_by)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT id FROM categories WHERE UPPER(category)=UPPER(:category) AND id!=:id");
			$stmt->execute(array(':id'=>$id,':category'=>$category));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() > 0)
			{
                return array('error'=>'category name already exist');
			}
			else
			{
                $modified_date = date("Y-m-d H:i:s");
				$stmt = $this->conn->prepare("UPDATE categories SET category=:category, icon=:icon, modified_by=:modified_by, modified_date=:modified_date WHERE id=:id");
				$stmt->bindparam(":id", $id);
				$stmt->bindparam(":category", $category);
				$stmt->bindparam(":icon", $icon);
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
	
	public function selectCategories()
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT u.first_name, u.last_name, b.* FROM categories b INNER JOIN users u ON u.user_id=b.modified_by");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function deleteCategory($id)
	{
		try
		{
            $stmt = $this->conn->prepare("DELETE FROM categories WHERE id=:id");		
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