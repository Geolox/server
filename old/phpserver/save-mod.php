<?php
require_once('business.moderator.php');
$data =  json_decode($_REQUEST["mod"]);
$moderator = new moderatorBusiness();
$result = $moderator->save($data);

echo "({result:".$result."})";