<?php
//include("print_global_functions.php");
//$HTML = HTML_ar_selector("20110707");
//echo 'This is response.php. You asked for '.$_REQUEST["func"];//.$HTML;
if($_REQUEST["func"]=="HTML_ar_selector"){
//	echo '<p> This is the html requested : HTML_ar_selector </p>';
	respond("HTML_ar_selector");
}else{
	echo '<p> NOT FOUND </p>';
}

function respond($req){
	echo '<label for="sel"> This is the request made : '.$req.'</label><br>
		<select id="sel">
			<option> one </option>
		</select>';
//	echo HTML_selector();
}
?>
