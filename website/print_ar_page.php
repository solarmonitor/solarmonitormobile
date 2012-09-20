

<?php 
function print_ar_page($date,$type='',$region){
	include_once('functions.php');
	include_once('globals.php');
	include_once('print_global_functions.php');
	list($inst, $filter) = explode('_',$type);
	$img_path= find_latest_file($date,$inst,$filter,"png","ar",$region);
	if(!$type){
		foreach ($instrument_groups[0][0] as $mType) {
			list($instr,$filter) = explode('_',$mType);
			if(file_exists(find_latest_file($date,$instr,$filter,"png","ar",$region))){
				$img_path = find_latest_file($date,$instr,$filter,"png","ar",$region);
				echo '<!-- -->';
				$type = $mType;
				break;
			}
		}
	}
print_html_head($date);
print '<body> 
    <div data-role="page" data-theme="a" id="list_view"> ';
	print_content_header($date,$type,$region,'ar_page.php');
echo '  <div data-role="content">';
//	<input data-theme="c"style="margin: 0% 0%;width:100%;text-align:center" id= "date_picker" value="'.$date.'"/>';
	print_date_picker($date);
//	print_adv_search_form('ar_page.php',$date,$type,$region);
echo'
        <input id="this_page" type="text" style="display:none" value="'.$page.'"/>
        <input id="this_type" type = "text" style = "display:none;" name ="default_type" value="'.$type.'"/>
        <input id="this_region" type = "text" style = "display:none;" name ="default_region" value="'.$region.'"/>';
	
if(file_exists($img_path)){
	print ' 
		<div>
			<img class = "main ui-corner-all" id="current_img" src="'.$img_path.'">
			<a data-role="button" href = "fd_page.php?date='.$date.'&type='.$type.'"> Full Disk</a>

	        </div>';
}else{
	print '<h3>There is no image available of the active region for this instrument, please try another.</h3>';
}
print_content_ar_list($date,$type);
//for the fullscreen below need to edit the button js such that this img source is updated too. also should have different id...
print '
	        </div>
	    </div>
</body>
</html>	 
	';
}


?>
