<?php
// login checker for 'applicant' access level

// if access level was not 'Admin', redirect  to login page
if(isset($_SESSION['access_level']) && $_SESSION['access_level']=="Admin"){
	header("Location: {$home_url}modules/admin/dashboard.php?action=logged_in_as_admin");
}

// if it is the 'edit profile' or 'orders' or 'place order' page, require a login
else if(isset($page_title) && ($page_title=="Check Status" || $page_title=="Apply Bursary" || $page_title=="First Applicant"|| $page_title=="Apply Bursary" || $page_title=="My Profile"|| $page_title=="Applicant Dashboard")){
	
	// if user not yet logged in, redirect to login page
	if(!isset($_SESSION['access_level'])){
		header("Location: {$home_url}modules/auth/login.php?action=please_login");
	}
}

// if it was the 'login' or 'register' page but the customer was already logged in
else if(isset($page_title) && ($page_title=="Login" || $page_title=="Register")){
	// if user is logged redirect to first page
	if(isset($_SESSION['access_level']) && $_SESSION['access_level']=="Applicant"){
		header("Location: {$home_url}modules/applicant/dashboard.php?action=already_logged_in");
	}
}

else{
	// no problem, stay on current page
}
?>