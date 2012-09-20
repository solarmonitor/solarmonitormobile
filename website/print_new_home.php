<?php
/**
* Print Home page.
*
* Prints the home page using jqm_page_template.php
* Secions are created as strings and added to $content in the order they are created.
* @author Iain Billett 2011
*/

include("globals.php");
include("jqm_page_template.php");
include('functions.php');
include('print_home_functions.php');

//Refreshes my instruments cookie if it's more than 14 days old.
if(time() - $_COOKIE["lastVisit"] > 14*86400){
        setcookie('myinstruments',$_COOKIE["myinstruments"],time + 31*86400);
}
setcookie('lastVisit',time(),31*86400);
//get my instruments cookie in php array format
$myinstruments = unserialize(stripslashes($_COOKIE["myinstruments"]));
$mypreferences = unserialize(stripslashes($_COOKIE["mypreferences"]));
//var_dump($mypreferences);
//Assumes the date is today if not specified.
if(!$date = $_GET["date"]){
	$date = date("Ymd",time());
}

$url = '/data/20110726/pngs/thmb/';
$coll = '<div data-role="collapsible" data-collapsed="true">';
$_div = '</div>';
$imgs = get_all_thumbs($date);

//start collapsoble set
$content = $content.'<div data-role="collapsible-set">';

//Creates and adds the myinstruments section if the cookie is set.
$fd_page = 'fd_page.php?date='.$date.'&type=';
if(isset($_COOKIE['myinstruments'])){

        $myinstruments_html= $myinstruments_html.'<div data-role = "collapsible">
              <h3>My Instruments</h3>
              <ul data-role="listview" data-inset="true" data-dividertheme="a">';
        foreach ($myinstruments as $inst) {
                list($instr,$filter) = explode('_',$inst);
                if(file_exists(find_latest_file($date,$instr,$filter,'png','thmb'))){
                        $myinstruments_html= $myinstruments_html.'<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.$inst.'">
                            <img src="'.find_latest_file($date,$instr,$filter,'png','thmb').'" title="sample 1" id = "thumb1"/>
                            <h3>'.$instrument_names[$inst].'</h3>
                            <p>'.get_file_time(find_latest_file($date,$instr,$filter,'png','fd')).'</p>
                        </a></li>';
                }else{
                        $myinstruments_html= $myinstruments_html.'<li class = "ui-bar-d"><a rel = "external" href="home.php">
                            <img src="" title="sample 1" id = "'.$inst.'"/>
                            <h3>'.$instrument_names[$inst].' : No Image Today</h3>
                        </a></li>';
                }   
        }   
        $myinstruments_html= $myinstruments_html.'</ul>
              </div>';//end collpasible section
}
$content = $content.$myinstruments_html;
//end my instruments

//Start the solar images section
$grid = '<div data-role="collapsible" data-collapsed="false"> 
	<h3> Solar Images </h3>
        <div class="ui-grid-c">';
for ($i = 0; $i < count($imgs); $i++) {
	$img_a = $imgs[$i]['src'];
	$img_a_type = $imgs[$i]['type'];
	if(file_exists($img_a)){
		$img_a='
		<a rel="external" href="fd_page.php?date='.$date.'&type='.$img_a_type.'">
		<img style = "width:100%" src = "'.$img_a.'"/>
		</a>';
	}
        $i++;
	$img_b = $imgs[$i]['src'];
	$img_b_type = $imgs[$i]['type'];
	if(file_exists($img_b)){
	$img_b='
		<a rel="external" href="fd_page.php?date='.$date.'&type='.$img_b_type.'">
		<img  style = "width:100%" src = "'.$img_b.'"/>
		</a>';
	}
        $i++;
        $img_c = $imgs[$i]['src'];
	$img_c_type = $imgs[$i]['type'];
	if(file_exists($img_c)){
	$img_c='
		<a rel="external" href="fd_page.php?date='.$date.'&type='.$img_c_type.'">
		<img  style = "width:100%" src = "'.$img_c.'"/>
		</a>';
	}
        $i++;
        $img_d =  $imgs[$i]['src'];
	$img_d_type = $imgs[$i]['type'];
	if(file_exists($img_d)){
	$img_d='
		<a rel="external" href="fd_page.php?date='.$date.'&type='.$img_d_type.'">
		<img  style = "width:100%" src = "'.$img_d.'"/>
		</a>';
	}
        $row = '<div class = "ui-block-a">
		'.$img_a.'
                </div>
                <div class = "ui-block-b">
		'.$img_b.'
                </div>
                <div class = "ui-block-c">
		'.$img_c.'
                </div>
                <div class = "ui-block-d">
		'.$img_d.'
                </div>';
        $grid = $grid.$row;
}
$grid = $grid.'</div></div>';
$content = $content.$grid;
//end the solar images grid.

