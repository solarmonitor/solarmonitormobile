<?php
/**
* Responds to a jquery get request for flare information. Returns a plain list of flares
* 
* @param string GET args This is the id of the calling button, containing the AR and the date.
* @author Iain.
*/
include("functions.php");
$args = $_GET["args"];
list($target_ar,$date)=explode('_',$args);
$ar_data = find_latest_file($date,'','','txt','ar');
$lines = file($ar_data);
foreach($lines as $line){
	list($ar_number,$location_ns,$location_minutes,$line) = explode(' ',$line,4);
	if($ar_number != $target_ar){
		continue;
	}
	list($dontcare,$flares) = explode('http://',$line,2);
	$flares = explode('http://',$flares);
	foreach($flares as $flare){
		list($dontcare,$flare) = explode(' ',$flare);
		if($flare){
			$flare_count=$flare_count.$flare.'
';//DO NOT move this
		}
	}
	if($ar_number==$target_ar){
		$patterns = array('/[(]/','/[)]/');
		$replacements = array(' ', ' UT ');
		$flare_count = preg_replace($patterns,$replacements,$flare_count);
		echo $flare_count;
		break;
	}
}
if(!$flare_count){
	echo 'noflare';
}
?>
