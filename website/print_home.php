<?php 

/*
$instrument_names = array("smdi_maglc" => "MDI Mag", "gong_maglc"=>"GONG Mag", "smdi_igram" => "MDI Cont", "bbso_halph" => "GHN H&alpha;", "seit_00171" => "EIT 171&Aring", "seit_00195" => "EIT 195&Aring", "hxrt_flter" => "XRT", "swap_00174" => "SWAP 174&Aring", "saia_00193" => "AIA 193&Aring","shmi_maglc" => "HMI Mag", "saia_04500" => "AIA 4500&Aring")
*/

function print_home($date){

include('globals.php');
include('functions.php');
include('print_global_functions.php');
if(time() - $_COOKIE["lastVisit"] > 14*86400){
	setcookie('myinstruments',$_COOKIE["myinstruments"],time + 31*86400);
}
setcookie('lastVisit',time(),31*86400);
//get my instruments cookie in array php array format
$myinstruments = unserialize(stripslashes($_COOKIE["myinstruments"]));
$mypreferences = unserialize(stripslashes($_COOKIE["mypreferences"]));


print_html_head($date);
print'
    <body>
    <div data-role="page" data-theme="a" id="list_view" data-add-back-btn="true">';
	print_content_header($date);
echo ' 
        <div data-role="content">';
	print_date_picker($date);
$fd_page = 'fd_page.php?date='.$date.'&type=';
if(count($myinstruments)){
	echo '<div data-role = "collapsible" data-collapsed="false">
	      <h3>My Instruments</h3>
	      <ul data-role="listview" data-inset="true" data-dividertheme="a">';
	foreach ($myinstruments as $inst) {
		list($instr,$filter) = explode('_',$inst);
		if(file_exists(find_latest_file($date,$instr,$filter,'png','thmb'))){
			print '<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.$inst.'">
			    <img src="'.find_latest_file($date,$instr,$filter,'png','thmb').'" title="sample 1" id = "thumb1"/>
			    <h3>'.$instrument_names[$inst].'</h3>
			    <p>'.get_file_time(find_latest_file($date,$instr,$filter,'png','fd')).'</p>
			</a></li>';
		}else{
			print '<li class = "ui-bar-d"><a rel = "external" href="home.php">
			    <img src="" title="sample 1" id = "'.$inst.'"/>
			    <h3>'.$instrument_names[$inst].' : No Image Today</h3>
			</a></li>';
		}
	}
	print '</ul>
	      </div>';//end collpasible section
}
	
echo'
	<input id="this_page" type="text" style="display:none" value="'.$page.'"/>
        <input id="this_type" type = "text" style = "display:none;" name ="default_type" value="'.$type.'"/>
        <input id="this_region" type = "text" style = "display:none;" name ="default_region" value="'.$region.'"/>';


$fd_page = 'fd_page.php?date='.$date.'&type=';

for ($i = 0; $i < count($instrument_groups); $i++) {
	 $current_instruments = array();
	 for ($j = 0; $j < count($instrument_groups[$i]); $j++) {
	 	for ($k = 0; $k < count($instrument_groups[$i][$j]); $k++) {
			list($instrument,$filter) = explode('_',$instrument_groups[$i][$j][$k]);
	 		if(file_exists(find_latest_file($date,$instrument,$filter,'png','fd'))){
				$current_instruments[] = $instrument_groups[$i][$j][$k];
				//echo $instrument_groups[$i][$j][$k];
				break;
			}
	 	}
	 }
	 if(count($myinstruments)){
		$main_collapsed_state = 'data-collapsed="true"';
	 }else{
		$main_collapsed_state= 'data-collapsed="false"';
	 }
	 // if there is data to display then loop through the positions and print
	 if(count($current_instruments)>1 || $i==0){
			switch ($i) {
				case 0:
					echo '<div data-role = "collapsible" '.$main_collapsed_state.'>
			       		      <h3>Main</h3>
					      <ul data-role="listview" data-inset="true" data-dividertheme="a">';
					break;
				case 1:
					echo '<div data-role = "collapsible" data-collapsed="true">
						<h3>Far Side</h3>
					      <ul data-role="listview" data-inset="true" data-dividertheme="a">';
					break;
				
				case 2:
					echo '<div data-role = "collapsible" data-collapsed="true">
						<h3>AIA  Short Wave</h3>
					      <ul data-role="listview" data-inset="true" data-dividertheme="a">';
					break;
				case 3:
					echo '<div data-role = "collapsible" data-collapsed="true">
						<h3>AIA Long Wave</h3>
					      <ul data-role="listview" data-inset="true" data-dividertheme="a">';
					break;
				default:
					echo '<div data-role = "collapsible" data-collapsed="true">
						<h3>Error</h3>
					      <ul data-role="listview" data-inset="true" data-dividertheme="a">';//this shouldn't happen except for errors
					break;
			}
			for ($j = 0; $j < count($current_instruments); $j++) {
				list($instr,$filter) = explode('_',$current_instruments[$j]);
				if($mypreferences['thumbs']){
					$img = find_latest_file($date,$instr,$filter,'png','thmb');
				}else{
					$img = '';
				}
				print '<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.$current_instruments[$j].'">
				    <img src="'.$img.'" title="sample 1" style="min-height:98%"/>
				    <h3>'.$instrument_names[$current_instruments[$j]].'</h3>
				    <p>'.get_file_time(find_latest_file($date,$instr,$filter,'png','fd')).'</p>
				</a></li>';
			 }
			 print '</ul>
			 	</div>';//end collpasible section
	 }
}

		


print '
        <div id="footer" data-role="footer" data-position="fixed" data-id = "footer">
            <h1>&copy; Copyright Info or Site URL</h1>
        </div>
    </div>';
}
print_home('20110805');

