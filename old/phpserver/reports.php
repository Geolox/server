<?php
require_once('business.report.php');
require_once('config.php');
header("Content-type: text/x-json");
$catid = 0;
if($_REQUEST["catid"]!='')
{
	$catid =  $_REQUEST["catid"];
}
$reports = new reportBusiness();
$reportsObj = $reports->find($catid);


 
$arrDatos = array(
	'page'  => 1,
	'total' => $reportsObj->count()
);

foreach($reportsObj as $row){
	$arrDatos['rows'][] = array(
		'id'   => htmlspecialchars($row['reportid'],ENT_QUOTES),
		'cell' => array(
				htmlspecialchars($row['catid'],ENT_QUOTES),
				htmlspecialchars($row['catname'],ENT_QUOTES),
				htmlspecialchars($row['subcatid'],ENT_QUOTES),
				htmlspecialchars($row['subcatname'],ENT_QUOTES),
				htmlspecialchars($row['loc']['lon'],ENT_QUOTES),
				htmlspecialchars($row['loc']['lat'],ENT_QUOTES),
				htmlspecialchars($row['user'],ENT_QUOTES)
		)
	);
}

echo json_encode($arrDatos);