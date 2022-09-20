<?php

class VEHICLES
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
	
	public function addVehicle($category, $branch, $plate_no, $model, $passengers, $username, $password, $first_name, $last_name, $telephone, $email, $modified_by)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT username, email FROM users WHERE UPPER(username)=UPPER(:uname) OR UPPER(email)=UPPER(:email)");
			$stmt->execute(array(':uname'=>$username, ':email'=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() > 0)
			{	
				if($userRow['username']==$username){
					return 'usernameExist';
				}else if($userRow['email']==$email){
					return 'emailExist';
				}
			}
			else
			{		
                $stmt = $this->conn->prepare("SELECT plate_no FROM vehicles WHERE UPPER(plate_no)=UPPER(:plate_no)");
                $stmt->execute(array(':plate_no'=>$plate_no));
                $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
                if($stmt->rowCount() > 0)
                {	
                    return 'plateNoExist';
                }
                else
                {		
					$user_type = 'Driver';
                    $stmt = $this->conn->prepare("INSERT INTO users(username,first_name,last_name,user_type,telephone,email,password) 
                                                               VALUES(:uname, :fname, :lname, :utype, :telephone, :umail, :upass)");
                    $stmt->bindparam(":uname", $username);
                    $stmt->bindparam(":fname", $first_name);  
                    $stmt->bindparam(":lname", $last_name);  
                    $stmt->bindparam(":utype", $user_type);  
                    $stmt->bindparam(":telephone", $telephone);
                    $stmt->bindparam(":umail", $email);
                    $stmt->bindparam(":upass", $password);
                    $stmt->execute();
                    $stmt = $this->conn->query("SELECT LAST_INSERT_ID()");
                    $driver_id = $stmt->fetchColumn();    
    
                    $modified_date = date("Y-m-d H:i:s");
                    $stmt = $this->conn->prepare("INSERT INTO vehicles(driver_id, category_id, branch_id, plate_no, model, passengers, modified_by, modified_date) 
                                                               VALUES(:driver_id, :category_id, :branch_id, :plate_no, :model, :passengers, :modified_by, :modified_date)");
                    $stmt->bindparam(":driver_id", $driver_id);
                    $stmt->bindparam(":category_id", $category); 
                    $stmt->bindparam(":branch_id", $branch);  
                    $stmt->bindparam(":plate_no", $plate_no);  
                    $stmt->bindparam(":model", $model);  
                    $stmt->bindparam(":passengers", $passengers);
                    $stmt->bindparam(":modified_by", $modified_by);
                    $stmt->bindparam(":modified_date", $modified_date);
                    $stmt->execute();
    
                    return 'true';
                }
			}
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}				
	}
	
	public function editVehicle($id, $driver_id, $category, $branch, $plate_no, $model, $passengers, $username,$password,$first_name,$last_name,$telephone,$email, $modified_by)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT username, email FROM users WHERE (UPPER(username)=UPPER(:uname) OR UPPER(email)=UPPER(:email)) AND user_id!=:driver_id");
			$stmt->execute(array(':uname'=>$username, ':email'=>$email, ':driver_id'=>$driver_id));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() > 0)
			{	
				if($userRow['username']==$username){
					return 'usernameExist';
				}else if($userRow['email']==$email){
					return 'emailExist';
				}
			}
			else
			{
				$stmt = $this->conn->prepare("UPDATE users SET username=:username, password=:password, first_name=:first_name, last_name=:last_name, telephone=:telephone, email=:email WHERE user_id=:driver_id");
				$stmt->bindparam(":driver_id", $driver_id);
				$stmt->bindparam(":username", $username);
				$stmt->bindparam(":password", $password);
				$stmt->bindparam(":first_name", $first_name);  
				$stmt->bindparam(":last_name", $last_name);   
				$stmt->bindparam(":telephone", $telephone);
				$stmt->bindparam(":email", $email);
				$stmt->execute();

				
				$modified_date = date("Y-m-d H:i:s");
				$stmt = $this->conn->prepare("UPDATE vehicles SET category_id=:category_id, branch_id=:branch_id, plate_no=:plate_no, model=:model, passengers=:passengers, modified_by=:modified_by, modified_date=:modified_date WHERE id=:id");
				$stmt->bindparam(":id", $id);
				$stmt->bindparam(":category_id", $category); 
				$stmt->bindparam(":branch_id", $branch);   
				$stmt->bindparam(":plate_no", $plate_no);  
				$stmt->bindparam(":model", $model);  
				$stmt->bindparam(":passengers", $passengers);
				$stmt->bindparam(":modified_by", $modified_by);
				$stmt->bindparam(":modified_date", $modified_date);
				$stmt->execute();
				
				return 'true';
			}
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}				
	}
	
	public function selectvehicles()
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT c.category, u.first_name, u.last_name, u.telephone, v.* FROM vehicles v INNER JOIN users u ON u.user_id=v.driver_id INNER JOIN categories c ON c.id=v.category_id");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function selectvehicle($id)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT u.user_id as driver_id, u.username, u.first_name, u.last_name, u.email, u.telephone, u.password, v.* FROM vehicles v INNER JOIN users u ON u.user_id=v.driver_id WHERE v.id=:id");
			$stmt->execute(array(':id'=>$id));
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function deleteVehicle($user_id)
	{
		try
		{
			$res = explode('-', base64_decode($user_id));
            $stmt = $this->conn->prepare("DELETE FROM vehicles WHERE id=:id");		
            $stmt->execute(array(":id"=>$res[0]));
			if($stmt->rowCount() > 0)
			{
				$stmt = $this->conn->prepare("DELETE FROM users WHERE user_id=:id");		
				$stmt->execute(array(":id"=>$res[1]));
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
}
?>