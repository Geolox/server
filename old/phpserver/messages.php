<?php
require_once('throtler.php');
include('amqp_config.php');
include('config.php');
header("Content-type: text/x-json");
$queue = new Queue(HOST, PORT, USER, PASS, VHOST);
$queue->init($_REQUEST["queue"], $_REQUEST["exchange"]);
$arrDatos = array(
	'page'  => 1,
	'total' => MAXMESSAGEMONITOR
);
foreach($queue->getMessages(MAXMESSAGEMONITOR) as $row){
	$arrDatos['rows'][] = array(
		'id'   => htmlspecialchars($row['body']->reportid,ENT_QUOTES),
		'cell' => array(
				json_encode($row['meta']),
				htmlspecialchars($row['body']->reportd,ENT_QUOTES),
				htmlspecialchars($row['body']->catname,ENT_QUOTES),
				htmlspecialchars($row['body']->subcatname,ENT_QUOTES),
				htmlspecialchars($row['body']->desc,ENT_QUOTES),
				htmlspecialchars($row['body']->lon,ENT_QUOTES),
				htmlspecialchars($row['body']->lat,ENT_QUOTES)
		)
	);
}
echo json_encode($arrDatos);