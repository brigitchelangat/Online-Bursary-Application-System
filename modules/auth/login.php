<?php
// core configuration
include_once "../../config/core.php";

// make it work in PHP 5.4
include_once "../../libs/zgpwhwzn/passwordLib.php";

// set page title
$page_title = "Login";

// include login checker
include_once "loginchecker.php";

// include page header HTML
include_once 'header.php';
// include classes
include_once "../../config/database.php";
include_once '../../classes/Users.php';
include_once '../../classes/Applications.php';
// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$user = new User($db);
$applicant_id = new Application($db);
// default to false
$access_denied=false;

// if the login form was submitted
if($_POST){

	// check if email and password are in the database
	$user->email=$_POST['username'];

	// check if email exists, also get user details using this emailExists() method
    $email_exists = $user->emailExists();
	// validate login
	if($email_exists && password_verify($_POST['password'], $user->password)){

		// check if valid temporary user id exists
		if(isset($_SESSION['user_id'])){
			// update applications in the database
			$applicant_id->user_id=$user->id;
			$applicant_id->updateUserId();
        }
        	// set retrieved user_id to cookie user_id
		setcookie("user_id", $user->id);

		// set the session value to true
		$_SESSION['logged_in'] = true;
		$_SESSION['user_id'] = $user->id;
		$_SESSION['access_level'] = $user->access_level;
		$_SESSION['name'] = htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8') ;

		// if access level is 'Admin', redirect to admin section
		if($user->access_level==1){
			header("Location: {$home_url}modules/admin/dashboard.php?action=login_success");
		}

		// else, redirect only to 'Applicant' section
		else{
			header("Location: {$home_url}modules/applicant/dashboard.php?action=login_success");
		}
	}

	// if username does not exist or password is wrong
	else{
		$access_denied=true;
	}
}
// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";

// get 'action' value in url parameter to display corresponding prompt messages
$action=isset($_GET['action']) ? $_GET['action'] : "";

// tell the user he is not yet logged in
if($action =='not_yet_logged_in'){
	   echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
        echo "Please <a href='login.php'>Login.</a>";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "</div>";
}
    // tell the user to login
    else if($action=='please_login'){
        echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
        echo "Please <a href='login.php'>Login.</a>";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "</div>";
    }
        // tell the user if access denied
    if($access_denied){
        echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
        echo "Access Denied! Wrong credentials.</a>";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "</div>";
}
?>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form id="sigin" class="user" method="post" action="login.php">
                                        <div class="form-field">
                                        <label for="username">Username:</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="username" name="username" aria-describedby="emailHelp"
                                                placeholder="Enter Username" autocomplete="off">
                                                <small></small>
                                        </div>
                                        <div class="form-field">
                                        <label for="username">Pasword:</label>
                                            <input type="password" class="form-control form-control-user"
                                            id="password" name="password" placeholder="Enter Password" autocomplete="off" >
                                            <small></small>
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block" style="background-color: #27DEC0; color: white;">
                                            Login
                                        </button>
                                        
                                       
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Dont have an account? Register!</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
   <?php
    // footer HTML and JavaScript codes
include "footer.php";
?>
