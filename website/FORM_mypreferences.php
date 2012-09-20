<?php

$preference = $_GET['preference'];
$mypreferences = array();
if(unserialize(stripslashes($_COOKIE['mypreferences'])) ){
	$mypreferences = unserialize(stripslashes($_COOKIE['mypreferences']));
}
switch ($preference) {
	case 'thumbs':
		if($mypreferences[$preference]){
			unset($mypreferences[$preference]);
		}else{
			$mypreferences[$preference]='Thumbnails';
		}
		break;
	default:
		break;
}
if(!setcookie('mypreferences',serialize($mypreferences),time()+31*86400)){
	echo 'failed';
}else{
	echo 'success';
	echo var_dump($mypreferences);
}
?>
