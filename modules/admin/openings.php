<?php
// core configuration
include_once "../../config/core.php";

include_once '../../config/database.php';
include_once '../../classes/Openings.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$opening = new Opening($db);

    // set page title
$page_title="Bursary <small>Openings</small>";

// include page header HTML
include_once 'header.php';

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Bursary Openings</h1>


        <?php 
            $stmt=$opening->readAll($from_record_num, $records_per_page);
            $num = $stmt->rowCount();
            // if openings retrieved were more than zero
            if($num>0){
                echo'
                    <div class="card shadow border-bottom-primary mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Active Openings</h6>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Batch No.</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>Batch No.</th>
                                <th>Description</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                ';
               
                // display the list of openings
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                   $status = $row['status'] == 1 ? "open" : "close" ;
                    echo"<tr>
                    <td>{$row['batch_no']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['start_date']}</td>
                    <td>{$row['end_date']}</td>
                    <td>$status</td>
                    <td>
           
                        <button type='button' class='btn btn-success btn-sm'><i class='fa fa-edit'></i></button>
                       

                    </td>
                </tr>";
                }
            }

            // tell the user if there are no openings in the database
            else{
                echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">";
                echo "There are no openings currently.";
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
