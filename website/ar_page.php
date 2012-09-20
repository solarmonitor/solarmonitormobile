<?php 
include_once('print_new_ar_page.php');
include_once('globals.php');
$date = $_GET["date"];
$type = $_GET["type"];
$region = $_GET["region"];
/*
//echo $instrument_names_flip[8].'<br>';
foreach ($instrument_names_flip as $key=>$value) {
	echo 'Key : '.$key.' Value : '.$value.'<br>';
}
echo '<br><br>';
echo 'Input recieved : '.$type.'<br>';
echo 'This corresponds to : '.$instrument_names_flip[$type].'<br>';
echo 'trying to display Angstrom char : %C5 and &Aring';
if($instrument_names_flip[$type]){//if type is actually a title (from a select menu)look into why these send titles not values.
        $type = $instrument_names_flip[$type];
	echo 'Type is now: '.$type.'<br>';
}*/
print_ar_page($date,$type,$region);
?>
