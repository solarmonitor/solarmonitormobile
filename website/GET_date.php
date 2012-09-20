<?php

$direction = $_GET['direction'];
$date = $_GET['date'];
$year          = substr($date,0,4);
$month         = substr($date,4,2);
$day           = substr($date,6,2);
$next_day      = date("Ymd",mktime(0,0,0,$month,$day+1,$year )); 
$prev_day      = date("Ymd",mktime(0,0,0,$month,$day-1,$year )); 
if($direction == 'forward'){
	echo $next_day;
}
if($direction == 'back'){
	echo $prev_day;
}
?>
