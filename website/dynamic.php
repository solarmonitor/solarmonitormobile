<?php
include("globals.php");
include("functions.php");
$date = date("Ymd",time());
$file = find_latest_file($date,"saia","04500","png","ar","11243");
//$file = find_latest
//print(get_file_time($file));
//print(date("Ymd",time()));
//print(link_image($file,60,""));
//print 'hello ';
//echo $file;


$three_dim = array
	(
	"two_dim"=> array
		(
		"one_dim"=>array
			(
			"hello world!"
			)
		)
	);
echo $three_dim["two_dim"]["one_dim"][0];
?>
