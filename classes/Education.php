<?php
// 'Education' object
class Education{

    // database connection and table name
    private $conn;
    private $table_name = "education";

    // object properties
  public $id;
  public $user_id;
	public $institution;
	public $location;
	public $course;
	public $year;
	public $latestScore;
	
	// constructor
    public function __construct($db){
        $this->conn = $db;
    }
    
    function setEducation(){
  
      // create query
      $query = "INSERT INTO
                  " . $this->table_name . "
              SET
        user_id = :user_id,
        institution = :institution,
        location= :location,
        course = :course,
        year = :year,
        latestScore = :latestScore";
        
  
        // prepare the query
          $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->institution=htmlspecialchars(strip_tags($this->institution));
        $this->location=htmlspecialchars(strip_tags($this->location));
        $this->course=htmlspecialchars(strip_tags($this->course));
        $this->year=htmlspecialchars(strip_tags($this->year));
        $this->latestScore=htmlspecialchars(strip_tags($this->latestScore));
  
      // bind the values
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':institution', $this->institution);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':course', $this->course);
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':latestScore', $this->latestScore);
  
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