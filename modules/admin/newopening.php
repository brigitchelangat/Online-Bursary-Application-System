<?php
// core configuration
include_once "../../config/core.php";
include_once '../../config/database.php';
include_once '../../classes/Openings.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$opening = new Opening($db);

if(isset($_POST['newopening'])){

    $opening->batch_no=$_POST['batch_no'];
    $opening->description=$_POST['description'];
    $opening->start_date=$_POST['start_date'];
    $opening->end_date=$_POST['end_date'];
    $opening->status= 1;

    

    if($opening->create()){
        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
        echo "New opening created successfully!";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "</div>";

    } else{
        echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
        echo "Failed to create new opening!";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
        echo "<span aria-hidden=\"true\">&times;</span>";
        echo "</button>";
        echo "</div>";
    }
  

   
}

    // set page title
$page_title="New <small>Opening</small>";

// include page header HTML
include_once 'header.php';

          
       echo ' 
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Bursary</h1>
                        
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
                                                Create New Opening</div>

                                                    <form action="newopening.php" method="post">
                                                    
                                                    <div class="form-group col-md-9">
                                                            <input type="text" class="form-control form-control-user" name="batch_no"
                                                                placeholder="Batch Number. e.g MAY-AUG 2024" required>
                                                    </div>
                                                        
                                                    
                                                    <div class="form-group col-md-9">
                                                    <input type="text" class="form-control form-control-user" name="description"
                                                    placeholder="BELGUT NGCDF 2024" required>
                                                          
                                                    </div>

                                                    <div class="form-group col-md-9">
                                                           <input type="date" class="form-control form-control-user"
                                                                name="start_date" required>
                                                    </div>
                                                       
                                                    <div class="form-group col-md-9">
                                                    <input type="date" class="form-control form-control-user"
                                                         name="end_date" required>
                                             </div>
                                                 
                                                    <button name="newopening" type="submit" class="btn btn-primary btn-user ml-3">
                                                        Create Opening
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
                     ';
// footer HTML and JavaScript codes
include 'footer.php';
            ?>

            