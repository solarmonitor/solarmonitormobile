<?php
include('globals.php');
include('functions.php');
$date = $date_today;
$fd_page = 'fd_page.php?date='.$date.'&type=';
echo 'hello world!<br>';
echo count($instrument_groups);
echo count($instrument_groups["main"]);
echo count($instrument_groups[0][0]);
echo '<br>';
for ($i = 0; $i < count($instrument_groups); $i++) {
	$current_instruments = array();
	for ($j = 0; $j < count($instrument_groups[$i]); $j++) {
		for ($k = 0; $k < count($instrument_groups[$i][$j]); $k++) {
			list($instrument,$filter) = explode('_',$instrument_groups[$i][$j][$k]);
			//echo find_latest_file($date,$instrument,$filter,'png','fd');
			//echo 'hi again';
			if(file_exists(find_latest_file($date,$instrument,$filter,'png','fd'))){
				$current_instruments[] = $instrument_groups[$i][$j][$k];
				echo $instrument_groups[$i][$j][$k];
				echo '<br>';
				break;
			}
		}					                       
	}					                 
}							     

?>


