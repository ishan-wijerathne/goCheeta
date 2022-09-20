<?php

require_once('inc/dbconfig.php');

class DASHBOARD
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
	
	public function users()
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM users");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function vehicles()
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT count(id) as bcount FROM branches");
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC)['bcount'];
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function branches()
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT count(id) as vcount FROM branches");
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC)['vcount'];
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function bookings()
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM bookings");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function bookingsbyClient($client_id)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM bookings WHERE client_id=:client_id");
			$stmt->execute(array(':client_id'=>$client_id));
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function bookingsbyDriver($driver_id)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT b.* FROM bookings b INNER JOIN vehicles v ON v.id=b.vehicle_id WHERE v.driver_id=:driver_id");
			$stmt->execute(array(':driver_id'=>$driver_id));
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
}
?>