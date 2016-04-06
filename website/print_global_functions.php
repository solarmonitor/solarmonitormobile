<?
/**
* Print global functions contains most of the print functions in solarmonior.org mobile.
*
* @author Iain Billett 2011
*/



/**
* Prints the Html head of a page. All the external resources are added here , Jquery mobile and the solarmonitor specific javascript an css.
*
* @author Iain Billett
* @param string $date deprecated - is no longer required. TODO remove date param from usage.
*/
function print_html_head($date=''){
echo'
<html>
<head>
    <title>Solar Monitor</title>
    <link rel="stylesheet" href="css/solarMonitorMobile.css" />
    <link rel="stylesheet"  href="jquery.mobile.scrollview.css" /> 
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.css" />
    <script src="https://code.jquery.com/jquery-1.6.1.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.js"></script>
    <link href="css/jquery.scroller-1.0.1.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.scroller-1.0.1.min.js" type="text/javascript"></script>
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <script src="js/solarmonitor.js" type = "text/javascript"></script>
    <script src="js/settings.js" type = "text/javascript"></script>
</head>';
}
/**
* Prints the visiual header. This is the header/title section and then 2 nav bars one with the search buttons and the other with +- day/rotation buttons.
* @author Iain Billett.
* @param string $date The date of the page.
* @param string $type The type of the image. Default none (See: Manual on Type).
* @param string $region The NOAA region of the image. Default none.
* @param string $page The file name of the page. Default none.
*/
function print_content_header($date,$type="",$region="",$page=""){
        $year          = substr($date,0,4);
        $month         = substr($date,4,2);
        $day           = substr($date,6,2);
        $date_text     = date("d M Y",mktime(0,0,0,$month,$day,$year ));
	$next_day      = date("Ymd",mktime(0,0,0,$month,$day+1,$year ));
        $prev_day      = date("Ymd",mktime(0,0,0,$month,$day-1,$year ));
        $next_rotation = date("Ymd",mktime(0,0,0,$month,$day+27,$year));
        $prev_rotation = date("Ymd",mktime(0,0,0,$month,$day-27,$year));
	//the dame as $date just there to make the code more readable.
	$date_today    = date("Ymd",time());
	
	//need to keep and eye on this do i always go to home with type and region not set : likewise with fd is region always unset
	if($type){
		$base_page = "fd_page.php";
	}elseif($region && $type){
		$base_page = "ar_page.php";
	}else{
		$base_page = "home.php";
	}
	if($page){
		$base_page = $page;
	}
	echo'
	<div data-role="header" data-theme="a" style = "height:20%;"> 
	    <!-- <a rel="external" href="home.php" data-theme ="a">Home</a>--> 
	    <h3><a rel="external" href="home.php" style="color:white;text-decoration:none;" id="jqtest">SolarMonitor.org</a></h3> 
	    <a rel="external" href="settings_page.php?date='.$date.'&type='.$type.'&region='.$region.'" data-icon="gear" data-iconpos="notext" data-theme ="a"> </a> 
	    <a rel="external" data-rel="back" data-icon="refresh" data-iconpos="right" data-theme ="a">Back</a>
	    <div data-role="navbar">
		<ul>
			<li><div class="ui-btn ui-btn-up-a" style="padding:10px;border-top:1px solid grey" id="date_picker_alias">Date select</div></li>
			<li><div class="ui-btn ui-btn-up-a" style="padding:10px;border-top:1px solid grey" id="date_text">'.$date_text.'</div></li>
			<li><div class="ui-btn ui-btn-up-a" style="padding:10px;border-top:1px solid grey" id="ar_search">NOAA search</div></li>
		</ul>
	    </div>
	    <div data-role = "navbar" > 
		<ul>
			<li><a data-icon="back"    rel = "external" href="'.$base_page.'?date='.$prev_rotation.'&type='.$type.'&region='.$region.'" id="back_rotation"> '.'- 2&#960'.'</a></li>
			<li><a data-icon="arrow-l" rel = "external" href="'.$base_page.'?date='.$prev_day.'&type='.$type.'&region='.$region.'" id="back_day_button">-1 day</a></li>
			<li><a data-icon="arrow-d"    rel = "external" href="'.$base_page.'?date='.$date_today.'&type='.$type.'&region='.$region.'" id="today_button"> Today</a></li>
			<li><a data-icon="arrow-r" rel = "external" href="'.$base_page.'?date='.$next_day.'&type='.$type.'&region='.$region.'" id="forward_day_button">+1 day</a></li>
			<li><a data-icon="forward" rel = "external" href="'.$base_page.'?date='.$next_rotation.'&type='.$type.'&region='.$region.'" id="forward_rotation"> '.'+ 2&#960'.'</a></li>
		</ul>
	    </div>
	    <p style="display:none" id = "global_date">'.$date.'</p>
	    <p style="display:none" id = "global_type">'.$type.'</p>
	    <p style="display:none" id = "global_region">'.$region.'</p>
	    <p style="display:none" id = "global_page">'.$page.'</p>
	</div>
		<div style="display:none">
			<input class="ui-btn ui-btn-corner-all ui-btn-up-c" data-theme="c" style="display:none" id= "date_picker" value="'.$date.'"/>
		</div>
		<p id="date_alert" style="display:none;color:red;text-align:center;font-size:0.75em"></p>
'; 
}
/**
* Prints out a list of active regions (goes below full disk)
* 
* @param string $date The date.
* @param string $type The type - To ensure links go to correct type of image.
* @return void
* @author Iain Billett 2011.
*
*/
function print_content_ar_list($date,$type){
	print '
               <ul data-role = "listview" data-theme = "a" data-dividertheme = "a" data-inset = "true">';
	$ar_data = find_latest_file($date,'','','txt','ar');
	$lines = file($ar_data);
	$ar_count = count($lines);
	print '<li data-role="list-divider" data-theme="a" >Active Regions<span class = "ui-li-count">'.$ar_count.'</span></li>';
	foreach($lines as $line){
	    	$flare_count = substr_count($line,'http://');
	    	list($ar_number,$location_ns,$location_minutes,$h_type,$line) = explode(' ',$line,5);
		$h_type = str_replace('b','&#945',$h_type);
		$h_type = str_replace('a','&#946',$h_type);
		$h_type = str_replace('g','&#947',$h_type);
		$h_type = str_replace('d','&#948',$h_type);
		print '
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
	
}

/**
* OBSOLETE: Print date picker.
*
* Prints a hidden input which is manipulated in jquery/javascript to show the date picker.
* (See: notes on date picker)
*
* @author Iain Billett 2011.
*/

/*function print_date_picker($date){
	echo'	<div style="display:none">
			<input class="ui-btn ui-btn-corner-all ui-btn-up-c" data-theme="c" style="display:none" id= "date_picker" value="'.$date.'"/>
		</div>
	';
}*/

/**
* Prints the solarmonitor footer.
*
* @author Iain Billett.
*/
function print_content_footer(){
	echo '
	<div class="ui-bar-a" style="text-wrap:normal;padding:10px">
		<div id="footer_tcd_link" >
		<h6 style = "display:inline;margin-bottom:10px" > &copy Trinity College Dublin, Ireland. </h6>
		</div>
		<!-- AddThis Button BEGIN -->
		<div style="margin-top:10px"  class="addthis_toolbox addthis_default_style ">
		<a style="margin-right:5px" class="addthis_button_preferred_1"></a>
		<a style="margin-right:10px"class="addthis_button_preferred_2"></a>
		<!--
		<a class="addthis_button_google_plusone"></a>--><!--Doesnt work on mobile. Left out for this reason. 
		<a class="addthis_button_compact"></a>
		<a class="addthis_counter addthis_bubble_style"></a>
		-->
		<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=xa-4e527176710209c0"><img src="https://s7.addthis.com/static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0"/></a>
		</div>
		<script type="text/javascript" src="https://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e3bfbcb65434435"></script>
		<!-- AddThis Button END -->
	</div>
	<!-- Piwik 
	<script type="text/javascript">
		var pkBaseURL = (("https:" == document.location.protocol) ? "https://grian.phy.tcd.ie/stats/" : "http://grian.phy.tcd.ie/stats/");
		document.write(unescape("%3Cscript src=\'" + pkBaseURL + "piwik.js\' type=\'text/javascript\'%3E%3C/script%3E"));
		</script><script type="text/javascript">
		try {
		var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 2);
		piwikTracker.trackPageView();
		piwikTracker.enableLinkTracking();
		} catch( err ) {}
	</script> -->
	<noscript>
		<p>
			<img src="http://grian.phy.tcd.ie/stats/piwik.php?idsite=2" style="border:0" alt="" />
		</p>
	</noscript>
	<!-- End Piwik Tracking Code -->
	<p> <a rel="external" href="http://www.solarmonitor.org/index.php?desktop=1">Desktop version</a><p>

	';
}

