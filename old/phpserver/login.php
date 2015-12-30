<?php
require_once('business.moderator.php');
$username =  $_REQUEST["email"];
$password =  $_REQUEST["password"];

$moderatorObj = new moderatorBusiness();
$moderator = $moderatorObj->login(array('email'=>$username,'password'=>$password));
$result = 0;
if (is_array($moderator)) {
	session_start();
	$_SESSION['usr'] = $moderator;
	$result = 1;
}
echo "({result:".$result."})";