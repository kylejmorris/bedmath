<?php
$raw_post_data=file_get_contents('php://input');
$raw_post_array=explode('&', $raw_post_data);
$myPost=array();
foreach ($raw_post_array as $keyval) {
  $keyval=explode('=',$keyval);
	if (count($keyval)==2) {
		$myPost[$keyval[0]]=urldecode($keyval[1]);
	}
}
$req = 'cmd=_notify-validate';
foreach ($myPost as $key =>$value) {        
	$value=urlencode($value);
	$req.="&$key=$value";
}
if (PAY_SANDBOX) {
	$ch=curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
} else {
	$ch=curl_init('https://www.paypal.com/cgi-bin/webscr');
}
curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$req);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch,CURLOPT_FORBID_REUSE,1);
curl_setopt($ch,CURLOPT_HTTPHEADER,array('Connection: Close'));
if(!($res=curl_exec($ch))) {
	curl_close($ch);
	exit;
}
curl_close($ch);
if (strcmp($res, "VERIFIED")!==0) {
	exit;
}
if ($_POST['payment_status']!="Completed") {
	exit;
}
require_once 'libs/loader.php';

if ($_POST['receiver_email']!=PAY_ADDRESS) {
	exit;
}
if ($_POST['mc_currency']!=PAY_CURRENCY) {
	exit;
}

$points=new Points();
$user=new User();

$userID=intval($_POST['custom']);
$numofpoints=intval($_POST['mc_gross'])*800;

if (!$user->exists($userID)) {
	exit;
}

$points->addPoints($userID,$numofpoints,6);
?>
