<?php
require_once('/throtler.php');
include('/amqp_config.php');
$queue = new Queue(HOST, PORT, USER, PASS, VHOST);
$queue->init($_REQUEST["queue"], $_REQUEST["exchange"]);
$message = array(
	'catid' => intval($_REQUEST["catid"]),
	'catname' => $_REQUEST["catname"],
	'subcatid' => intval($_REQUEST["subcatid"]),
	'subcatname' => $_REQUEST["subcat_name"],
	'reportd' => date("Y/m/d H:i:s"), 
	'desc' => $_REQUEST["desc"],
	'lon' => floatval($_REQUEST["lon"]), 
	'lat' => floatval($_REQUEST["lat"]),
	'img1' => $_REQUEST["img1"],
	'img2' => $_REQUEST["img2"],
	'img3' => $_REQUEST["img3"],
	'img1thumb' => $_REQUEST["img1thumb"],
	'mapphone' => $_REQUEST["mapphone"],
	'mapthumb' => $_REQUEST["mapthumb"],
	'mapmonitor' => $_REQUEST["mapmonitor"],
	'user'=> $_REQUEST["user"],
	'reportid'=> $_REQUEST["reportid"]
	);
$queue->putMessage(json_encode($message),$_REQUEST["reportid"]);