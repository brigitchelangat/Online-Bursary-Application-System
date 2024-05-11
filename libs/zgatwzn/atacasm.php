<?php
require 'vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;

// Set your app credentials
$xdjeefpdra   = "cldlbrvm";
$fpdrejeaxd = "05df59f4689f7b737d74caf4a7982a6db592571c19544c42d7bec78022154aa4";
function sendMsg($snu,$kay,$rsp,$msg){
// Initialize the SDK
$fpdratejeaxd      = new AfricasTalking($snu, $kay);

// Get the SMS service
$xdjemsefpdra   = $fpdratejeaxd  ->sms();

// Set the numbers you want to send to in international format

$vrcvtacasmot = $rsp;

// Set your message
$vrcvtacasmeg    = $msg;

// Set your shortCode or senderId
//$vrcvtacasmfo      = "*******";
	
	try {
    // Thats it, hit send and we'll take care of the rest
    $cldlbrtlrvm= $xdjemsefpdra ->send([
        'to'      => $vrcvtacasmot,
        'message' => $vrcvtacasmeg,
        //'from'    => $vrcvtacasmfo  
    ]);
   return true;
    //print_r($cldlbrtlrvm);
} catch (Exception $e) {
	return false;
    //echo "Error: ".$e->getMessage();
}
}
?>