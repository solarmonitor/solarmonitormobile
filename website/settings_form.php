<?php
include("globals.php");
/*
$favourites = array();
$count = count($instrument_types);
for ($i = 0; $i < $count; $i++) {
	if($value = $_GET['checkbox-'.$i]){
		if($value){
//			setcookie('myinstruments['.$value.']',$value);//'',time()+31*86400);
			$favourites[$value] = $value;	
		}else{
//			setcookie('myinstruments['.$value.']','',time() - 3600);	
		}
	}
}
setcookie('myinstruments',serialize($favourites),time()+31*86400);
echo 'cookie is set.';*/
$remove = false;
$index = -1;
$data = $_GET["checkbox"];
$favourites = unserialize(stripslashes($_COOKIE["myinstruments"]));
foreach ($favourites as $key=>$value) {
	if($value == $data){
		unset($favourites[$key]);
		$remove=true;
	}
}
if(!$remove){
	$favourites[$data] = $data;
}
setcookie('myinstruments',serialize($favourites),time()+31*86400,'/');

echo 'Data : '.$remove.' '.$index.' count : '.count($favourites);

?>
	
