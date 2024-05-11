<?php
// core configuration
include_once "../../config/core.php";

include_once '../../config/database.php';

include_once '../../classes/Applications.php';
    // set page title
$page_title="Apply <small> Bursary</small>";

// get database connection
$database = new Database();
$db = $database->getConnection();

$application = new Application($db);
$application->opening_id = $_GET['openingid'];
$application->user_id = $_SESSION['user_id'];
$applicant = $_SESSION['name'];
$batch= $_GET['batch'];
$dform=$applicant."_".$batch.".pdf";
$cform= copy("C:/xampp/htdocs/Bursary/classes/form/BELGUT_NGCDF_2024_APPLICATION_FORM.pdf","C:/xampp/htdocs/Bursary/classes/form/".$dform);
// echo $dform;
// exit;

// include page header HTML
include_once 'header.php';
if(isset($_POST['file'])){

  if( $application->upload()){
    echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
    echo "Document uploaded Successfully!";
    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
    echo "<span aria-hidden=\"true\">&times;</span>";
    echo "</button>";
    echo "</div>";
  }
  else{
    echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
    echo "Failed to upload document! Please try again";
    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
    echo "<span aria-hidden=\"true\">&times;</span>";
    echo "</button>";
    echo "</div>";

  }
}

    ?>
     <main class="main-content bgc-grey-100">
		 <div id="mainContent">
			<div class="row gap-20 masonry pos-r">
				<div class="masonry-sizer col-md-6"></div>
				  <div class="masonry-item w-100">
					 <div class="row gap-20">
           <div class="masonry-item col-md-6 offset-md-2">
           <div class="bd bgc-white">
             <div class="layers">
               <div class="layer w-100 p-20 pb-0">
                 <h5 class="lh-1">Apply for Bursary</h5>
                 <hr>
               </div>
               <div class="layer w-100 p-20">
                 <h6><?php echo $_GET['batch'];?></h6>
                 <p class="mB-0">Download the necessary documents to proceed with the application</p>
              </div>

              <div class="layer w-100 p-20">
              <h6 class="mB-0">Subsequent Applicant ?</h6>
              <p class="mB-4">This is not your first time to apply for the CDF bursary.</p>
              <?php echo "<a href='../../classes/form/$dform' class='btn btn-dark'>Download</a><br><br>";?>
              <h6 class="mB-4">Done filling the form?</h6>
              <form action="<?php echo $_SERVER['PHP_SELF']."?openingid=" . $_GET['openingid'] ."&batch=" .$_GET['batch'];?>" method="POST" enctype="multipart/form-data">
              <button type="submit" name="file" class="btn btn-success mr-4">Upload</button>
              <input type="file" name="file" id="chooseFile" />
              </form>
              <hr>
              <?php 
                  $id=$_GET['openingid'];
                  $batch=$_GET['batch'];
                  echo "
                    <a href='firsttime.php?openingid={$id}&batch={$batch}'>First time applicant?</a>
                  ";
              ?>
              <hr>
              </div>
				  </div>	
				 </main>
	
  <?php
           
// footer HTML and JavaScript codes
include "footer.php";
            ?>
 