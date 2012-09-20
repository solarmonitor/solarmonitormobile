<?php
function print_dashboard($date){


//refresh my instruments cookie if last visit was more than 2 weeks ago could just do it every time...?
if(time() - $_COOKIE["lastVisit"] > 14*86400){
	setcookie('myinstruments',$_COOKIE["myinstruments"],time + 31*86400);
}
setcookie('lastVisit',time(),31*86400);
//get my instruments cookie in array php array format
$myinstruments = unserialize(stripslashes($_COOKIE["myinstruments"]));

include('globals.php');
include('functions.php');
include('print_global_functions.php');


print_html_head($date);
print'
    <body>
    <div data-role="page" data-theme="a" id="list_view" data-add-back-btn="true">';
	print_content_header($date);
echo ' 
        <div data-role="content">
		<div class="ui-grid-a">';
	for ($i = 0; $i < count($myinstruments)/2; $i++) {
		$inst = $myinstruments[$i];
		list($inst,$filter) = explode('_',$inst);
		echo '<div class="ui-block-a">'.$myinstruments[$i].'<img src="'.find_latest_file($date,$inst,$filter,'png','thmb').'"/></div>';
		$inst = $myinstruments[$i+1];
		list($inst,$filter) = explode('_',$inst);
		echo '<div class="ui-block-b">'.$myinstruments[$i+1].'<img src="'.find_latest_file($date,$inst,$filter,'png','thmb').'"/></div>';
	}
echo'		</div>
	</div>
    </div>
    </body>
<html>';


}
?>



