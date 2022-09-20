<?php
class Database
{   
    private $host = "localhost";
    private $db_name = "gocheeta";
    private $username = "gocheeta";
    private $password = "123qwe";
    public $conn;

    public function dbConnection()
	{
    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

    public function dbconnectnew(){
        $this->con = mysqli_connect("$this->host","$this->username","$this->password","$this->db_name");

        if(mysqli_connect_errno()){
            echo "Failed to connect: ".mysqli_connect_errno();
        }
        return $this->con;
    }
    
}

?>