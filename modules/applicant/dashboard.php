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
$page_title="Applicant <small>Dashboard</small>";

// include page header HTML
include_once 'header.php';

?>

		 <main class="main-content bgc-grey-100">
		 <div id="mainContent">
			<div class="row gap-20 masonry pos-r">
				<div class="masonry-sizer col-md-6"></div>
				  <div class="masonry-item w-100">
					 <div class="row gap-20">

					 <?php 

						$stmt=$opening->readAllActive();
						$num = $stmt->rowCount();
						// if openings retrieved were more than zero
						if($num>0){

							 // display the list of openings
							 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
								echo"
									<div class='col-md-4'>
									<div class='layers bd bgc-white p-20'>
										<div class='layer w-100 mB-10'>
											<h6 class='lh-1'>{$row['batch_no']}</h6>
										</div>
										<div class='layer w-100 mB-10'>
											<pclass='lh-1'>{$row['description']}</p>
										</div>
										<div class='layer w-100 mB-10'>
										<h6 class='lh-1'>Opening Date .  <span class='d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500'>{$row['start_date']}</span></h6>
											</div>
											<div class='layer w-100 mB-10'>
											<h6 class='lh-1'>Closing Date .  <span class='d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500'>{$row['end_date']}</span></h6>
											</div>
										<div class='layer w-100 mB-10'>
										<h6 class='lh-1'>Status .  <span class='d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500'>Open</span></h6>
											</div>
											<div class='layer w-100 mB-10'>
											<a href='apply.php?batch={$row['batch_no']}&openingid={$row['id']}' class='btn btn-primary'>Apply Now</a>
											</div>

									</div>
								</div>";
							}
						}else {
								echo "<h1> No bursary openings currently.</h1>";
							}

					 ?>	
				 </div>	
				 </main>


		<?php
							
		// footer HTML and JavaScript codes
		include "footer.php";
		?>