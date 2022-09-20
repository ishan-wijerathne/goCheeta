<?php

class INDEX
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
	
	public function newBooking($pickup_location, $drop_location, $pickup_address, $drop_address, $pickup_date, $pickup_time, $vehicle, $modified_by)
	{
		try
		{	
            $status = 'Processing';
            $modified_date = date("Y-m-d H:i:s");	
            $stmt = $this->conn->prepare("INSERT INTO bookings(client_id, pickup_location, drop_location, pickup_address, drop_address, pickup_date, pickup_time, vehicle_id, status, modified_by, modified_date) 
                                                        VALUES(:modified_by, :pickup_location, :drop_location, :pickup_address, :drop_address, :pickup_date, :pickup_time, :vehicle_id, :status, :modified_by, :modified_date)");
            $stmt->bindparam(":pickup_location", $pickup_location);
            $stmt->bindparam(":drop_location", $drop_location);
            $stmt->bindparam(":pickup_address", $pickup_address);
            $stmt->bindparam(":drop_address", $drop_address);
            $stmt->bindparam(":pickup_date", $pickup_date);
            $stmt->bindparam(":pickup_time", $pickup_time);
            $stmt->bindparam(":vehicle_id", $vehicle);
            $stmt->bindparam(":status", $status);
            $stmt->bindparam(":modified_by", $modified_by);
            $stmt->bindparam(":modified_date", $modified_date);
            $stmt->execute();
            return 'true';	
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}				
	}
	
	public function selectCategories()
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM categories ORDER BY id ASC");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function selectLocations()
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
	
	public function selectAvailableVehicles($category_id, $branch, $date)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT v.* FROM vehicles v WHERE v.category_id=:category_id AND v.branch_id=:branch_id AND v.id NOT IN (SELECT b.vehicle_id FROM bookings b WHERE b.vehicle_id=v.id AND b.pickup_date=:date AND b.status!='Cancelled')");
			$stmt->execute(array(':category_id'=>$category_id, ':branch_id'=>$branch, ':date'=>$date));
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
}
?>