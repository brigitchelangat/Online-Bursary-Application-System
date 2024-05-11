<?php
// 'user' object
class User{

    // database connection and table name
    private $conn;
    private $table_name = "users";

    // object properties
	public $id;
	public $name;
	public $email;
	public $phone;
	public $password;
	public $access_level;
	public $created;
	// constructor
    public function __construct($db){
        $this->conn = $db;
    }
    // used in change password feature
    // user is already logged in

    // check if given email exist in the database
 function emailExists(){
		// query to check if email exists
		$query = "SELECT id, name, email,phone,password, access_level
				FROM " . $this->table_name . "
				WHERE email = ?
				LIMIT 0,1";

		// prepare the query
		$stmt = $this->conn->prepare( $query );

		// sanitize
		$this->email=htmlspecialchars(strip_tags($this->email));

		// bind given email value
		$stmt->bindParam(1, $this->email);

		// execute the query
		$stmt->execute();

		// get number of rows
		$num = $stmt->rowCount();

		// if email exists, assign values to object properties for easy access and use for php sessions
		if($num>0){

			// get record details / values
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			// assign values to object properties
			$this->id = $row['id'];
			$this->name = $row['name'];
      $this->email= $row['email'];
      $this->phone = $row['phone'];
			$this->access_level = $row['access_level'];
			$this->password = $row['password'];


			// return true because email exists in the database
			return true;
		}

		// return false if email does not exist in the database
		return false;
	}
	// create new user record
	function create(){

		// to get time stamp for 'created' field
		$this->created=date('Y-m-d H:i:s');

		// create query
		$query = "INSERT INTO
								" . $this->table_name . "
						SET
			name = :name,
			email = :email,
			phone= :phone,
			password = :password,
			access_level = :access_level,
			created_on = :created";

			// prepare the query
				$stmt = $this->conn->prepare($query);

			// sanitize
			$this->name=htmlspecialchars(strip_tags($this->name));
			$this->email=htmlspecialchars(strip_tags($this->email));
			$this->phone=htmlspecialchars(strip_tags($this->phone));
			$this->password=htmlspecialchars(strip_tags($this->password));
			$this->access_level=htmlspecialchars(strip_tags($this->access_level));

		// bind the values
			$stmt->bindParam(':name', $this->name);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':phone', $this->phone);

			// hash the password before saving to database
			$password_hash = password_hash($this->password, PASSWORD_BCRYPT);
			$stmt->bindParam(':password', $password_hash);

			$stmt->bindParam(':access_level', $this->access_level);
			$stmt->bindParam(':created', $this->created);

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
    ?>