<?php
include_once("functions.php");
include_once("print_home_functions.php");
$sort = $_GET['sort'];
$date = $_GET['date'];
if($sort){
	echo get_flare_list(get_all_flares($date,$sort),$date,$sort);
}else{
	echo get_flare_list(get_all_flares($date),$date,'NOAA');
}

?>
