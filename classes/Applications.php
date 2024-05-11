<?php
// 'Application' object
class Application{

// database connection and table name
private $conn;
private $table_name = "applications";

// object properties
public $id;
public $user_id;
public $opening_id;
public $date;
public $file;
public $status;

// constructor
public function __construct($db){
    $this->conn = $db;
}
// used in change password feature
// user is already logged in
// update user id
function updateUserId(){

  // update query
  $query = "UPDATE " . $this->table_name . "
          SET user_id = ?
          WHERE user_id = ?";

  // prepare query statement
  $stmt = $this->conn->prepare($query);

  // bind values
  $stmt->bindParam(1, $this->user_id);
  $stmt->bindParam(2, $_SESSION['user_id']);

  // execute the query
  if($stmt->execute()){
      return true;
  }else{
      return false;
  }
}

function setApplication(){

  $this->date=date('Y-m-d H:i:s');
    
  // create query
  $query = "INSERT INTO
              " . $this->table_name . "
          SET
    user_id = :user_id,
    opening_id = :opening_id,
    date = :date,
    status = :status";
    

    // prepare the query
      $stmt = $this->conn->prepare($query);

    // sanitize
    $this->user_id=htmlspecialchars(strip_tags($this->user_id));
    $this->opening_id=htmlspecialchars(strip_tags($this->opening_id));
    //$this->file=htmlspecialchars(strip_tags($this->file));
    $this->status=htmlspecialchars(strip_tags($this->status));
    

  // bind the values
    $stmt->bindParam(':user_id', $this->user_id);
    $stmt->bindParam(':opening_id', $this->opening_id);
    $stmt->bindParam(':date', $this->date);
    //$stmt->bindParam(':file', $this->file);
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
	// upload pdf files
	function upload(){
    define ('SITE_ROOT', realpath(dirname(__FILE__)));
    // name of the uploaded file
    $user_id=$this->user_id;
    $opening_id= $this->opening_id;
    $filename = $_FILES['file']['name'];
    
    // destination of the file on the server
    $destination = SITE_ROOT.'/uploads/' . $filename;
    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];
  
    if (!in_array($extension, ['zip', 'pdf', 'docx','jpg','png'])) {
      return false;
        //echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
      echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
                          // update query
                $query = "UPDATE " . $this->table_name . "
                SET  file = ? WHERE user_id= ? AND opening_id= ?";

            // prepare query statement
            $stmt = $this->conn->prepare($query);

            // sanitize
           // $this->file=htmlspecialchars(strip_tags($this->file));

            // bind values
                $stmt->bindParam(1, $filename);
                $stmt->bindParam(2, $this->user_id);
                $stmt->bindParam(3, $this->opening_id);
               
               

            // execute query
            if($stmt->execute()){
              return true;
            }else{
              return false;
            }
        } else {
           return false;
        }
    }
  }
    function readApplications($from_record_num, $records_per_page, $status){
        // select all products query
          $query = "SELECT 
         o.batch_no as batch, u.name as name,u.id as userid, u.phone as phone, a.amount as amount, b.ward as ward, e.institution as inst, a.date as date, a.file as form, a.status as status
        FROM
          " . $this->table_name . " a
          LEFT JOIN
            background b
          ON
            a.user_id = b.user_id
          LEFT JOIN
            education e
          ON
            a.user_id = e.user_id  
          LEFT JOIN
            users u
          ON
            a.user_id = u.id
          LEFT JOIN
            openings o
          ON
            a.opening_id = o.id  
          WHERE a.status = $status
        ORDER BY
          a.date ASC
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

      function readApplicant($id){
        // select all products query
          $query = "SELECT 
         o.batch_no as batch,a.amount as amount, u.name as name, u.id as userid, u.phone as phone, b.ward as ward, e.institution as inst, a.date as date, a.file as form, a.status as status
        FROM
          " . $this->table_name . " a
          LEFT JOIN
            background b
          ON
            a.user_id = b.user_id
          LEFT JOIN
            education e
          ON
            a.user_id = e.user_id  
          LEFT JOIN
            users u
          ON
            a.user_id = u.id
          LEFT JOIN
            openings o
          ON
            a.opening_id = o.id  
        WHERE a.user_id = $id
        ORDER BY
          a.date ASC
        ";

      // prepare query statement
      $stmt = $this->conn->prepare( $query );

      // bind limit clause variables
     // $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
      //$stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

      // execute query
      $stmt->execute();
      // return values
      // $row = $stmt->fetch(PDO::FETCH_ASSOC);
      // if($stmt->rowCount()){
      //   print_r($row);
      // }else{ echo "nothing to show";}
      
      // exit;
      return $stmt;

      }
      function updateStatus($id){

        // update query
        $query = "UPDATE " . $this->table_name . "
                SET status = 1
                WHERE user_id = $id";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
      }  
      
      function awardBursary($id,$amount){

        // update query
        $query = "UPDATE " . $this->table_name . "
                SET amount = $amount, status = 2
                WHERE user_id = $id";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
      
        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
      }
       
      function disburseBursary($id){

        // update query
        $query = "UPDATE " . $this->table_name . "
                SET status = 3
                WHERE user_id = $id";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
      
        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
      }
	
}
  ?>