<?php
// check if users / customer was logged in
			// if user was logged in, show "Edit Profile", "Orders" and "Logout" options
			if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']==0){
			?>
			<div>
		<div class="sidebar">
			<div class="sidebar-inner">
				<div class="sidebar-logo">
					<div class="peers ai-c fxw-nw">
						<div class="peer peer-greed">
							<a class="td-n" href="dashboard.php">
							<div class="peers ai-c fxw-nw">
								<div class="peer">
									<div class="logo">
									<img alt="" src="<?php echo $home_url; ?>src/images/applicant/logo.png"></div>
								</div>
								<div class="peer peer-greed">
									<h5 class="lh-1 mB-0 logo-text">Applicant</h5>
								</div>
							</div></a>
						</div>
						<div class="peer">
							<div class="mobile-toggle sidebar-toggle">
								<a class="td-n" href="#"><i class="ti-arrow-circle-left"></i></a>
							</div>
						</div>
					</div>
				</div>
				<ul class="sidebar-menu scrollable pos-r">
					<li class="nav-item mT-30 active">
						<a class="sidebar-link" href="dashboard.php"><span class="icon-holder"><i class="c-blue-500 ti-home"></i></span> <span class="title">Dashboard</span></a>
					</li>
				
				
					<li class="nav-item dropdown">
						<a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-purple-500 fa fa-money"></i></span> <span class="title">Applications</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
						<ul class="dropdown-menu">
							<li>
								<a href="status.php">My Applications</a>
							</li>
						</ul>
					</li>
				
				
				</ul>
			</div>
		</div>
		<div class="page-container">
			<div class="header navbar">
				<div class="header-container">

					<ul class="nav-left">
							<li>
								<a class="sidebar-toggle" href="javascript:void(0);" id="sidebar-toggle"><i class="ti-menu"></i></a>
							</li>


						</ul>
					

					<ul class="nav-right">
						<li class="dropdown">
							<a class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown" href="#">
							<div class="peer">
								<img alt="" class="w-2r bdrs-50p" src="../../src/images/applicant/logo.png">
								<span class="fsz-sm c-grey-900"><?php echo "Welcome Back! ".$_SESSION['name']; ?></span>
							</div>
							</a>
							<ul class="dropdown-menu fsz-sm">	
								<li>
									<a class="d-b td-n bgcH-grey-100 c-grey-700" href="../auth/logout.php"><i class="ti-power-off mR-10"></i> <span>Logout</span></a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>

		
			
			
	
			
<?php
}
		?>