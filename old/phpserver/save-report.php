<?php
require_once('business.report.php');
require_once('throtler.php');
require_once('amqp_config.php');
require_once('config.php');
$data =  json_decode($_REQUEST["report"]);

$report = new reportBusiness();
$result = $report->save($data->body);
if ($result==1) {
	$queue = new Queue(HOST, PORT, USER, PASS, VHOST);
	$queue->init($_REQUEST["queue"], $_REQUEST["exchange"]);
	$result = $queue->ack($data->body->reportid);
}
echo "({result:".$result."})";