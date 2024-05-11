<?php
// 'signatories' object
class Signatories{

    // database connection and table name
    private $conn;
    private $table_name = "signatories";

    // object user_id
  public $id;
  public $user_id;
	public $chief;
	public $religious;
	public $school;

	// constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function setDefaultSignatories(){
  
      // create query
      $query = "INSERT INTO
                  " . $this->table_name . "
              SET
        user_id = :user_id,
        chief = :chief,
        religious= :religious,
        school = :school";
        
  
        // prepare the query
          $stmt = $this->conn->prepare($query);
       
  
      // bind the values
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':chief', $this->chief);
        $stmt->bindParam(':religious', $this->religious);
        $stmt->bindParam(':school', $this->school);
      
  
      // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
        $this->showError($stmt);
              return false;
         }
  
       }
      public function showError($stmt){
        echo "<pre>";
          print_r($stmt->errorInfo());
        echo "</pre>";
      }
  }