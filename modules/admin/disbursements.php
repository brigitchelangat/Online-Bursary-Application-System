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
$page_title="Disbursed <small>Bursary</small>";

// include page header HTML
include_once 'header.php';

if(isset($_POST['disburse'])){
  
    $applicant_id=$_GET['id'];

    if($application->disburseBursary($applicant_id)){

      // Display success disbursement
      $amount = $_GET['amount'];
      $vrcvtacasmn=$_GET['name'];
      echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
        echo "KES. {$amount} for $vrcvtacasmn was disbursed successfuly";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "</div>";

        /*
        // send confimation message
        $inst = $_GET['inst'];
        $amount = $_GET['amount'];
        $batch= $_GET['batch'];
        $vrcvtacasmn=$_GET['name'];
        $vrcvtacasm=$_GET['phone'];
        $vmsgtacasmp="<Tharaka CDF>Dear {$vrcvtacasmn},\n";
        $vmsgtacasmp.="KES. {$amount} for Batch- {$batch} has been disbursed to {$inst}. Please liase with the finance office.";
                // Include SMS sending functionality
        include_once '../../libs/zgatwzn/atacasm.php';
      // if($utils->sendEmailViaPhpMailerLibrary($send_to_email, $subject, $body)){
      if(sendMsg($xdjeefpdra ,$fpdrejeaxd,$vrcvtacasm,$vmsgtacasmp)){
        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
        echo "KES. {$amount} for $vrcvtacasmn was disbursed successfuly. A message was sent to $vrcvtacasmn";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "</div>";
       }

    else{
        echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">";
        echo "KES. {$amount} to $vrcvtacasmn was disbursed successfuly.! We could not send a message to $vrcvtacasm.";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "</div>";
    }*/
    }else{
      echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
      echo "Failed to disburse the funds! Please try again to continue ";
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
                    <h1 class="h3 mb-2 text-gray-800">Bursary Applications</h1>
            
            <?php 
                $stmt=$application->readApplications($from_record_num, $records_per_page,2);
                $num = $stmt->rowCount();
                
                // if openings retrieved were more than zero
                if($num>0){
                    echo'
                    <!-- Table -->
                    <div class="card shadow border-bottom-primary mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Approved Applications</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Batch No.</th>
                                            <th>Name</th>
                                            <th>Institution</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                            <th>Batch No.</th>
                                            <th>Name</th>
                                            <th>Institution</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>';

                                      // display the list of applications
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo"<tr>
                    <td>{$row['batch']}</td>
                    <td>{$row['name']}</td>                
                    <td>{$row['inst']}</td>                   
                    <td>{$row['amount']}</td>
                    <td>Awarded</td>
                    <td>
                        <form action='disbursements.php?id={$row['userid']}&batch={$row['batch']}&amount={$row['amount']}&phone={$row['phone']}&inst={$row['inst']}&name={$row['name']}' method='post'>
                        <button type='submit' name='disburse' class='btn btn-primary btn-sm'><i class='fa fa-check'></i></button>
                        </form>
                    </td>
                </tr>";
                  
                }
            }

            // tell the user if there are no openings in the database
            else{
                echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">";
                echo "There are no applications currently.";
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
                echo "<span aria-hidden=\"true\">&times;</span>";
                echo "</button>";
                echo "</div>";
            }
        
        ?>
                        </tbody>
                    </table>
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
