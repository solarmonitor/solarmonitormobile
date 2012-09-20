<?php
include('functions.php');
$direction = $_GET['direction'];
$date = $_GET['date'];
$chart_type = $_GET['type'];
$url = get_chart($date,$chart_type);
$year          = substr($date,0,4);
$month         = substr($date,4,2);
$day           = substr($date,6,2);
$next_day      = date("Ymd",mktime(0,0,0,$month,$day+1,$year )); 
$prev_day      = date("Ymd",mktime(0,0,0,$month,$day-1,$year )); 
if($direction == 'back' && $prev_day >= '19960101'){
	$url = get_chart($prev_day,$chart_type);
}
if($direction == 'forward' && $next_day <= date('Ymd',time())){
	$url = get_chart($next_day,$chart_type);
}
echo $url;

?>
