<?php
// core configuration
include_once "../../config/core.php";
include_once '../../config/database.php';
include_once '../../classes/Applications.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$application = new Application($db);
$id = $_SESSION['user_id'];

    // set page title
$page_title="Check <small>Status</small>";

// include page header HTML
include_once 'header.php';
?>
		<main class="main-content bgc-grey-100">
				<div id="mainContent">
					<div class="container-fluid">
						
						<div class="row">
							<div class="col-md-12">
								<div class="bgc-white bd bdrs-3 p-20 mB-20">
									<h4 class="c-grey-900 mB-20">Applied Bursaries</h4>

					<?php 
            $stmt=$application->readApplicant($id);
            $num = $stmt->rowCount();
            // if openings retrieved were more than zero
            if($num>0){
                echo'
									<table cellspacing="0" class="table table-striped table-bordered" id="dataTable" width="100%">
										<thead>
											<tr>
												<th>Batch No.</th>
												<th>Amount</th>
												<th>Status</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>Batch No.</th>
												<th>Amount</th>
												<th>Status</th>
											</tr>
										</tfoot>
										<tbody>';
										while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
											switch($row['status']){
												case 0:
													$status = "Not Approved";
													break;
												case 1:
													$status = "Approved";
													break;
												case 2:
													$status = "Awarded";
													break;
												case 3:
														$status = "Disbursed";
														break;
											}
												
											
											 echo"<tr>
											 <td>{$row['batch']}</td>
											 <td>{$row['amount']}</td>
											 <td>$status</td>
									 </tr>";
									 }
									} else{
										echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">";
										echo "You have not applied to any opening. You can apply from <a href='dashboard.php>here.</a>'";
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
				</div>
			</main>

<?php
           
// footer HTML and JavaScript codes
include "footer.php";

?>