//start Activity charts section
$charts = '
	<h3>Activity Charts </h3>
	<div data-role="listview" data-inset="true">
		<li data-icon="false"><a rel= "external" href="chart_page.php?date='.$date.'&type=xrays">GOES - X-Ray</a> </li>
		<li data-icon="false"><a rel= "external" href="chart_page.php?date='.$date.'&type=electrons"> GOES - Electron</a> </li>
		<li data-icon="false"><a rel= "external" href="chart_page.php?date='.$date.'&type=protons"> GOES - Protons </a></li>
		<li data-icon="false"><a rel= "external" href="chart_page.php?date='.$date.'&type=plasma"> ACE - Plasma </a></li>
		<li data-icon="false"><a rel= "external" href="chart_page.php?date='.$date.'&type=bfield"> ACE - Magnetic Field </a></li>
		<li data-icon="false"><a rel= "external" href="chart_page.php?date='.$date.'&type=3day"> SDO/EVE - 3 Day </a></li>
		<li data-icon="false"><a rel= "external" href="chart_page.php?date='.$date.'&type=6hour"> SDO/EVE - 6 Hour </a></li>
	</div>
	';
$charts = $coll.$charts.$_div;
$content = $content.$charts;
//end sctivity charts
//$sp_groups =


// start sunspot groups section
$spots = get_all_sunspots($date);
$sp_groups = '<div class="ui-grid-b">
			<div class="ui-bar-d ui-block-a grid-text"><h3>NOAA</h3></div>
			<div class="ui-bar-d ui-block-b grid-text"><h3>Location</h3></div>
			<div class="ui-bar-d ui-block-c grid-text"><h3>Hale</h3></div>';
foreach ($spots as $spot) {
	        $h_type = str_replace('b','&#945',$spot['hale']);
                $h_type = str_replace('a','&#946',$h_type);
                $h_type = str_replace('g','&#947',$h_type);
                $h_type = str_replace('d','&#948',$h_type);
	$sp_groups = $sp_groups.'
			<a rel="external" href="ar_grid_page.php?date='.$date.'&region='.$spot['ar'].'" style="text-decoration:none">
			<div class="ui-bar-a ui-block-a grid-text"  ><p>'.$spot['ar'].'</p></div>
			<div class="ui-bar-a ui-block-b grid-text"  ><p>'.$spot['location'].'</p></div>
			<div class="ui-bar-a ui-block-c grid-text"  ><p>'.$h_type.'</p></div>
			</a>
			';
}
if(!count($spots)){
	$sp_groups = '<p class="grid-text" style="border:none"> No NOAA Regions. </p>';
}
$sp_groups = $coll.'<h3>Sunspot Groups</h3>'.$sp_groups.$_div.$_div;
$content = $content.$sp_groups;
//end sunspot groups section

//start Solar Flares section
$flares = get_all_flares($date);
$flare_list = get_flare_list($flares,$date,'TIME');
$sp_groups = $coll.'<h3>Solar Flares</h3>
			<div id="flare_section">'.$flare_list.$_div.$_div.$_div;
$content = $content.$sp_groups;

//start Flare Forecast section
$data = get_forecast_data($date);
$forecast = $coll.'
                <h3> Flare Forecasts </h3>
			<p style="text-align:center"> Region Flare Probabilities (%) </p>	
			<div class="ui-grid-d">
				<div class="ui-bar-d ui-block-a grid-text"><h3 class="forecast">NOAA</h3></div>
				<div class="ui-bar-d ui-block-b grid-text"><h3 class="forecast">McIntosh</h3></div>
				<div class="ui-bar-d ui-block-c grid-text"><h3 class="forecast">C</h3></div>
				<div class="ui-bar-d ui-block-c grid-text"><h3 class="forecast">M</h3></div>
				<div class="ui-bar-d ui-block-c grid-text"><h3 class="forecast">X</h3></div>';
foreach ($data as $datum) {
        $forecast = $forecast.'
				<a rel="external" href="ar_grid_page.php?date='.$date.'&region='.$datum['ar'].'" style="text-decoration:none">
				<div class="ui-bar-a ui-block-a grid-text"  ><p class="forecast">'.$datum['ar'].'</p></div>
				<div class="ui-bar-a ui-block-b grid-text"  ><p class="forecast">'.$datum['mac'].'</p></div>
				<div class="ui-bar-a ui-block-c grid-text"  ><p class="forecast">'.$datum['c'].'</p></div>
				<div class="ui-bar-a ui-block-d grid-text"  ><p class="forecast">'.$datum['m'].'</p></div>
				<div class="ui-bar-a ui-block-e grid-text"  ><p class="forecast">'.$datum['x'].'</p></div>
				</a>
                        ';
}
$forecast = $forecast.$_div.'
				<p style="margin-top: 30px"> NOTE: Values in brackets give the daily NOAA/SWPC forecast probabilities for the occurrence of one or more C-, M-, or X-class flares. </p>	
';
$content = $content.$forecast;

//end collsapsible set
$content = $content.'</div>';

//print the page. The type is ignored. 
print_jqm_page_template($content,$date,'shmi_maglc','','print_new_home.php');
?>

