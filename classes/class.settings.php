<?php
require_once('inc/dbconfig.php');
class SETTINGS
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
}

function SYSTEMERROR($data)
{
	$err = explode(']: ', $data);
	if(isset($err[1])){$data = $err[1];}
    return $data;
}

// error_reporting(0);
session_start();
date_default_timezone_set('Asia/Colombo');
$currentURL = basename($_SERVER["SCRIPT_FILENAME"]);
$rURI = $_SERVER['REQUEST_URI'];
$SITEURL = 'http://gocheeta.lk';