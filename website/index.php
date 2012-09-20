<?php 
include('print_new_home.php');
include('globals.php');
/*
$count = count($instrument_types);
for ($i = 0; $i < $count; $i++) {
        if($value = $_GET['checkbox-'.$i]){
                if(isset($value)){
                        setcookie('myinstruments['.$value.']','',time()-3600);
                }else{
                        setcookie('myinstruments['.$value.']',$value,time()+86400*31);  
                }
        }
}*/

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
