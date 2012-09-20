<?php
include("globals.php");
include("print_global_functions.php");
/*
if(isset($_COOKIE['myinstruments'])){
	$myinstruments=unserialize($_COOKIE['myinstruments']);
}*/
$myinstruments = array();
$myinstruments = unserialize(stripslashes($_COOKIE['myinstruments']));
$date=$_GET["date"];
$type=$_GET["type"];
$region=$_GET["region"];



print_html_head($date);//should i bother with a date
//border-radius: 0.6em;background-color:grey;padding: 3px
echo'	     <body>
	     <div data-role="page" data-theme="a"id="myInstrumentsPage">
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
	     <div data-role="content">
		<form action="settings_form.php" method="get" id="myinstrumentsform">
		<div data-role="fieldcontain">			
		<!-- form now submits onChange <input type="submit" value="Submit"/>-->
 		<fieldset data-role="controlgroup">
			<legend>Select the instruments you wish to appear in your "My Instruments" section:</legend><br>';
//var_dump($myinstruments);
$count =0;
foreach ($instrument_types as $inst) {
	if($myinstruments[$inst]){
//		$checked='data-theme="c"';
		$checked='checked="checked"';
	}else{
		$checked="";
	}
	echo	'<input type="checkbox" name="checkbox-'.$count.'" id="checkbox-'.$count.'" class="custom" value="'.$inst.'" '.$checked.'/>
		<label for="checkbox-'.$count.'">'.$instrument_names[$inst].'</label>';
	$count++;
}
//TODO fix submit button link
echo	    	'</fieldset>
		<!--<input type="submit" value="Submit" />-->
		</div>
	</form>
	</div>
	</div>
</body>
</html>
';
?>
