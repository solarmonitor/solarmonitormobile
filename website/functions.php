<?
/**
* Functions file. 
*
* Contains most of the functions used by the solarmonitor.org mobile site. 
*
* @author Iain Billett 2011
*
*/



/**
* Finds the path to the latest file, where a file can be an image (FD, AR or thumb) or a text (meta) file.
* 
* @param string $date The file date
* @param string $instrument The instrument which made the image
* @param string $extension The file type. E.g. txt,png,jpg
* @param string $fd_ar The type of image -- 'fd' full disk, 'ar' active region or 'thumb' thumbnail.
* @param string $region_number  The AR number of the image. Default 00000
* @param string $search If set to 'all' returns all of the images in the folder for the date, not just the latest.
* @param string $thumb_type The size of thumbnail required. Default 'med'
* @return A string or array of strings containing a file path(s).
*
* @author Russ Hewitt 2004 & Iain Billett 2011
* 	note: Iain 2011 -- I have made extensive alterations to Russ's code, extending search capability. This function 
*	should really be replaced by a database search. There are other search functions as I realised I was using this to do tooo much.
*
*/
	function find_latest_file($date, $instrument, $filter, $extension, $fd_ar,$region_number="00000",$search="latest",$thumb_type="med")
	{
		include("./globals.php");
		
		//	find what folder the desired file should be in
		switch($extension)
		{
			case "txt":
				$folder = "meta";
				$instr = "";
				break;
			case "fts":
				$folder = "fits";
				$instr = $instrument . "/";
				break;
			case "png":
				$instr = $instrument . "/";
				$folder = "pngs";
				break;
		}
		
		//	initialize the latest variables
		$latest_file = "No File Found";
		$latest_time = strtotime("19800101 00:00:00");
		if($search=="all"){
			$all_files = array();
		}

		//	open the dir if it exists
		$dir = "${arm_data_path}data/$date/$folder/$instr";
		//modified Iain Billett 2011 - july
		//A dirty rotten hack to allow for this to return thumbnails I'll think of somthing more elegant later.
		if($fd_ar=='thmb'){
			$dir = "${arm_data_path}data/$date/$folder/$fd_ar/";
			switch ($thumb_type) {
				case 'full':
					return $dir.$instrument.'_'.$filter.'_thumb.png';
					break;
				
				default:
					return $dir.$instrument.'_'.$filter.'_thumb_small140.jpg';
					break;
			}
		}
		//return the arm_ar_summary for today
        	if($fd_ar=='ar' && $folder=='meta'){
            		$dir = "${arm_data_path}data/$date/$folder/arm_ar_summary_$date.txt";
            		if(file_exists($dir)){
                		return $dir;
            		}else{
                		return 'db error message';
           	 	}   
       		}
		if (is_dir($dir))
		{
			if ($dir_handle = opendir($dir))
			{
				//	loop through the files in the directory
				while(false !== ($file = readdir($dir_handle)))
				{
					if(($file != ".") && ($file != ".."))
					{
						//	if the folder is meta, the only files we should need start with map_coord
						if ($folder == "meta")
						{
							list($meta1, $rest) = split('[_.]', $file, 2);
							if ($meta1 != "forecast")
								list($meta2, $rest) = split('[_.]', $rest, 2);
						}
						else
							$rest = $file;
							
						//	so test to see if it is a map_coord
						//if(($folder == "meta") && ($meta1 != "map"))
						//	continue;
							
						//	get the instrument, filter, and ar or fd type
						list($file_instrument, $file_filter, $fd_ar_type, $rest) = split('[_.]', $rest, 4);
						
						//	if it is a fd and we want an fd, parse the rest of the filename
						if (($fd_ar_type == "fd") && ($fd_ar == "fd"))
						{
							list($file_date, $file_time, $rest) = split('[_.]', $rest, 3);	
						}
						//	if it is an ar and we want an ar parse the rest of the filename
						elseif (($fd_ar_type == "ar") && ($fd_ar == "ar"))
						{
							list($file_region, $file_date, $file_time, $rest) = split('[_.]', $rest, 4);
							//	go to next file if we dont get the region number we want
							if ($file_region != $region_number)
								continue;
						}
						//	if we dont get the type we want, move to next file
						else
						{
							continue;
						}
						
						//	if the instrument or filter dont match, move on.  this may need fixing after gsxi is correct
						if (($instrument != $file_instrument) || ($filter != $file_filter))
							continue;
						//Mod iain 2011 don't wan't small60.jpg image
						if(strstr($rest,'small'))
							continue;		
						//Iain 2011 Adding ability to return all files in todays folder
						if($search=="all"){
							$all_files[] = $dir.$file;
						}
						//	get the hour, min and sec
						$hh = substr($file_time,0,2);
						$mm = substr($file_time,2,2);
						$ss = substr($file_time,4,2);
						
						//	compare the times
						if($latest_time <= strtotime("$file_date $hh:$mm:$ss"))
						{
							$latest_time = strtotime("$file_date $hh:$mm:$ss");
							$latest_file = $file;
						//	if()
						}
					}
				}
			}
			closedir($dir_handle);
		}
		
		if($search=="latest"){
			return $dir.$latest_file;
		}else{
			return $all_files;
		}
	}

