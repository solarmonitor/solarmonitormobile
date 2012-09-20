<?php
function print_plain_page_template($title="template",$head="",$body=""){
echo'
<html>
	<head>
		<title>'.$title.'</title>
		'.$head.'
	</head>
	<body>
	'.$body.'
	</body>
</html>';
}
//print_plain_page_template('test',
//			'<meta name = "viewport" content = "width=device-width, initial-scale=1">',
//			'<img src="http://solarmonitor.org/webservices/data/20110722/pngs/shmi/shmi_maglc_fd_20110722_085656.png" style="max-width:400px"/>');
?>
