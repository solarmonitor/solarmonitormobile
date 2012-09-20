<?php
$mypreferences = array();
$mypreferences = unserialize(stripslashes($_COOKIE['mypreferences']));
include("jqm_page_template.php");
include("globals.php");
$date = $_GET["date"];
$type = $_GET["type"];
$region = $_GET["region"];

$header = '
	<div data-role="header" data-theme="a"> 
		<a rel="external" href="home.php?date='.$date.'" data-theme ="a">Home</a> 
		<h1 style="padding:5px"><a rel="external" href="home.php" style="color:white;text-decoration:none;" id="jqtest">SolarMonitor.org</a></h1> 
		<a rel="external" data-rel="back" data-icon="gear" data-iconpos="right" data-theme ="a">Back</a>
		<div data-role="navbar">
			<ul>
				<li><a rel="external" href="settings_page.php">My Instruments </a></li>
				<li><a rel="external" href="settings_page_2.php">My Preferences</a></li>
			</ul>
		</div>
	</div>
';


/*Make the page content - A form which modifies the mypreferences cookie array*/
$content='
<form action="">
	<div data-role="fieldcontain">
		<fieldset data-role="controlgroup">
		<legend> Site Settings : </legend>
';

$count =0;
 foreach ($site_settings as $key => $value) { 
         if($mypreferences[$key]){ 
                 $checked='checked="checked"';
         }else{
                 $checked="";
         }
         $content = $content.'<label for="preference-'.$count.'">'.$value.'</label>
	 			<input type="checkbox" name="preference-'.$count.'" id="preference-'.$count.'" class="custom" value="'.$key.'" '.$checked.'/>
                 ';
         $count++;
 }
$content = $content.'
		</fieldset>
		</div>
	</form>
';

print_jqm_page_template($content,$date,$type,$region,'Site Settings',$header);

?>
