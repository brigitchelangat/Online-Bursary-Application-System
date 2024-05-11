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
$page_title="Bursary <small>Applications</small>";

// include page header HTML
include_once 'header.php';


  if(isset($_POST['changestatus'])){
    if($_POST['status']==1){
      $applicant_id=$_GET['id'];
      
      if($application->updateStatus($applicant_id)){
        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
        echo "Status updated successfuly! ";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "</div>";
      }else{
        echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
        echo "Failed to update status! Please try again to continue ";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "</div>";
      }

    }
      else if($_POST['status']==0){
          // send confimation message
          $message=$_POST['reason'];
          $batch= $_GET['batch'];
          $vrcvtacasmn=$_GET['name'];
          $vrcvtacasm=$_GET['phone'];
          $vmsgtacasmp="<Tharaka CDF>Dear {$vrcvtacasmn},\n";
          $vmsgtacasmp.="Your application for Batch- {$batch} was disapproved because : {$message}. Please login and resubmit your application.";
                  // Include SMS sending functionality
              include_once '../../libs/zgatwzn/atacasm.php';
        // if($utils->sendEmailViaPhpMailerLibrary($send_to_email, $subject, $body)){
        if(sendMsg($xdjeefpdra ,$fpdrejeaxd,$vrcvtacasm,$vmsgtacasmp)){
          echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
          echo "The status for $vrcvtacasmn was updated successfuly. A message was sent to $vrcvtacasmn";
          echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
          echo "<span aria-hidden=\"true\">&times;</span>";
          echo "</button>";
          echo "</div>";
         }

      else{
          echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">";
          echo "The status for $vrcvtacasmn was updated successfuly.! We could not send a message to $vrcvtacasm.";
          echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
          echo "<span aria-hidden=\"true\">&times;</span>";
          echo "</button>";
          echo "</div>";
      }
      }
    }
  
?>


         <!-- Begin Page Content -->
                <div class="container-fluid">
      
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Bursary Applications</h1>
            
            <?php 
                $stmt=$application->readApplicant($_GET['id']);
                $num = $stmt->rowCount();
                
                // if openings retrieved were more than zero
                if($num>0){
                    echo'
                    <!-- Table -->
                    <div class="card container-fluid shadow border-bottom-primary mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Active Applications</h6>
                        </div>
                        <div class="card-body">
                            ';

              // display the list of applications
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo"<tr>
                    <h3>Batch Number-{$row['batch']}</h3> <hr>
                    <h4>Name-{$row['name']}</h4>
                    <h4>Ward-{$row['ward']}</h4>
                    <h4>Institution-{$row['inst']}</h4>
                    <p>Date-{$row['date']}</p>
                    <form action='applicant_details.php?id={$row['userid']}&name={$row['name']}&phone={$row['phone']}&batch={$row['batch']}' method='post' class='row'>
                    <div class='form-group col-md-8'>
                    <p>Status</p>
                    <div class='form-check-inline'>
                          
                          <input type='radio' value='1' class='form-check-input' id='status' name='status' required>
                          <label class='form-check-label' for='status'>Approve?</label>
                      </div>
                      <div class='form-check-inline'>
                          <input type='radio' value='0' class='form-check-input' id='status' name='status' required>
                          <label class='form-check-label' for='status'>Disapprove?</label>
                      </div>
                    </div>
                    <div class='form-group col-md-8'>
                    <p>If form is disapproved</p>
                    <input type='text' class='form-control form-control-user' name='reason'
                        placeholder='Reason for disapproval' required>
                    </div>
                    <div class='col-md-8'>
                    <button name='changestatus' type='submit' class='btn btn-primary btn-user ml-3'>
                                                        Submit
                    </button>
                    </div>
                    </form>

                    <br/><br/>
              <iframe src='../../classes/uploads/{$row['form']}#toolbar=0&navpanes=0&scrollbar=0' type='application/pdf' width='90%' height='500px'></iframe>
                 ";
                }  
        
        ?>
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
