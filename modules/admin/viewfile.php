<?php
// core configuration
include_once "../../config/core.php";

    // set page title
$page_title="Admin <small>{Dashb}</small>";

// include page header HTML
include_once '../../incs/admin/header.php';

          
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

                                                    <form action="" method="post">
                                                    
                                                    <div class="form-group col-md-9">
                                                            <input type="text" class="form-control form-control-user" name="batch"
                                                                placeholder="Batch Number. e.g MAY-AUG 2021">
                                                    </div>
                                                        
                                                    
                                                    <div class="form-group col-md-9">
                                                    <input type="text" class="form-control form-control-user" name="description"
                                                    placeholder="Tharaka Constituency Fund">
                                                          
                                                    </div>

                                                    <div class="form-group col-md-9">
                                                           <input type="date" class="form-control form-control-user"
                                                                name="start_date">
                                                    </div>
                                                       
                                                    <div class="form-group col-md-9">
                                                    <input type="date" class="form-control form-control-user"
                                                         name="end_date">
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
include '../../incs/admin/footer.php';
            ?>

            