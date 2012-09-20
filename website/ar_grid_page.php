<?php
/**
* Active Region Grid Page.
*
* Prints a grid of thumbnails of all the images of the active region for a given day. 
* These link to the ar_page for the instrument on that day.
* 
* GET : date the date , region the NOAA region of interest.
*/
include('functions.php');
include('globals.php');
include('jqm_page_template.php');
//get the date and region
$date = $_GET['date'];
$region = $_GET['region'];
//makes a grid of all the thumbs.
$thumbs= get_ar_thumbs($date,$region);
$content = '
	<p style="text-align:center;font-size:0.8em;font-weight:900"> NOAA '.$region.'<p>
	<div class="ui-grid-c" >
	';
$classes = array('a','b','c','d');
$i = 0;
foreach ($thumbs as $instr => $file) {
	list($folder,$dontcare) = explode('_',$instr,2);
	$path = "{$arm_data_path}data/$date/pngs/".$folder.'/'.$file;
	$content = $content.'
		<div class="ui-block-'.$classes[$i].'">
			<a rel="external" href="ar_page.php?date='.$date.'&type='.$instr.'&region='.$region.'">
				<img src = "'.$path.'" style = "width:100%"/>
			</a>
		</div>
	';
	$i++;
	$i = $i%4;	
}
$content = $content.'</div>';
print_jqm_page_template($content, $date,$type,$region,'ar_grid_page.php');
?>
