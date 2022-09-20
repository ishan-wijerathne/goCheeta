<?php

class BOOKINGS
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
	
	public function updateBooking($id, $status, $modified_by)
	{
		try
		{	
			$modified_date = date("Y-m-d H:i:s");
			$stmt = $this->conn->prepare("UPDATE bookings SET status=:status, modified_by=:modified_by, modified_date=:modified_date WHERE id=:id");
			$stmt->bindparam(":id", $id);
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
	
	public function updateFeedback($id, $feedback, $modified_by)
	{
		try
		{	
			$modified_date = date("Y-m-d H:i:s");
			$stmt = $this->conn->prepare("UPDATE bookings SET feedback=:feedback, modified_by=:modified_by, modified_date=:modified_date WHERE id=:id");
			$stmt->bindparam(":id", $id);
			$stmt->bindparam(":feedback", $feedback);  
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
	
	public function selectBookings()
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT c.first_name as c_first_name, c.last_name as c_last_name, c.telephone as c_telephone, g.category, u.first_name, u.last_name, u.telephone, p.branch as pickup_location_name, d.branch as drop_location_name, v.plate_no, v.model, v.passengers, l.branch as branch_name, r.milage, r.rate, b.* FROM bookings b INNER JOIN vehicles v ON v.id=b.vehicle_id INNER JOIN users u ON u.user_id=v.driver_id INNER JOIN categories g ON g.id=v.category_id INNER JOIN users c ON c.user_id=b.client_id INNER JOIN branches p ON b.pickup_location=p.id INNER JOIN branches d ON b.drop_location=d.id INNER JOIN branches l ON l.id=v.branch_id INNER JOIN rates r ON r.category_id=v.category_id AND ((r.branch_from=b.pickup_location AND r.branch_to=b.drop_location) OR (r.branch_to=b.pickup_location AND r.branch_from=b.drop_location))");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function selectBookingsbyClient($id)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT g.category, u.first_name, u.last_name, u.telephone, p.branch as pickup_location_name, d.branch as drop_location_name, v.plate_no, v.model, v.passengers, r.milage, r.rate, b.* FROM bookings b INNER JOIN vehicles v ON v.id=b.vehicle_id INNER JOIN users u ON u.user_id=v.driver_id INNER JOIN categories g ON g.id=v.category_id INNER JOIN branches p ON b.pickup_location=p.id INNER JOIN branches d ON b.drop_location=d.id INNER JOIN rates r ON r.category_id=v.category_id AND ((r.branch_from=b.pickup_location AND r.branch_to=b.drop_location) OR (r.branch_to=b.pickup_location AND r.branch_from=b.drop_location)) WHERE b.client_id=:id");
			$stmt->execute(array(':id'=>$id));
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
	
	public function selectBookingsbyDriver($id)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT c.first_name as c_first_name, c.last_name as c_last_name, c.telephone as c_telephone, p.branch as pickup_location_name, d.branch as drop_location_name, r.milage, r.rate, b.* FROM bookings b INNER JOIN vehicles v ON v.id=b.vehicle_id INNER JOIN users c ON c.user_id=b.client_id INNER JOIN branches p ON b.pickup_location=p.id INNER JOIN branches d ON b.drop_location=d.id INNER JOIN rates r ON r.category_id=v.category_id AND ((r.branch_from=b.pickup_location AND r.branch_to=b.drop_location) OR (r.branch_to=b.pickup_location AND r.branch_from=b.drop_location)) WHERE v.driver_id=:id");
			$stmt->execute(array(':id'=>$id));
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			return array('error'=>$e->getMessage());
		}
	}
}
?>