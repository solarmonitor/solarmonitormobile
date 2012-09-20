<?php
/**
* Chart Page - Displays a chart for a given day.
* 
* Takes GET arguments date and type. Date is in yyyymmdd format and type one of xrays,protons, electrons, bfield, plasma, 3day and 6hour.
*
* @author Iain Billett
*/
include('jqm_page_template.php');
include('functions.php');
include('globals.php');

$chart = $_GET['type'];
$date  = $_GET['date'];

$chart_url = get_chart($date,$chart);
//$chart_range = get_chart_range($date,$chart);

//chart_img is the $content param for the print function.
$chart_img = '<img class = "main ui-corner-all" src="'.$chart_url.'"/>';


//code for red buttons - removed 

/*              
                $content = $content.'<div style="text-align:center">';
		$content = $content.'<div class="carousel_buttons" id="fd_ar_carousel">';
                foreach ($chart_range as $key => $path) {
                        if($path == $chart_url){
                                $highlight = 'class="highlight"';
                        }else{
                                $highlight = ''; 
                        }   
                        //$content = $content.'<div id="img'.$key.'" '.$highlight.'><div></div></div>';
                        $content = $content.'<div id="'.$path.'" '.$highlight.'><div></div></div>';
                }   
                        $content = $content.'</div>
                                                </div>
                        ';
*/
$chart_img = $chart_img.$content;




//Buttons to switch between charts in the same group eg GOES/ACE/SDO-EVE 
if($chart == 'xrays' || $chart=='protons' || $chart == 'electrons'){
	$chart_img = $chart_img.'
	<div data-role="fieldcontain" style = "text-align:center" >
		<div style="display:inline-block;margin:auto">		
		<fieldset data-role="controlgroup" data-type="horizontal">
			<input type="radio" name="radio-choice-xrays" id="radio-choice-xrays" value="xrays"  />
			<label for="radio-choice-xrays" style="font-size:0.6em">X-Rays</label>

			<input type="radio" name="radio-choice-protons" id="radio-choice-protons" value="protons"  />
			<label for="radio-choice-protons"style="font-size:0.6em">Protons</label>

			<input type="radio" name="radio-choice-electrons" id="radio-choice-electrons" value="electrons"  />
			<label for="radio-choice-electrons"style="font-size:0.6em">Electrons</label>
		</fieldset>
		</div>
	</div>
	';
}
if($chart == 'bfield' || $chart =='plasma' ){
	$chart_img = $chart_img.'
	<div data-role="fieldcontain" style = "text-align:center" >
		<div style="display:inline-block;margin:auto">		
	        <fieldset data-role="controlgroup" data-type="horizontal">
			<input type="radio" name="radio-choice-plasma" id="radio-choice-plasma" value="plasma"  />
			<label for="radio-choice-plasma" style="font-size:0.6em">Plasma</label>

			<input type="radio" name="radio-choice-bfield" id="radio-choice-bfield" value="bfield"  />
			<label for="radio-choice-bfield"style="font-size:0.6em">Magnetic Field</label>
		</fieldset>
		</div>    
	</div>
	';
}
if($chart == '3day' || $chart =='6hour' ){
	$chart_img = $chart_img.'
	<div data-role="fieldcontain" style = "text-align:center" >
		<div style="display:inline-block;margin:auto">		
	        <fieldset data-role="controlgroup" data-type="horizontal">
			<input type="radio" name="radio-choice-3day" id="radio-choice-3day" value="3day"  />
			<label for="radio-choice-3day" style="font-size:0.6em">3 Day</label>

			<input type="radio" name="radio-choice-6hour" id="radio-choice-6hour" value="6hour"  />
			<label for="radio-choice-6hour"style="font-size:0.6em">6 Hour</label>
		</fieldset>
		</div>    
	</div>
	';
}
//print page
print_jqm_page_template($chart_img,$date,$chart,'10000','chart_page.php');
?>
