<?php
//setcookie("img","bbso_halph");
include("functions.php");
include("globals.php");
if(isset($_COOKIE["img"])){
//	list($instr,$filter) = explode('_',$_COOKIE["img"]);
	$instrument_groups[0][0] = array($_COOKIE["img"]);
	list($instr,$filter) = explode('_',$instrument_groups[0][0][0]);
	$img = find_latest_file(date("Ymd",time()),$instr,$filter,'png','fd');
}else{
	list($instr,$filter) = explode('_',$instrument_groups[0][0][0]);
	$img = find_latest_file(date("Ymd",time()),$instr,$filter,'png','fd');
}
echo 'Img src = '.$img;
echo '<img src='.$img.'>'; 
?>
