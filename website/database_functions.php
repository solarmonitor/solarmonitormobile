<?php
class test extends SQLite3{
function __construct(){
	if(file_exists('/data')){
	//if(file_exists('../../ar_db.sqlite')){
		echo 'File exists<br>';
	}else{
		echo 'Database not found<br>';
	}
	$this->open('/data/ar_db.sqlite');
	}
}
$region = '11250';
$var = new test();
$result= $var->query('SELECT date FROM regions WHERE number='.$region);
$date =  $result->fetchArray();
echo $date["date"];
?>
