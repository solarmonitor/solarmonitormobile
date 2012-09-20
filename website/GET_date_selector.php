<?php
$page= $_GET["page"];
$date= $_GET["date"];
$type= $_GET["type"];
$region= $_GET["region"];

$url = $page.'?date='.$date.'&type='.$type.'&region='.$region;

	echo $url;
?>
