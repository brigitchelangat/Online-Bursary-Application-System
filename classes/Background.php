<?php
// 'Background' object
class Background{

    // database connection and table name
    private $conn;
    private $table_name = "background";

    // object properties
  public $id;
  public $user_id;
	public $ward;
	public $division;
	public $location;
	public $sub_location;
	public $village;
	
	// constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function setBackground(){
      
      // create query
      $query = "INSERT INTO
                  " . $this->table_name . "
              SET
        user_id = :user_id,
        ward = :ward,
        division = :division,
        location= :location,
        sub_location = :sub_location,
        village = :village";
        
  
        // prepare the query
          $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->ward=htmlspecialchars(strip_tags($this->ward));
        $this->division=htmlspecialchars(strip_tags($this->division));
        $this->location=htmlspecialchars(strip_tags($this->location));
        $this->sub_location=htmlspecialchars(strip_tags($this->sub_location));
        $this->village=htmlspecialchars(strip_tags($this->village));
  
      // bind the values
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':ward', $this->ward);
        $stmt->bindParam(':division', $this->division);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':sub_location', $this->sub_location);
        $stmt->bindParam(':village', $this->village);
  
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