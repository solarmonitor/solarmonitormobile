<?php
/**
* JQuery Mobile Template for SolarMonitor Mobile. 
*
* Contains the print function for the template.
* @author Iain Billett 2011
*/


/**
*Creates and prints a page from a template. The template page has the standard solarmonitor mobile
*navigation, title bars and html head. The content must be specified.
*
*@param string $content The content to be added to the page template.
*@param string $date The date of the page to be printed.
*@param string $type The (image) type of the page to be printed. E.g. shmi_maglc for a full disk page.
*@param string $region The NOAA region number for the page, required if the page contains content related to a specific NOAA region.
*@param string $page The file name of the page. E.g. fd_page.php or index.php. Default is 'template'.
*@return void Prints the page.
*/
function print_jqm_page_template($content,$date,$type,$region,$page="template",$header=''){
	include("print_global_functions.php");
print_html_head($date);
echo '<body> 
    <div data-role="page" data-theme="a" id="page">';
	if(!$header){
        	print_content_header($date,$type,$region,$page);
	}else{
		echo $header;
	}
echo'   
        <div data-role="content" id="content">';
	//print_date_picker($date);
echo'
        <input id="this_page" type="text" style="display:none" value="'.$page.'"/>
        <input id="this_type" type = "text" style = "display:none;" name ="default_type" value="'.$type.'"/>
        <input id="this_region" type = "text" style = "display:none;" name ="default_region" value="'.$region.'"/>';

echo 	$content;
print_content_footer();
echo	'</div>';//end content
echo	'</div>';//end page
echo 	'</body>';
echo 	'</html>';
}
?>
