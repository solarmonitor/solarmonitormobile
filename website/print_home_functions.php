<?php
/**
* Formats an array of flares into a 3 column (MAGnitude , time & NOAA region) grid display.
* The flares array should already be sorted using the 'get_all_flares' method (functions.php).
*
* @param string $flares The array (2D) of flares.
* @param string $date The date. (for links).
* @return string The html of the grid.
* @author Iain Billett 2011.
*
*/

function get_flare_list($flares,$date,$sort){
	if(!count($flares)){
		return '<p  style ="border:none" class="grid-text">No Flares on this date.</p>';
	}
	switch ($sort) {
		case 'NOAA':
			$noaa_format = 'ui-bar-c';
			$time_format = 'ui-bar-d';
			$magnitude_format = 'ui-bar-d';
			break;
		case 'TIME':
			$noaa_format = 'ui-bar-d';
			$time_format = 'ui-bar-c';
			$magnitude_format = 'ui-bar-d';
			break;
		case 'MAGNITUDE':
			$noaa_format = 'ui-bar-d';
			$time_format = 'ui-bar-d';
			$magnitude_format = 'ui-bar-c';
			break;
		default:
			break;
	}
	$flare_list = '<div class="ui-grid-b">
				<div class="'.$magnitude_format.' ui-block-a grid-text" id ="MAGNITUDE"><h3>Mag</h3></div>
				<div class="'.$time_format.'  ui-block-b grid-text" id ="TIME"><h3>Time</h3></div>
				<div class="'.$noaa_format.'  ui-block-c grid-text" id ="NOAA"><h3>NOAA</h3></div>';
	foreach ($flares as $flare) {
		list($mag,$time) = explode('(',$flare['mag'],2);
		$time = str_replace(')','',$time);
		switch(substr($mag,0,1)){
			case 'C':
				$mag_style = 'style="color:yellow"';
				break;
			case 'M':
				$mag_style = 'style="color:orange"';
				break;
			case 'X':
				$mag_style = 'style="color:red"';
				break;
			default : 
				$mag_style='style=""';
				break;
		}   
		if($flare['yest']){
			$day = '<sup style="font-size:0.6em" > -1 day</sup>';
		}else{
			$day='';
		}
		$flare_list = $flare_list.'
				<div class="ui-bar-a ui-block-a grid-text" '.$mag_style.' ><p>'.$mag.'</p></div>
				<div class="ui-bar-a ui-block-b grid-text"  ><p>'.$time.$day.'</p></div>
				<div class="ui-bar-a ui-block-c grid-text"  >
					<a rel="external" href="ar_grid_page.php?date='.$date.'&type=shmi_maglc&region='.$flare['ar'].'" style = "text-decoration:none;color:white">
						<p>'.$flare['ar'].'</p>
					</a>
				</div>';
	}
	$flare_list = $flare_list.$_div;
	return $flare_list;
}
/**
* Creates a list of NOAA regions for the given date and formats it as a jquery mobile list.
* 
* @param string $date The date.
* @param string $type The type of image to link to.
* @return string The html of the list.
* @author Iain Billett.
*
*/
function get_content_ar_list($date,$type){
        include_once('functions.php');
	$html= '
               <ul data-role = "listview" data-theme = "a" data-dividertheme = "a" data-inset = "true">';
        $ar_data = find_latest_file($date,'','','txt','ar');
        $lines = file($ar_data);
        $ar_count = count($lines);
        $html = $html.'<li data-role="list-divider" data-theme="a" >Active Regions<span class = "ui-li-count">'.$ar_count.'</span></li>';
        foreach($lines as $line){
                $flare_count = substr_count($line,'http://');
                list($ar_number,$location_ns,$location_minutes,$h_type,$line) = explode(' ',$line,5);
                $h_type = str_replace('b','&#945',$h_type);
                $h_type = str_replace('a','&#946',$h_type);
                $h_type = str_replace('g','&#947',$h_type);
                $h_type = str_replace('d','&#948',$h_type);
                $html = $html.'
                <li data-theme = "d" data-icon="false">
                        <a rel = "external" href = "ar_page.php?date='.$date.'&type='.$type.'&region='.$ar_number.'"> 
                                <h3>'.$ar_number.'</h3>
                                <p>Location: '.$location_ns.' '.$location_minutes.'</p>
                                <p>Hale Class: '.$h_type.'</p>
                        </a>
                                <span class = "ui-li-count" id="'.$ar_number.'_'.$date.'">
                                        &#8470 Flares '.$flare_count.'
                                </span>
                        
                </li>';
        }   
    	return $html;
}

?>