//function graveyard DO NOT ENTER

/*
function print_date_picker($date){
	echo'	<div style="display:none">
			<input class="ui-btn ui-btn-corner-all ui-btn-up-c" data-theme="c" style="display:none" id= "date_picker" value="'.$date.'"/>
		</div>
	';
}


function make_section($title,$content){
	$element = '<div data-role ="collapsible">';
	$element = $element.$title.$content.'</div>';
	return $element;
}

function HTML_footer(){
$HTML =  '
<div class="ui-bar-a" style="text-wrap:normal;padding:10px">
        <div id="footer-tcd-link">
        <h6 style = "display:inline;margin-bottom:10px" > <!--&copy-->  Trinity College Dublin <br> Astrophysics </h6>
        <img style="display:inline" src="TCD_small_icon.ico"/>
        </div>
        <!-- AddThis Button BEGIN -->
        <div style="margin-top:10px"  class="addthis_toolbox addthis_default_style ">
        <a class="addthis_button_preferred_1"></a>
        <a class="addthis_button_preferred_2"></a>
        <a class="addthis_counter addthis_bubble_style"></a>
        <a class="addthis_button_google_plusone"></a>
        </div>
        <script type="text/javascript" src="https://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e3bfbcb65434435"></script>
        <!-- AddThis Button END -->
</div>
';
return $HTML;
}

function print_adv_search_form($page,$date,$type="",$region="00000"){
	include("globals.php");
	if(!$page){
		$page='home.php';
	}
	//build a selector menu html element to be displayed in the form when the user selects AR as the type
	$ar_data = find_latest_file($date,'','','txt','ar');
	$lines = file($ar_data);
	$ar_count = count($lines);
	$HTML_ar_selector =  "<div data-role='fieldcontain'style='display:none'id = 'ar_selector_block'>
				<label for='ar_selector' class='select'>Choose Active Region</label><br>
				<select data-native-menu='false' name='ar_selector' id='ar_selector'>";
	if($region!="00000"){
		$HTML_ar_selector= $HTML_ar_selector."<option data-placeholder='true'>".$region."</option>";
	}
	foreach($lines as $line){
	    	$flare_count = substr_count($line,'http://');
	    	list($ar_number,$location_ns,$location_minutes) = explode(' ',$line,4);
		$HTML_ar_selector =$HTML_ar_selector."<option value='".$ar_number."'> ".$ar_number."</option>";		
	}
	$HTML_ar_selector = $HTML_ar_selector.'		</select>
					</div>';	
	//end ar_selector element build

	//start making the type selector
	$HTML_instr_selector= "
		<div data-role='fieldcontain'style='display:none'id='type_selector_block'>
			<label for='type_selector' class='select'>Choose Instrument: </label><br>
			<select data-native-menu='false' name='type_selector' id='type_selector'>
				<option data-placeholder='true'>".$instrument_names[$type]."</option>
	";
	for ($i = 0; $i < count($instrument_groups); $i++) {
		 $current_instruments = array();
		 for ($j = 0; $j < count($instrument_groups[$i]); $j++) {
			for ($k = 0; $k < count($instrument_groups[$i][$j]); $k++) {
				list($instrument,$filter) = explode('_',$instrument_groups[$i][$j][$k]);
				if(file_exists(find_latest_file($date,$instrument,$filter,'png','fd'))){
					$current_instruments[] = $instrument_groups[$i][$j][$k];
					break;
				}
			}
		 }
		foreach ($current_instruments as $instr) {
			$HTML_instr_selector=$HTML_instr_selector."<option value='".$instr."'>".$instrument_names[$instr]."</option>";
		}
	}
	$HTML_instr_selector = $HTML_instr_selector."
			</select>
		</div>
	";
	
	
echo '
	<div data-role= "collapsible" data-collapsed="true"> 
	    <h3> Search </h3>
		<div class = "ui-block" data-theme="a">
		    <form action="'.$page.'" mode="get" style = "margin:auto" id="adv_search_form">
			<fieldset data-role = "fieldcontain" class = "ui-grid-a"> 
				<div class = "ui-block-a"><input type = "text" name = "date" id = "date_picker_old" style = "width:98%;margin:10px 1%;border-radius:0.6em" value ="'.$date.'" /></div>
				<div class = "ui-block-b"><button type = "submit" value = "Go" data-theme = "a"/></div> 
			</fieldset>     
			<fieldset id = "adv_search_form_page_field" data-role="controlgroup" data-type="horizontal" >
				<label for="r1">Home</label>
				<input type = "radio" name = "page_choice" id ="r1" value = "home.php"/>
				<label for="r2">Disk</label>
				<input type = "radio" name = "page_choice" id ="r2" value = "fd_page.php"/>
				<label for="r3">AR</label>
				<input type = "radio" name = "page_choice" id ="r3" value = "ar_page.php"/>
			</fieldset>
			<div id="type_selector_container"></div>
			<div id="ar_selector_container"></div>
			<!-- A dirty rotten hack : need to send the type of the img to the link page-->
			<input id="this_page" type="text" style="display:none" value="'.$page.'"/>
			<input id="this_type" type = "text" style = "display:none;" name ="default_type" value="'.$type.'"/>
			<input id="this_region" type = "text" style = "display:none;" name ="default_region" value="'.$region.'"/>  
		    </form> 
		</div>
    	</div>'; 
}
?>








