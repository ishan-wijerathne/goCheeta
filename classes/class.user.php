<?php

class USER
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
	
	public function register($username, $password, $first_name, $last_name, $telephone, $email, $user_type)
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
				return 'true';	
			}
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}				
	}
	
	
	public function doLogin($uname, $upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id, user_type, password FROM users WHERE UPPER(username)=UPPER(:uname)");
			$stmt->execute(array(':uname'=>$uname));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{				
				if(password_verify($upass, $userRow['password']))
				{					
					$_SESSION['user_session'] = $userRow['user_id'];
					$_SESSION['user_type'] = $userRow['user_type'];
					return $userRow['user_type'];
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function selectUsers()
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM users ORDER BY user_id DESC");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function selectStaffUsers()
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE user_type!='Client' AND user_type!='Driver' ORDER BY user_id DESC");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function selectClients()
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE user_type='Client' ORDER BY user_id DESC");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function selectUser($id)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id=:id");
			$stmt->execute(array(':id'=>$id));
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function checkToken($token)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id FROM users WHERE password_token=:token && password_token!=''");
			$stmt->execute(array(':token'=>$token));
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function editUser($id,$eusername,$epassword,$efirst_name,$elast_name,$etelephone,$email,$euser_type)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id FROM users WHERE UPPER(username)=UPPER(:uname) AND user_id!=:id");
			$stmt->execute(array(':id'=>$id,':uname'=>$eusername));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() <= 0)
			{
				$stmt = $this->conn->prepare("UPDATE users SET username=:username, password=:password, first_name=:first_name, last_name=:last_name, telephone=:etelephone, email=:email, user_type=:user_type WHERE user_id=:userID");
				$stmt->execute(array(":userID"=>$id,":username"=>$eusername,":password"=>$epassword,":first_name"=>$efirst_name,":last_name"=>$elast_name,":etelephone"=>$etelephone,":email"=>$email,":user_type"=>$euser_type));			
				return $stmt;
			}
			else
			{
				return false;
			}
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}				
	}
	
	public function RequestPassword($email,$password_token)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id FROM users WHERE email=:email");
			$stmt->execute(array(':email'=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 0)
			{		
				return false;
			}
            $stmt = $this->conn->prepare("UPDATE users SET password_token=:password_token WHERE email=:email");
            $stmt->execute(array(":email"=>$email, ":password_token"=>$password_token));	
            return $stmt;
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}				
	}
	
	
	public function setPass($cpass,$npass,$user_id)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT password FROM users WHERE user_id=:uid");
			$stmt->execute(array(':uid'=>$user_id));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{				
				if(password_verify($cpass, $userRow['password']))
				{
					$sp = 1;
					$npass = password_hash($npass, PASSWORD_DEFAULT);	
					$stmt = $this->conn->prepare("UPDATE users SET password=:password WHERE user_id=:id");
					$stmt->execute(array(":id"=>$user_id,":password"=>$npass));
					$stmt->execute();			
					return $stmt;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	
	public function resetPassword($password, $user_id)
	{
		try
		{		
            $token = '';
            $stmt = $this->conn->prepare("UPDATE users SET password=:password, password_token=:token WHERE user_id=:id");
            $stmt->execute(array(":id"=>$user_id,":password"=>$password, ":token"=>$token));			
            return $stmt;
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}	
	
	public function deleteUser($user_id)
	{
		try
		{
            $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id=:id");		
            $stmt->execute(array(":id"=>$user_id));
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