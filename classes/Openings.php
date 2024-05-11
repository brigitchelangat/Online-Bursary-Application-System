<?php
// 'Application' object
class Opening{

        // database connection and table name
        private $conn;
        private $table_name = "openings";

        // object properties
        public $id;
        public $batch_no;
        public $description;
        public $start_date;
        public $end_date;
        public $status;

        // constructor
        public function __construct($db){
            $this->conn = $db;
        }

        	// create new user record
        function create(){


          // create query
          $query = "INSERT INTO
                      " . $this->table_name . "
                  SET
            batch_no = :batch_no,
            description = :description,
            start_date = :start_date,
            end_date = :end_date,
            status = :status";
            

            // prepare the query
              $stmt = $this->conn->prepare($query);

            // sanitize
            $this->batch_no=htmlspecialchars(strip_tags($this->batch_no));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->status=htmlspecialchars(strip_tags($this->status));

          // bind the values
            $stmt->bindParam(':batch_no', $this->batch_no);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':start_date', $this->start_date);
            $stmt->bindParam(':end_date', $this->end_date);
            $stmt->bindParam(':status', $this->status);

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

        function readAll($from_record_num, $records_per_page){

          // select all openings query
          $query = "SELECT *
              FROM
                " . $this->table_name . "

              
              
              LIMIT
                ?, ?";
      
          // prepare query statement
          $stmt = $this->conn->prepare( $query );
      
          // bind limit clause variables
          $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
          $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
      
          // execute query
          $stmt->execute();
      
          // return values
          return $stmt;
        }
        function readAllActive(){

          // select all openings query
          $query = "SELECT *
              FROM
                " . $this->table_name . "

              WHERE
                status = 1
              
              ";
      
          // prepare query statement
          $stmt = $this->conn->prepare( $query );

          // execute query
          $stmt->execute();
      
          // return values
          return $stmt;
        }
    
}
?>