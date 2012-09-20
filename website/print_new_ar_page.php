<?php 
function print_ar_page($date,$type='',$region){
	//include_once('globals.php');
	include('functions.php');
	include('print_home_functions.php');
	include('jqm_page_template.php');
	list($inst, $filter) = explode('_',$type);
	$img_path= find_latest_file($date,$inst,$filter,"png","ar",$region);
//	$all_img_paths = get_all_ar_imgs($date,$type,$region);
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
	
if(file_exists($img_path)){
	$content = $content.' 
		<div>
			<img class = "main ui-corner-all" id="current_img" src="'.$img_path.'">
	        </div>';
/*		$content = $content.'<div style="text-align:center">';
                $content = $content.'<div class="carousel_buttons" id="fd_ar_carousel">';
		foreach ($all_img_paths as $key => $path) {
			if($path == $img_path){
				$highlight = 'class="highlight"';
			}else{
				$highlight = ''; 
			}   
			//$content = $content.'<div id="img'.$key.'" '.$highlight.'><div></div></div>';
			$content = $content.'<div id="'.$path.'" '.$highlight.'><div></div></div>';
		}   
			$content = $content.'</div>
						</div>
				<br>
				<a data-role="button" href = "fd_page.php?date='.$date.'&type='.$type.'"> Full Disk</a>
			';
*/
}else{
	$content = $content.'<h3>There is no image available of the active region for this instrument, please try another.</h3>';
}
$content = $content.get_content_ar_list($date,$type);
//for the fullscreen below need to edit the button js such that this img source is updated too. also should have different id...
print_jqm_page_template($content,$date,$type,$region,'ar_page.php');
}


?>
