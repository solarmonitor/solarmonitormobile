
<?php
include("globals.php");
include("jqm_page_template.php");
include('functions.php');
if(time() - $_COOKIE["lastVisit"] > 14*86400){
        setcookie('myinstruments',$_COOKIE["myinstruments"],time + 31*86400);
}
setcookie('lastVisit',time(),31*86400);
//get my instruments cookie in array php array format
$myinstruments = unserialize(stripslashes($_COOKIE["myinstruments"]));

if(!$date = $_GET["date"]){
	$date = date("Ymd",time());
}

$url = '/data/20110726/pngs/thmb/';
$coll = '<div data-role="collapsible" data-collapsed="true">';
$_div = '</div>';
$imgs = get_all_thumbs($date);
$fd_page = 'fd_page.php?date='.$data.'&type=';
//$content = $content.'<!-- my instrs '.isset($_COOKIE['myinstruments']).': var dump '.var_dump($myinstruments).' length '.count($myinstruments).'  -->';
if(isset($_COOKIE['myinstruments'])){:Q

        $myinstruments_html= $myinstruments_html.'<div data-role = "collapsible" data-collapsed="false">
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

$grid = '<div data-role="collapsible" data-collapsed="true"> 
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

$charts = '
	<h3> Charts </h3>
	<div data-role="listview" data-inset="true">
		<li><a rel= "external" href="chart_page.php?date='.$date.'&type=xrays">GOES - X-Ray</a> </li>
		<li><a rel= "external" href="chart_page.php?date='.$date.'&type=electrons"> GOES - Electron</a> </li>
		<li><a rel= "external" href="chart_page.php?date='.$date.'&type=protons"> GOES - Protons </a></li>
		<li><a rel= "external" href="chart_page.php?date='.$date.'&type=plasma"> Ace - Plasma </a></li>
		<li><a rel= "external" href="chart_page.php?date='.$date.'&type=bfield"> Ace - B Field </a></li>
		<li><a rel= "external" href="chart_page.php?date='.$date.'&type=3day"> SDO/EVE - 3 Day </a></li>
		<li><a rel= "external" href="chart_page.php?date='.$date.'&type=6hour"> SDO/EVE - 6 Hour </a></li>
	</div>
	';
$charts = $coll.$charts.$_div;
$content = $content.$charts;

$sp_groups =
 
$spots = get_all_sunspots($date);
//var_dump($flares);
$sp_groups = '<div class="ui-grid-b">
			<div class="ui-bar-d ui-block-a grid-text"><h3>NOAA</h3></div>
			<div class="ui-bar-d ui-block-b grid-text"><h3>Location</h3></div>
			<div class="ui-bar-d ui-block-c grid-text"><h3>hale</h3></div>';
foreach ($spots as $spot) {
	        $h_type = str_replace('b','&#945',$spot['hale']);
                $h_type = str_replace('a','&#946',$h_type);
                $h_type = str_replace('g','&#947',$h_type);
                $h_type = str_replace('d','&#948',$h_type);
	$sp_groups = $sp_groups.'
			<div class="ui-bar-a ui-block-a grid-text"  ><p>'.$spot['ar'].'</p></div>
			<div class="ui-bar-a ui-block-b grid-text"  ><p>'.$spot['location'].'</p></div>
			<div class="ui-bar-a ui-block-c grid-text"  ><p>'.$h_type.'</p></div>';
}
$sp_groups = $coll.'<h3>Sunspot Groups</h3>'.$sp_groups.$_div.$_div;
$content = $content.$sp_groups;

$flares = get_all_flares($date);
//var_dump($flares);
$flare_list = '<div class="ui-grid-b">
			<div class="ui-bar-d ui-block-a grid-text"><h3>Mag</h3></div>
			<div class="ui-bar-d ui-block-b grid-text"><h3>Time</h3></div>
			<div class="ui-bar-d ui-block-c grid-text"><h3>NOAA</h3></div>';
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
		case 'Y':
			$mag = 'Previous';
			$time = 'Day';
			$mag_style = 'style=""';
			break;
		default : 
			$mag_style='style=""';
			break;
	}
	$flare_list = $flare_list.'
			<div class="ui-bar-a ui-block-a grid-text" '.$mag_style.' ><p>'.$mag.'</p></div>
			<div class="ui-bar-a ui-block-b grid-text"  ><p>'.$time.'</p></div>
			<div class="ui-bar-a ui-block-c grid-text"  ><p>'.$flare['ar'].'</p></div>';
}
$flare_list = $flare_list.$_div;
$sp_groups = $coll.'<h3>Flares</h3>'.$flare_list.$div;
$content = $content.$sp_groups;

print_jqm_page_template($content,$date,'shmi_maglc','','print_new_home.php');
?>