/**
* Returns all the thumbnails (60px square) for a given date.
*
* @param string $date The date.
* @return An array of file paths.
* @author Iain Billett.
*
*/
	function get_all_thumbs($date){
		include("globals.php");
		$imgs = array();
		foreach ($instrument_types as $value) {
			list($instrument,$filter) = explode('_',$value,2);
			if(file_exists(find_latest_file($date,$instrument,$filter,'png','thmb','','','small'))){
				$imgs[] = array('src'=> find_latest_file($date,$instrument,$filter,'png','thmb','','','small'),'type'=>$value);
			}
		}
		return $imgs;
	}
/**
* Returns a chart image file path.
*
* @param string $date The date.
* @param string $type The type of chart image. E.g. plasma or electrons. 
* @return string A file path.
* @author Iain Billett.
*/

	function get_chart($date,$type){
		include('globals.php');
		//list($instr, $chart) = explode('_',$type);
		$folder = $charts[$type]['folder'];
		$file = $charts[$type]['file'].'_'.$date.$charts[$type]['ext'];
		return "${arm_data_path}data/$date/pngs/$folder/$file";
		
	}
/**
* Returns a range of chart file paths centered around the given date. Dates in the 
* Future are ignored as, unfortunately, there is no data.
*
* @param string $date The date. 
* @param string $type The chart type.
* @param string $range The number of days either side of $date to return. E.g. If date =20110818 and range =2 then the range would be 20110816,20110817,20110818,20110819,201108120 assuming the actual date is >=20110820.
* @return Array An array of chart file paths.
* @author Iain Billett 2011.
*
*/
	function get_chart_range($date,$type,$range = 2){
		$charts = array();
		$year   = substr($date,0,4);
        	$month  = substr($date,4,2);
	        $day    = substr($date,6,2);
		for ($i = -$range; $i <= $range; $i++) {
			$date = date("Ymd",mktime(0,0,0,$month,$day+$i,$year ));
			if($date > date("Ymd",time())){
				return $charts;
			}
			$charts[] = get_chart($date,$type);
		}
		return $charts;
	}
//Comparison function for the sort by magnitude function (uasort)
	function cmp_magnitude($a,$b){
		$a = $a['mag_numeric'];
		$b = $b['mag_numeric'];
		if($a == $b){
			return 0;
		}elseif($a > $b){
			return -1;
		}else{
			return 1;
		}
	}
//Comparison function for the sort by time function (uasort)
	function cmp_time($a,$b){
		$a = $a['time'];
		$b = $b['time'];
		if($a == $b){
			return 0;
		}elseif($a > $b){
			return -1;
		}else{
			return 1;
		}
	}
/**
* Returns an 2D array with information on all the flares for a given date.
* Each flare is represented by an array with 'ar','mag' and 'time' keys for 
* NOAA number, MAgnitude and Time respectively. The returned array can be 
* sorted by time, magnitude or NOAA region. The default is NOAA.
* 
* @param string $date The date.
* @param string $sort How the result should be sorted, 'TIME','MAGNITUDE' or ''. 
* @return A 2D array with the first index numeric and the second key value.
* @author Iain Billett.
*/
	function get_all_flares($date,$sort='TIME',$ar=''){
		$data = find_latest_file($date, '','','txt','ar');
		$lines = file($data);
		$flares = array();
		foreach ($lines as $line) {
			unset($day);
			list($ar, , , , , , ,$flares_info)=explode(' ',$line,8);
			if(substr_count($flares_info,'http')){
				$flares_str = explode(' ',$flares_info);
				//var_dump($flares_str);
				foreach ($flares_str as $value) {
					if(!substr_count($value,'http') && $value!='/'){
						//NOTE: you can onlyhave one of C , M or X so this equates to a switch statement just more efficient.
						$order = 1*substr_count($value,'C')+10*substr_count($value,'M')+100*substr_count($value,'X');
						$mag_numeric = $order*(double)substr($value,1);
						$time = substr($value,5,5);
						$delta = $day+$date;
						$time = $delta.$time;
						$time = str_replace(':','',$time);
						
						$yesterday = isset($day);

						$flares[] = array('ar' => $ar, 'mag' => $value, 'mag_numeric' => $mag_numeric,'time'=>(int)$time,'yest'=>$yesterday );
					}
					if($value == '/' && !$sort){
						$flares[] = array('ar' => $ar,'mag' => 'Y');//make sure this can't cause a conflict
					}
					if($value == '/'){
						$day = -1;
					}
				}
			}
		}
		if($sort=='MAGNITUDE'){
			uasort($flares,'cmp_magnitude');
		}
		if($sort=='TIME'){
			uasort($flares,'cmp_time');
		}
		return $flares;// can extend to return more information
	}
