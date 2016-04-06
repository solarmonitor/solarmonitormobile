<?php 
include("2011_php_functions.php");
include("2011_php_globals.php");
//echo("hello world!");
//echo("$thumbnails[0]");
//echo(write_thumbnail($thumbnails[0]));
//print(write_thumbnail($thumbnails[0]));

print('
!-- This is the phonegap version of the site. -->
<html>
<head>
    <title>phoneGap html</title>
    <link rel="stylesheet" href="css/solarMonitorMobile.css" />
    <!--  <link rel="stylesheet" href="https://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" /> 
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>  
     -->
     <link rel="stylesheet"  href="jquery.mobile.scrollview.css" /> 
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.css" />
    <script src="https://code.jquery.com/jquery-1.6.1.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.js"></script>
 
</head>
<body>
    <div data-role="page" data-theme="a" id="list_view">
        <div data-role="header" data-theme="a" style = "height:20%;">
            <a href="#list_view" data-theme ="a">List</a>
            <h1>Solar Monitor</h1>
            <a href="#grid_view" data-theme ="a">grid</a>
            <div data-role = "navbar"> 
                <ul>
                    <li><a href="">AR</a></li>
                    <li><a href="">AR</a></li>
                    <li><a rel = "external" href="date_selector.html">Date</a></li>
                    <li><a href="">AR</a></li>
                    <li><a href="">AR</a></li>
                </ul>
            </div>
        </div>
        <div data-role="content">
            <ul data-role="listview" >
                <li class = "ui-bar-d"><a href="#main_img_1">');
print(              write_thumbnail($thumbnails[15]));
print(		    '<h3>SHMI</h3>
                    <p>Description</p>
                </a></li>
                <li class = "ui-bar-d"><a href="#main_img_2">');
print(		    write_thumbnail($thumbnails[14]));                    
print(		    '<h3>SAIA</h3>
                    <p>Description</p>
                </a></li>
                <li class = "ui-bar-d"><a href="testing.html">');
print(		    write_thumbnail($thumbnails[0]));                    
print(		    '<h3>BBSO</h3>
                    <p>Description</p>
                </a></li>
                <li class = "ui-bar-d"><a href="index.html">');
print(		    write_thumbnail($thumbnails[19]));
print(              '<h3>SWAP</h3>
                    <p>Description</p>
                </a></li>
                <li class = "ui-bar-d"><a href="index.html">');
print(		    write_thumbnail($thumbnails[8]));
print(              '<h3>SAIA</h3>
                    <p>Description</p>
                </a></li>
                <li class = "ui-bar-d"><a href="index.html">');
print(		    write_thumbnail($thumbnails[4]));
print(              '<h3>HXRT</h3>
                    <p>Description</p>
                </a></li>
            </ul>
        </div>
        <div data-role="footer" data-position="fixed" data-id = "footer">
            <h1>&copy; Copyright Info or Site URL</h1>
        </div>
    </div>');

?>
