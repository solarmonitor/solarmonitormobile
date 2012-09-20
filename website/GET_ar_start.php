<?php

class test extends SQLite3{
	function __construct(){
		$this->open('../data/ar_db.sqlite');
	}
}
$region = $_GET['region'];
$var = new test();
$result= $var->query('SELECT date FROM regions WHERE number="'.$region.'"');
$date =  $result->fetchArray();
$date = $date['date'];
if($result){
	echo $date;
}else{
	echo $region;
}
?>