/*
function print_home_stable($date){
include('globals.php');
include('functions.php');
//$date = $date_today;
print'<html>
<head>
    <title>phoneGap html</title>
    <link rel="stylesheet" href="css/solarMonitorMobile.css" />
    <!--  <link rel="stylesheet" href="https://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" /> 
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>  
     -->
     <link rel="stylesheet"  href="jquery.mobile.scrollview.css" /> 
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.css" />
    <script src="https://code.jquery.com/jquery-1.6.1.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.js"></script>
    <link href="css/jquery.scroller-1.0.1.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.scroller-1.0.1.min.js" type="text/javascript"></script>
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#date_picker").scroller();
            $("#date_picker").scroller({
                dateFormat : "yymmdd",
                setText : "Ok"
            });
            /*$("#date_picker").change( function (){
                $("#date_form").submit();
            });	
	});
    </script>
</head>
<body>
    <div data-role="page" data-theme="a" id="list_view" data-add-back-btn="true">
        <div data-role="header" data-theme="a" style = "height:20%;">
            <h1>Solar Monitor</h1>
            <div data-role = "navbar"> 
                <ul>
                    <li><a rel = "external" href="home.php?date='.(intval($date)-1).'"> '.(intval($date)-1).'</a></li>
		    <!--<li>
			<form id ="date_form" data-ajax = "false" action = "home.php" method = "get">
				<input type = "text" name = "date" id = "date_picker" style = "text-align:center;width:90%;margin-left:5%;margin-right:5%;"/>
			</form>
		    </li>-->
                    <li><a rel = "external" href="home.php?date='.date("Ymd",time()).'"> Today </a></li>
                    <li><a rel = "external" href="home.php?date='.(intval($date)+1).'"> '.(intval($date)+1).'</a></li>
                </ul>
            </div>
        </div>
        <div data-role="content">
	    <div data-role= "collapsible" data-collapsed="true">
	    <h3> Change Date</h3>
	    <form action = "home.php" type = "get" style = "margin:auto">
	    	<fieldset data-role = "fieldcontain" class = "ui-grid-a">
			<div class = "ui-block-a"><input type = "text" name = "date" id = "date_picker" style = "width:98%;margin:10px 1%;border-radius:0.6em"/></div>
			<div class = "ui-block-b"><button type = "submit" value = "Go" data-theme = "a"/></div>
		</fieldset>	
	    </form>
	    </div>
            <ul data-role="listview" data-inset="true" data-dividertheme="a">';
//print'      	<li data-role = "list-divider" >Instruments</li>';

//this needs to be sorted out. approach is right but it needs to use more than one collapsible.
$fd_page = 'fd_page.php?date='.$date.'&type=';

$img_path = find_latest_file($date,'shmi','maglc','png','thmb');
if(file_exists($img_path)){
	print('<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.'shmi_maglc'.'">
            <img src="'.$img_path.'" title="sample 1" id = "thumb1"/>
            <h3>'.$instrument_names['shmi_maglc'].'</h3>
            <p>'.get_file_time(find_latest_file($date,'shmi','maglc','png','fd')).'</p>
        </a></li>');
}
$img_path = find_latest_file($date,'saia','04500','png','thmb');
if(file_exists($img_path)){
	print('
		<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.'saia_04500'.'">
            <img src="'.$img_path.'" title="sample 1" id = "thumb1"/>
            <h3>'.$instrument_names['saia_04500'].'</h3>
            <p>'.get_file_time(find_latest_file($date,'saia','04500','png','fd')).'</p>
        </a></li>');
}
$img_path = find_latest_file($date,'bbso','halph','png','thmb');
if(file_exists($img_path)){
	print('
		<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.'bbso_halph'.'">
            <img src="'.$img_path.'" title="sample 1" id = "thumb1"/>
            <h3>'.$instrument_names['bbso_halph'].'</h3>
            <p>'.get_file_time(find_latest_file($date,'bbso','halph','png','fd')).'</p>
        </a></li>
	');
}
$img_path = find_latest_file($date,'swap','00174','png','thmb');
if(file_exists($img_path)){
	print('
		<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.'swap_00174'.'">
            <img src="'.$img_path.'" title="sample 1" id = "thumb1"/>
            <h3>'.$instrument_names['swap_00174'].'</h3>
            <p>'.get_file_time(find_latest_file($date,'swap','00174','png','fd')).'</p>
        </a></li>');
}
$img_path = find_latest_file($date,'saia','00193','png','thmb');
if(file_exists($img_path)){
	print('
		<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.'saia_00193'.'">
            <img src="'.$img_path.'" title="sample 1" id = "thumb1"/>
            <h3>'.$instrument_names['saia_00193'].'</h3>
            <p>'.get_file_time(find_latest_file($date,'saia','00193','png','fd')).'</p>
        </a></li>');
}
$img_path = find_latest_file($date,'hxrt','flter','png','thmb');
if(file_exists($img_path)){
	print('
		<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.'hxrt_flter'.'">
            <img src="'.$img_path.'" title="sample 1" id = "thumb1"/>
            <h3>'.$instrument_names['hxrt_flter'].'</h3>
            <p>'.get_file_time(find_latest_file($date,'hxrt','flter','png','fd')).'</p>
        </a></li>');
}


print '  	</div> <!-- end collapsible??-->
            </ul>
        </div>
        <div data-role="footer" data-position="fixed" data-id = "footer">
            <h1>&copy; Copyright Info or Site URL</h1>
        </div>
    </div>';
}


function print_home_stable_2($date){
include('globals.php');
include('functions.php');
//$date = $date_today;
print'<html>
<head>
    <title>phoneGap html</title>
    <link rel="stylesheet" href="css/solarMonitorMobile.css" />
    <!--  <link rel="stylesheet" href="https://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" /> 
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>  
     -->
     <link rel="stylesheet"  href="jquery.mobile.scrollview.css" /> 
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.css" />
    <script src="https://code.jquery.com/jquery-1.6.1.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.js"></script>
    <link href="css/jquery.scroller-1.0.1.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.scroller-1.0.1.min.js" type="text/javascript"></script>
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#date_picker").scroller();
            $("#date_picker").scroller({
                dateFormat : "yymmdd",
                setText : "Ok"
            });
            /*$("#date_picker").change( function (){
                $("#date_form").submit();
            });	
	});
    </script>
</head>
<body>
    <div data-role="page" data-theme="a" id="list_view" data-add-back-btn="true">
        <div data-role="header" data-theme="a" style = "height:20%;">
            <h1>Solar Monitor</h1>
            <div data-role = "navbar"> 
                <ul>
                    <li><a rel = "external" href="home.php?date='.(intval($date)-1).'"> '.(intval($date)-1).'</a></li>
		    <!--<li>
			<form id ="date_form" data-ajax = "false" action = "home.php" method = "get">
				<input type = "text" name = "date" id = "date_picker" style = "text-align:center;width:90%;margin-left:5%;margin-right:5%;"/>
			</form>
		    </li>-->
                    <li><a rel = "external" href="home.php?date='.date("Ymd",time()).'"> Today </a></li>
                    <li><a rel = "external" href="home.php?date='.(intval($date)+1).'"> '.(intval($date)+1).'</a></li>
                </ul>
            </div>
        </div>
        <div data-role="content">
	    <div data-role= "collapsible" data-collapsed="true">
	    <h3> Change Date</h3>
	    <form action = "home.php" type = "get" style = "margin:auto">
	    	<fieldset data-role = "fieldcontain" class = "ui-grid-a">
			<div class = "ui-block-a"><input type = "text" name = "date" id = "date_picker" style = "width:98%;margin:10px 1%;border-radius:0.6em"/></div>
			<div class = "ui-block-b"><button type = "submit" value = "Go" data-theme = "a"/></div>
		</fieldset>	
	    </form>
	    </div>
            <ul data-role="listview" data-inset="true" data-dividertheme="a">';
//print'      	<li data-role = "list-divider" >Instruments</li>';

//this needs to be sorted out. approach is right but it needs to use more than one collapsible.
$fd_page = 'fd_page.php?date='.$date.'&type=';


for ($i = 0; $i < count($instrument_types); $i++) {
	list($instr,$filter) = explode('_',$instrument_types[$i]);
	if (file_exists($img_path=find_latest_file($date,$instr,$filter,'png','thmb'))) {
		print '<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.$instrument_types[$i].'">
		    <img src="'.$img_path.'" title="sample 1" id = "thumb1"/>
		    <h3>'.$instrument_names[$instrument_types[$i]].'</h3>
		    <p>'.get_file_time(find_latest_file($date,$instr,$filter,'png','fd')).'</p>
		</a></li>';
	}
}

print '
            </ul>
        </div>
        <div data-role="footer" data-position="fixed" data-id = "footer">
            <h1>&copy; Copyright Info or Site URL</h1>
        </div>
    </div>';
}

/*
for ($i = 0; $i < count($instrument_groups["main"]); $i++) {
	for()
	list($instr,$filter) = explode('_',$instrument_groups["main"][$i]);
	if (file_exists($img_path=find_latest_file($date,$instr,$filter,'png','thmb'))) {
		print '<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.$instrument_types[$i].'">
		    <img src="'.$img_path.'" title="sample 1" id = "thumb1"/>
		    <h3>'.$instrument_names[$instrument_types[$i]].'</h3>
		    <p>'.get_file_time(find_latest_file($date,$instr,$filter,'png','fd')).'</p>
		</a></li>';
	}
}*/
/*
$img_path = find_latest_file($date,'shmi','maglc','png','thmb');
if(file_exists($img_path)){
	print('<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.'shmi_maglc'.'">
            <img src="'.$img_path.'" title="sample 1" id = "thumb1"/>
            <h3>'.$instrument_names['shmi_maglc'].'</h3>
            <p>'.get_file_time(find_latest_file($date,'shmi','maglc','png','fd')).'</p>
        </a></li>);
}
$img_path = find_latest_file($date,'saia','04500','png','thmb');
if(file_exists($img_path)){
	print('
		<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.'saia_04500'.'">
            <img src="'.$img_path.'" title="sample 1" id = "thumb1"/>
            <h3>'.$instrument_names['saia_04500'].'</h3>
            <p>'.get_file_time(find_latest_file($date,'saia','04500','png','fd')).'</p>
        </a></li>');
}
$img_path = find_latest_file($date,'bbso','halph','png','thmb');
if(file_exists($img_path)){
	print('
		<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.'bbso_halph'.'">
            <img src="'.$img_path.'" title="sample 1" id = "thumb1"/>
            <h3>'.$instrument_names['bbso_halph'].'</h3>
            <p>'.get_file_time(find_latest_file($date,'bbso','halph','png','fd')).'</p>
        </a></li>
	');
}
$img_path = find_latest_file($date,'swap','00174','png','thmb');
if(file_exists($img_path)){
	print('
		<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.'swap_00174'.'">
            <img src="'.$img_path.'" title="sample 1" id = "thumb1"/>
            <h3>'.$instrument_names['swap_00174'].'</h3>
            <p>'.get_file_time(find_latest_file($date,'swap','00174','png','fd')).'</p>
        </a></li>');
}
$img_path = find_latest_file($date,'saia','00193','png','thmb');
if(file_exists($img_path)){
	print('
		<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.'saia_00193'.'">
            <img src="'.$img_path.'" title="sample 1" id = "thumb1"/>
            <h3>'.$instrument_names['saia_00193'].'</h3>
            <p>'.get_file_time(find_latest_file($date,'saia','00193','png','fd')).'</p>
        </a></li>');
}
$img_path = find_latest_file($date,'hxrt','flter','png','thmb');
if(file_exists($img_path)){
	print('
		<li class = "ui-bar-d"><a rel = "external" href="'.$fd_page.'hxrt_flter'.'">
            <img src="'.$img_path.'" title="sample 1" id = "thumb1"/>
            <h3>'.$instrument_names['hxrt_flter'].'</h3>
            <p>'.get_file_time(find_latest_file($date,'hxrt','flter','png','fd')).'</p>
        </a></li>');
}*/

?>



