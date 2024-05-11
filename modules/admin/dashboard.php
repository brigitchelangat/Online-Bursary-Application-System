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
?>
         <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Bursary Applications</h1>
            
            <?php 
                $stmt=$application->readApplications($from_record_num, $records_per_page,0);
                $num = $stmt->rowCount();
                
                // if openings retrieved were more than zero
                if($num>0){
                    echo'
                    <!-- Table -->
                    <div class="card shadow border-bottom-primary mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pending Applications</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Batch No.</th>
                                            <th>Name</th>
                                            <th>Ward</th>
                                            <th>Institution</th>
                                            <th>date</th>
                                            <th>file</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                            <th>Batch No.</th>
                                            <th>Name</th>
                                            <th>Ward</th>
                                            <th>Institution</th>
                                            <th>date</th>
                                            <th>file</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>';

                                      // display the list of applications
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo"<tr>
                    <td>{$row['batch']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['ward']}</td>
                    <td>{$row['inst']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['form']}</td>
                    <td>{$row['status']}</td>
                    <td>
                        <a href='applicant_details.php?id={$row['userid']}' class='btn btn-primary btn-sm'><i class='fa fa-eye'></i></a>

                    </td>
                </tr>";
                }
            }

            // tell the user if there are no openings in the database
            else{
                echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">";
                echo "There are no pending applications currently.";
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
