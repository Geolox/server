<?php
header("Content-Type: text/event-stream\n\n");
header('Cache-Control: no-cache');
require_once('throtler.php');
include('amqp_config.php');
$maxMessages = 5;
$messages = array();
$throtler = new Queue(HOST, PORT, USER, PASS, VHOST);
$throtler->init($_REQUEST["queue"],$_REQUEST["exchange"]);
list($queueName,$count1 ,$count2) = $throtler->queue;
echo 'data: ' . $count1;// '\n';
