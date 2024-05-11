<?php
// 'NeedLevel' object
class NeedLevel{

    // database connection and table name
    private $conn;
    private $table_name = "need_level";

    // object properties
  public $id;
  public $user_id;
	public $parents;
	public $disability;

	
	// constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function setNeedLevel(){
  
      // create query
      $query = "INSERT INTO
                  " . $this->table_name . "
              SET
        user_id = :user_id,
        parents = :parents,
        disability= :disability";
        
  
        // prepare the query
          $stmt = $this->conn->prepare($query);
  
        // sanitize
       
  
      // bind the values
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':parents', $this->parents);
        $stmt->bindParam(':disability', $this->disability);
      
  
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