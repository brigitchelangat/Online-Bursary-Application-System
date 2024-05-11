<?php
// get ID of the product to be edited
//$id = isset($_GET['openingid']) ? $_GET['openingid'] : die('Missing product ID.');

// core configuration
include_once "../../config/core.php";

include_once '../../config/database.php';
include_once '../../classes/Users.php';
include_once '../../classes/Background.php';
include_once '../../classes/Education.php';
include_once '../../classes/Signatories.php';
include_once '../../classes/NeedLevel.php';
include_once '../../classes/Applications.php';


// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$user = new User($db);
$background = new Background($db);
$education = new Education($db);
$needlevel = new NeedLevel($db);
$signatories = new Signatories($db);
$application = new Application($db);




//$id = $_GET['openingid'];
    // set page title
$page_title="First <small>Applicant</small>";

// include page header HTML
include_once 'header.php';

    if(isset($_POST['submit'])){
        
          // set values to object properties
          $background->user_id=$_SESSION['user_id'];
          $background->ward = $_POST['ward'];
          $background->division = $_POST['division'];
          $background->location = $_POST['location'];
          $background->sub_location = $_POST['sublocation'];
          $background->village = $_POST['village'];

          $education->user_id=$_SESSION['user_id'];
          $education->institution = $_POST['institution'];
          $education->course = $_POST['course'];
          $education->location = $_POST['location'];
          $education->year = $_POST['year'];
          $education->latestScore = $_POST['latestScore'];

          $needlevel->user_id=$_SESSION['user_id'];
          $needlevel->parents = $_POST['parents'];
          $needlevel->disability = $_POST['disability'];
          
          $signatories->user_id=$_SESSION['user_id'];
          $signatories->chief = 0;
          $signatories->religious = 0;
          $signatories->school = 0;

          $application->user_id=$_SESSION['user_id'];
          $application->opening_id = (isset($_GET['openingid']) ? $_GET['openingid'] : '123');
          //$application->file = "null";
          $application->status = 0;

          if( $application->setApplication() && $background->setBackground() && $education->setEducation() && $needlevel->setNeedLevel()&& $signatories->setDefaultSignatories()){
            echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
            echo "We have captured your information successfuly! Please download the form to continue ";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
            echo "<span aria-hidden=\"true\">&times;</span>";
            echo "</button>";
            echo "</div>";
          }
          else{
            echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
            echo "Failed to capture your information! Please try again to continue ";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
            echo "<span aria-hidden=\"true\">&times;</span>";
            echo "</button>";
            echo "</div>";

          }
    }
?>

  <div class="container-fluid"_>
    <div class="row justify-content-center mt-0"> 
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Background Information</strong></h2>
                <p>Fill out the form below to proceed.</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
            <form id="msform" method="post" action="<?php echo $_SERVER['PHP_SELF'] ."?openingid=" . $_GET['openingid']; ?>">
                <!-- progressbar -->
                <ul id="progressbar">
                    <li class="active" id="background-info"><strong>Background Information</strong></li>
                    <li id="education"><strong>Education</strong></li>
                    <li id="need-level"><strong>Family Information</strong></li>
                    <li id="confirm"><strong>Finish</strong></li>
                </ul> <!-- fieldsets -->
                <fieldset>
                    <div class="form-card">
                        <h2 class="fs-title">Background Information</h2><hr>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="division">Division</label><input class="form-control" id="division" name="division" type="text" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="location">Location</label><input class="form-control" id="location" name="location" type="text" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="sublocation">Sub-location</label><input class="form-control" id="sublocation" name="sublocation" required type="text">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="ward">Ward</label><input class="form-control" id="ward" name="ward" type="text" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="village">Village</label><input class="form-control" id="village" name="village" type="text" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="opening">Opening ID</label><input class="form-control" id="openingid" name="openingid" type="text" value="<?php 
                          $id = $_GET['openingid'] ;
                          echo $id;?>" disabled>
                        </div>

                        </div>
                        
                    </div> 
                    <input type="button" name="next" class="next action-button" value="Next Step" />
                </fieldset>
                <fieldset>
                    <div class="form-card">
                        <h2 class="fs-title">Education</h2><hr>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="institution">Institution</label><input class="form-control" id="institution" name="institution" required type="text">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="course">Course</label><input class="form-control" id="course" name="course" required type="text">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="year">Year of Study</label><input class="form-control" id="year" name="year" required type="text">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="latestscore">Latest Score</label><input class="form-control" id="latestscore" name="latestScore" required type="text">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="location">Location</label><input class="form-control" id="location" name="location" required type="text">
                        </div>

                        </div>
                   
                    </div> 
                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    <input type="button" name="next" class="next action-button" value="Next Step" />
                </fieldset>
                <fieldset>
                  <div class="form-card">
                      <h2 class="fs-title">Family Information</h2> <hr>
                      <div class="form-group ">
                      <p>Parent/Guardian</p>
                      <div class="form-check">
                            <label class="form-check-label" for="parents">Both parents are alive?</label>
                            <input type="radio" value="0" class="form-check-input" id="parents" name="parents" required>
                            
                        </div>
                        <div class="form-check">
                              <label class="form-check-label" for="parents">Single Parent?</label>
                            <input type="radio" value="1" class="form-check-input" id="parents" name="parents" required>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="parents">Both deceased?</label>
                            <input type="radio" value="2" class="form-check-input" id="parents" name="parents" required>
                        </div>
                      </div>
                  
                        <div class="form-group">
                          <p>Any disability?</p>
                          <div class="form-check">
                            <label class="form-check-label" for="disability">Yes</label>
                            <input type="radio" value="1" class="form-check-input" id="disability" name="disability" required>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="disability">No</label>
                            <input type="radio" value="0" class="form-check-input" id="disability" name="disability" required>
                        </div>
                        </div>
                </div>
                  <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                  <input type="button" name="next" class="next action-button" value="Next Step" />
              </fieldset>
                <fieldset>
                    <div class="form-card">
                        <h2 class="fs-title text-center">Success !</h2> <br>
                        <div class="row justify-content-center">
                            <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image"> </div>
                        </div> <br>
                        <div class="row justify-content-center">
                            <div class="col-7 text-center">
                                <h5>You are all set! </h5>
                                <p>Download form.</p>
                                <input type="submit" class="action-button" name="submit" value="Submit">
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<?php

echo "<script src='../../src/js/applicant/multiform.js'></script>";
//footer HTML and JavaScript codes
include "footer.php";
            ?>

