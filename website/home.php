<?php 
include('print_new_home.php');
include('globals.php');
if($date = $_GET["date"]){
	$date = str_replace('/','',$date);
	$date = str_replace('-','',$date);
	$date = str_replace('.','',$date);
	print_new_home($date);
}else{
	print_new_home($date_today);
}
//print_home('20110706');
?>
