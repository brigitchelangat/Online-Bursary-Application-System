<?php
// core configuration
include_once "../../config/core.php";
// include classes
include_once '../../config/database.php';
include_once '../../classes/Users.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$user = new User($db);

    // set page title
$page_title="Register";

// include page header HTML
include_once 'header.php';
// make it work in PHP 5.4
include_once "../../libs/zgpwhwzn/passwordLib.php";
// include login checker
include_once "loginchecker.php";

// if form was posted
if(isset($_POST['signup'])){
    // set user email to detect if it already exists
    $user->email=$_POST['email'];

  
    // check if email already exists
    if($user->emailExists()){
        echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
        echo "The email you specified is already registered. Please try to <a href='login.php'>login.</a>";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "</div>";
    }
    else{

        // set values to object properties
        $user->name=$_POST['name'];
        $user->email=$_POST['email'];
        $user->phone=$_POST['phone'];
        $user->access_level=0;
        $user->password=$_POST['password'];
       
        
			// create the user
			if($user->create()){
                // Display Success Message
                echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
                    echo "Account created successfully! Please <a href='login.php'>login here.</a>";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
                    echo "<span aria-hidden=\"true\">&times;</span>";
                    echo "</button>";
                    echo "</div>";

                /*
                // send confimation message
                $vrcvtacasmn=$_POST['name'];
                $vrcvtacasm=$_POST['phone'];
				$vmsgtacasmp="<Tharaka CDF>Hi {$vrcvtacasmn}.\n";
				$vmsgtacasmp.="You have successfully created an account on our portal. Please login and check for Bursary Openings.";
                 // Include SMS sending functionality
               include_once '../../libs/zgatwzn/atacasm.php';
				// if($utils->sendEmailViaPhpMailerLibrary($send_to_email, $subject, $body)){
				if(sendMsg($xdjeefpdra ,$fpdrejeaxd,$vrcvtacasm,$vmsgtacasmp)){
					echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
                    echo "Account created successfully! We have sent a confirmation message to $vrcvtacasm. Please <a href='login.php'>login here.</a>";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
                    echo "<span aria-hidden=\"true\">&times;</span>";
                    echo "</button>";
                    echo "</div>";
				}

				else{
					echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">";
                    echo "Account created successfully! We could not send a confirmation message to $vrcvtacasm. Please <a href='login.php'>login here.</a>";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
                    echo "<span aria-hidden=\"true\">&times;</span>";
                    echo "</button>";
                    echo "</div>";
				}*/

			}else{
				echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
                    echo "Failed to create account! Please <a href='register.php'>Try again.</a>";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
                    echo "<span aria-hidden=\"true\">&times;</span>";
                    echo "</button>";
                    echo "</div>";
			}
		}
    }
?>
<div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="register.php" method="post" >
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="name" name="name"
                                            placeholder="Full Name"  required value="<?php echo isset($_POST["name"]) ? htmlspecialchars($_POST["name"], ENT_QUOTES) :  "";  ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="phone" name="phone"
                                            placeholder="Phone Number" required value="<?php echo isset($_POST["phone"]) ? htmlspecialchars($_POST["phone"], ENT_QUOTES) : "";  ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Email Address" required value="<?php echo isset($_POST["email"]) ? htmlspecialchars($_POST["email"], ENT_QUOTES) : "";  ?>">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="password"  name="password" placeholder="Enter Strong Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="confirmPassword" placeholder="Confirm Password" required>
                                    </div>
                                    <p>
						<div class="" id="passwordStrength"></div>
					                </p>
                                </div>
                                
                                <input type="submit" class="btn btn-primary btn-user btn-block"
                                            id="signup" name="signup" value="Register Account" style="background-color: #27DEC0;">
                               
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
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
