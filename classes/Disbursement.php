<?php
// 'Disbursement' object
class Disbursement{

    // database connection and table name
    private $conn;
    private $table_name = "disbursement";

    // object properties
  public $id;
  public $user_id;
	public $amount;
	public $status;
	
	
	// constructor
    public function __construct($db){
        $this->conn = $db;
    }
  }