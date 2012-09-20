<?php
include("functions.php");
$type = $_REQUEST["type"];
$date = $_REQUEST["date"];
$img_path = $_REQUEST["pos"];
$dir = $_REQUEST["dir"];
if($dir=="back"){
	$delta = -1;
}elseif($dir =="forward"){
	$delta = 1;
}

list($inst, $filter) = explode('_',$type);
$all_img_paths = find_latest_file($date,$inst,$filter,"png","fd",NULL,"all");
$latest_index=0;
for ($i = 0; $i < count($all_img_paths); $i++) {
	if($img_path==$all_img_paths[$i])
		$latest_index = $i; 
}
$num_imgs = count($all_img_paths);
$index = ($latest_index+$delta);//%$num_imgs;
if($index < 0){
	//switch these images if you want the images to circulate : with index=0 you stop at the oldest image without you go to the newest
//	$index = $num_imgs-1;
	$index = 0;
}
if($index >= $num_imgs){
	//likewise if you want the later button to stop at the latest image rather than loop back to ealiest. To loop back remove these lines
	$index= $num_imgs-1;
}
$img_path = $all_img_paths[$index];
if($img_path){
	echo $img_path;//.'input index : '.$latest_index.' delta : '.$delta.' num : '.$num_imgs.' index returned : '.(($latest_index+$delta)%$num_imgs);
}else{
	echo 'not_found';
}
?>
