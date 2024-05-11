<?php
// initialize if session cart is empty
if(!isset($_SESSION['applicant'])){
	$_SESSION['applicant']=array();
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta content="text/html; charset=utf-8" http-equiv="content-type"><!-- /Added by HTTrack -->
  <title><?php echo isset($page_title) ? strip_tags($page_title) : "Tharaka CDF"; ?></title>
	<style>
	#loader{transition:all .3s ease-in-out;opacity:1;visibility:visible;position:fixed;height:100vh;width:100%;background:#fff;z-index:90000}#loader.fadeOut{opacity:0;visibility:hidden}.spinner{width:40px;height:40px;position:absolute;top:calc(50% - 20px);left:calc(50% - 20px);background-color:#333;border-radius:100%;-webkit-animation:sk-scaleout 1s infinite ease-in-out;animation:sk-scaleout 1s infinite ease-in-out}@-webkit-keyframes sk-scaleout{0%{-webkit-transform:scale(0)}100%{-webkit-transform:scale(1);opacity:0}}@keyframes sk-scaleout{0%{-webkit-transform:scale(0);transform:scale(0)}100%{-webkit-transform:scale(1);transform:scale(1);opacity:0}}
	</style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
		<link href="<?php echo $home_url; ?>src/css/applicant/style.css" rel="stylesheet">
    <link href="<?php echo $home_url; ?>src/css/applicant/multiform.css" rel="stylesheet">
		

</head>
<body class="app">
<?php include_once 'navigation.php'; ?>