/**
* Returns a 2D array with information on each of the NOAA regions for the date. The information returned is 
* NOAA region, location and Hale type accessible by the keys 'ar', 'location' and 'hale' respectively.
*
* @param string $date The date.
* @param string $ar   redundant TODO remove this?
* @return array A 2d array of strings
* @author Iain Billett 2011
*/
	function get_all_sunspots($date,$ar=''){
		$data = find_latest_file($date, '','','txt','ar');
		$lines = file($data);
		$spots = array();
		foreach ($lines as $line) {
			list($ar,$location, ,$hale, , , ,$flares_info)=explode(' ',$line,8);
			$spots[] = array('ar'=>$ar,'location'=>$location,'hale'=>$hale);//put mor einfo on flares here?	
		}
		return $spots;// can extend to return more information
	}
/**
* Returns an array of file paths to the NOAA region thumbnails for the given date and region.
*
* @param string $date The date.
* @param string $region The NOAA region.
* @return array An array of file paths ( strings ).
* @author Iain Billett 2011.
*/
	function get_ar_thumbs($date,$region){
		include('globals.php');
		$thumbs = array();
		$path = "${arm_data_path}data/$date/pngs/";
		foreach ($png_folders as $folder) {
			$dir = $path.$folder;
			if(is_dir($dir)){
				$handle = opendir($dir);
				while (false !== ($file = readdir($handle))) {
					if(substr_count($file,'ar_'.$region) && substr_count($file,'small')){
						$thumbs[substr($file,0,10)] = $file;
					}
				}
			}
		}
		return $thumbs;
	}
/**
* Returns an array with the file paths of all the available AR images for the given date, type and NOAA region.
*
* @param string $date The date.
* @param string $type The instrument type.
* @param string $region The NOAA active region number.
* @return string An array of file paths.
* @author Iain Billett 2011.
*
*/
	function get_all_ar_imgs($date,$type,$region){
		echo include('globals.php');
		//var_dump($instrument_groups);
		var_dump($arm_data_path);
		$imgs = array();
//		$path = "${arm_data_path}data/$date/pngs/";
		$path = "${arm_data_path}data/".$date."/pngs/";
		list($folder,$dontcare) = explode('_',$type);
		$dir = $path.$folder.'/';
		$handle = opendir($dir);
		if($handle){
			while (false !== ($file = readdir($handle))) {
				if(substr_count($file,$type.'_'.'ar_'.$region) && substr_count($file,'small')==0){
					$imgs[] = $dir.$file;
				}
			}
		}else{
		//	var_dump($dir);
		//	var_dump($handle);
		}
		if(!count($imgs)){
			return 'no imgs??';
		}
		return $imgs;
	}

/**
* Returns the time of the file path supplied (Only valid for fd and ar imgs)
*
* @param string $file A file path to an image.
* @return string The time as a string with UT appended.
* @author Iain Billett 2011
*/	
	function get_file_time($file){
		$time = preg_split('[_]',$file);
		$file_date = $time[count($time)-2];
		$time = $time[count($time)-1];
		$time = $file_date.' '.substr($time,0,2).':'.substr($time,2,2).':'.substr($time,4,2);
		return $time.' UT';
	}
	
	function get_forecast_data($date){
		include('globals.php');
		$path = "${arm_data_path}data/$date/meta/arm_forecast_".$date.".txt";
		$lines = file($path);
		$data = array();
		foreach ($lines as $line) {
			list($ar,$mac,$pc,$pm,$px) = explode(' ',$line);
			$data[] = array('ar' => $ar, 'mac' => $mac, 'c' => $pc, 'm' => $pm, 'x' => $px);	
		}
		return $data;
	}	
?>







