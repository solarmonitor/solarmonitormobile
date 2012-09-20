<?php 
include('globals.php');
include('print_fd_page.php');
$date = $_GET["date"];
$type = $_GET["type"];
if(!isset($type)){
	$type = $_GET["default_type"];
}

/*if($instrument_names_flip[$type]){//if type is actually a title (from a select menu)look into why these send titles not values.
	$type = $instrument_names_flip[$type];
}*/
print_fd_page($date,$type);
?>
