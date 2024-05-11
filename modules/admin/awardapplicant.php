<?php
// core configuration
include_once "../../config/core.php";
include_once '../../config/database.php';
include_once '../../classes/Applications.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$application = new Application($db);





    // set page title
$page_title="Award <small>Bursary</small>";
    // set page title

   
// include page header HTML
include_once 'header.php';

if(isset($_POST['award'])){
  
    $applicant_id=$_GET['id'];
    $amount = $_POST['amount'];

    if($application->awardBursary($applicant_id,$amount)){
       // Display Award Succes
        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
        echo "KES. {$amount} for $vrcvtacasmn was awarded successfuly. A message was sent to $vrcvtacasmn";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "</div>";
      /*
        // send confimation message
        $batch= $_GET['batch'];
        $vrcvtacasmn=$_GET['name'];
        $vrcvtacasm=$_GET['phone'];
        $vmsgtacasmp="<Tharaka CDF>Dear {$vrcvtacasmn},\n";
        $vmsgtacasmp.="You have been awarded KES. {$amount} for Batch- {$batch}. You will be notified upon successful disbursements.";
                // Include SMS sending functionality
            include_once '../../libs/zgatwzn/atacasm.php';
      // if($utils->sendEmailViaPhpMailerLibrary($send_to_email, $subject, $body)){
      if(sendMsg($xdjeefpdra ,$fpdrejeaxd,$vrcvtacasm,$vmsgtacasmp)){
        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
        echo "KES. {$amount} for $vrcvtacasmn was awarded successfuly. A message was sent to $vrcvtacasmn";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "</div>";
        
       }
       
       
    else{
        echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">";
        echo "KES. {$amount} for $vrcvtacasmn was awarded successfuly.! We could not send a message to $vrcvtacasm.";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "</div>";
    }*/
    }else{
      echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
      echo "Failed to award the funds! Please try again to continue ";
      echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
      echo "<span aria-hidden=\"true\">&times;</span>";
      echo "</button>";
      echo "</div>";
    }
   
  }
?>       
     
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Award <?php echo $_GET['name'];?></h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- New Bursary Opening-->
                        <div class="col-xl-8 col-md-8 mb-4 mx-auto">
                            <div class="card border-bottom-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">

                                            <div class="text-xl font-weight-bold text-primary text-uppercase mb-4">
                                                Award Funds</div>

                                                <?php echo "<form action='awardapplicant.php?name={$_GET['name']}&id={$_GET['id']}&batch={$_GET['batch']}&phone={$_GET['phone']}' method='post'>";?>
                                                    
                                                    <div class="form-group col-md-9">
                                                            <input type="number" class="form-control form-control-user" name="amount"
                                                                placeholder="KES. 5000" required>
                                                    </div>
                                                 
                                                    <button name="award" type="submit" class="btn btn-primary btn-user ml-3">
                                                        Award
                                                    </button>
                                                 
                                                </form>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                       

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
                     <?php
// footer HTML and JavaScript codes
include 'footer.php';
            ?>

            