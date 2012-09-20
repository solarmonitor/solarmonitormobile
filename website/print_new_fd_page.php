<?php

function print_fd_page($date,$type){
include_once('functions.php');
include_once('print_home_functions.php');
include_once('jqm_page_template.php');
	list($inst, $filter) = explode('_',$type);
	$all_img_paths = find_latest_file($date,$inst,$filter,"png","fd",NULL,"all");
	//var_dump($all_img_paths);
//	$img_path= find_latest_file($date,$inst,$filter,"png","thmb",NULL,"latest","full");
	$img_path= find_latest_file($date,$inst,$filter,"png","fd");
	$latest_index=0;
	//could just assume lasest index is count(all imgs) -1 => last in array
	for ($i = 0; $i < count($all_img_paths); $i++) {
		if($img_path==$all_img_paths[$i])
			$latest_index = $i;
	}

if(file_exists($img_path)){                                                                                                                                            
          $content = '                                                                                                                                                        
                  <div id = "main_content">                                                                                                                                                  
                                  <img class = "main ui-corner-all" id="current_img" src="'.$img_path.'">
<!--				  <div class = "ui-grid-a">
					  <div class = "ui-block-a">
					  	<input type="button" value = "Earlier" data-theme="a"id="back_img_button"/>
					  </div>
					  <div class = "ui-block-b">
					  	<input type="button" value = "Later" id="forward_img_button"/>
					  </div>
				  </div> -->
		  <div>';
		  $content = $content.'<div style="text-align:center">';
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
					</div>';

  }else{                                                                                                                                                                 
          $content = $content.'<h3>There is no image available for this instrument. Please try another instrument.'.$img_path.'</h3>';
 }  
$content = $content.get_content_ar_list($date,$type);
print_jqm_page_template($content,$date,$type,$region,'fd_page.php');	
}

//print_fd_page('20110817','shmi_maglc');

?> 

