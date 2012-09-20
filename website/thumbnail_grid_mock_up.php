<?php
include("globals.php");
include("jqm_page_template.php");
$date = $_GET["date"];
$type = $_GET["type"];
$region = $_GET["region"];
$date = date("Ymd",time());
$url = '/data/20110726/pngs/thmb/';
$content = '
	<div class="ui-grid-c">';
for ($i = 0; $i < count($instrument_types); $i++) {
	$img_a = $url.$instrument_types[$i].'_thumb_small60.jpg';
	$i++;
	$img_b = $url.$instrument_types[$i].'_thumb_small60.jpg';
	$i++;
	$img_c = $url.$instrument_types[$i].'_thumb_small60.jpg';
	$i++;
	$img_d =  $url.$instrument_types[$i].'_thumb_small60.jpg';
	$row = '<div class = "ui-block-a">
			<img style = "width:100%" src = "'.$img_a.'"/>
		</div>
		<div class = "ui-block-b">
			<img  style = "width:100%" src = "'.$img_b.'"/>
		</div>
		<div class = "ui-block-c">
			<img  style = "width:100%" src = "'.$img_c.'"/>
		</div>
		<div class = "ui-block-c">
			<img  style = "width:100%" src = "'.$img_d.'"/>
		</div>';
	$content = $content.$row;
}
$content = $content.'</div>';

print_jqm_page_template($content,$date,$type,$region,'thumbnail_grid_mock_up.php');
?>
