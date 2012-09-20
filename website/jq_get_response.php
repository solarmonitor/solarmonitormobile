<?php
include('functions.php');
//Returns a HTML instrument select
function HTML_instrument_selector($date){
	include('globals.php');
        $HTML_instr_selector= "
                        <label for='type_selector' class='select'>Choose Instrument: </label><br>
                        <select data-native-menu='false' name='type' id='type_selector'>
        ";
	$first = true;
	foreach ($instrument_types as $current) {
		list($instr,$filter) = explode('_',$current);
		if(file_exists(find_latest_file($date,$instr,$filter,'png','fd'))){
			if($first){
				$HTML_instr_selector=$HTML_instr_selector."<option data-placeholder='true'value='".$current."'>".$instrument_names[$current]."</option>";
				$first=false;
				continue;
			}
			$HTML_instr_selector = $HTML_instr_selector."<option value='".$current."'>".$instrument_names[$current]."</option>";
		}
	}
        $HTML_instr_selector = $HTML_instr_selector."
                        </select>
                <!--</div>-->
        ";
        return $HTML_instr_selector;
}

function HTML_ar_selector($date){
	$ar_data = find_latest_file($date,'','','txt','ar');
        $lines = file($ar_data);
        $ar_count = count($lines);
        $HTML_ar_selector =  "<div data-role='fieldcontain'id = 'ar_selector_block'>
                                <label for='ar_selector' class='select'>Choose Active Region</label><br>
                                <select data-native-menu='false' name='region' id='ar_selector'>";
        //$HTML_ar_selector= $HTML_ar_selector."<option data-placeholder='true'>".$region."</option>";
	$first = true;
        foreach($lines as $line){
                list($ar_number,$location_ns,$location_minutes) = explode(' ',$line,4);//the location isn't used but it could be useful to add it in, we'll see
		if($first){
			$HTML_ar_selector= $HTML_ar_selector."<option data-placeholder='true'value = '".$ar_number."'>".$ar_number."</option>";
			$first=false;
			continue;
		}
		$HTML_ar_selector =$HTML_ar_selector."<option value='".$ar_number."'> ".$ar_number."</option>";    
        }
        $HTML_ar_selector = $HTML_ar_selector.'         </select>
                                        </div>';
        return $HTML_ar_selector;
}

switch($_REQUEST["func"]){
	case "HTML_ar_selector":
//		$msg = HTML_ar_selector($_REQUEST["date"]);
		//$msg = 'jq_get_response_string';
		echo HTML_ar_selector($_REQUEST["date"]);
		break;
	case "HTML_instrument_selector":
		echo HTML_instrument_selector($_REQUEST["date"]);
		break;
	default:
		break;
}
if($_GET["cmd"]){
	echo 'test mode';
	echo HTML_ar_selector("20110630");
}
?>
