<?
	/*
	File:
		globals
	
	Purpose:
			Variables that are required by nearly all php files.  Includes the paths for code and data as well as code.
		Will also include start and end dates for missions.
	
	Author(s):
		Russ Hewett -- rhewett@vt.edu
	
	History:
		2004/07/12 (RH) -- written
		2004/09/08 (RH) -- updated - added path vars
		2006/11/17 (RH) -- updated - changed SXI to EIT 171 -- we really need to rewrite this whole system..
		2011/07/04 (Iain Billett) -- updated - modifications for use on mobile site  : changing path variable
	*/


	//	Path related globals
	//	All of these paths must be within the server document root.  eg, "/" is the server root path, 
	//	not the system root path.  Trailing '/' must be included.
	
		//	PHP Code Path
		//	The path in which the PHP lies
		//	$php_code_path = "/";
		
		//	Data Path
		//	This is the folder that the data/ folder lies in.


// modified 04-07-2011
//		$arm_data_path = "/Library/WebServer/Documents/solarmonitor/";
		$arm_data_path = "./";
		$date_today = date("Ymd",time());
	//$eit_bakeout = true;
		$day_in_seconds = 86400;
		$fd_types = array("gong_maglc", "smdi_maglc", "smdi_igram", "bbso_halph", "seit_00304", "seit_00171", "seit_00195", "seit_00284", "hxrt_flter", "slis_chrom", "gong_farsd", "strb_00195", "stra_00195", "gong_igram", "swap_00174" );
		$fd_strs = array("GONG+<br>Magnetogram", "MDI<br>Magnetogram", "MDI<br>Continuum", "GHN<br>H-alpha", "EIT<br>304 &Aring;",
		 "EIT<br>171 &Aring;", "EIT<br>195 &Aring;", "EIT<br>284 &Aring;", "Hinode<br>XRT", "SWAP<br>174");
		$fd_strs2 = array("GONG+ Magnetogram", "MDI Magnetogram", "MDI Continuum", "GHN H-alpha", "EIT 304 &Aring;",
		 "EIT 171 &Aring;", "EIT 195 &Aring;", "EIT 284 &Aring;", "Hinode XRT", "SOLIS Chromaspheric Magnetogram", "GONG Farside Magnetogram", "STEREO B", "STEREO A", "GONG+ Continuum", "SWAP 174 &Aring;");
		$fd_strs3 = array("Mag", "Mag", "Cont", "H&alpha;", "304",
		 "171", "195", "284", "XRT", "Far","A","B","174");
		$fd_types2num = array_flip($fd_types);
		//2011 mobile site arrays : should contain all instruments past and present
		$instrument_names = array(
			"shmi_maglc" => "HMI Mag",//main
			"chmi_06173" => "HMI 6173&#197",
			"smdi_maglc" => "MDI Mag",
			"smdi_igram" => "MDI Cont",
			"gong_maglc" => "GONG Mag",
			"bbso_halph" => "GHN H&alpha;", 
			"seit_00171" => "EIT 171&#197",
			"seit_00195" => "EIT 195&#197",
			"hxrt_flter" => "XRT",
			"swap_00174" => "SWAP 174&#197",
			"saia_00094" => "AIA 94&#197",//saia
			"saia_00131" => "AIA 131&#197",
			"saia_00171" => "AIA 171&#197",
			"saia_00193" => "AIA 193&#197",
			"saia_00211" => "AIA 211&#197",
			"saia_00304" => "AIA 304&#197",
			"saia_00335" => "AIA 355&#197",
			"saia_01600" => "AIA 1600&#197",
			"saia_01700" => "AIA 1700&#197",
			"saia_04500" => "AIA 4500&#197",
			"gong_farsd" => "GONG Farside",//farside
			"slis_chrom" => "SOLIS Mag",
			"strb_00195" => "STEREO B",
			"stra_00195" => "STEREO A"
		);
		$instrument_names_flip = array_flip($instrument_names);

		$instrument_types = array(
			"shmi_maglc",//main
			"chmi_06173",
			"smdi_maglc",
			"smdi_igram",
			"gong_maglc",
			"bbso_halph",
			"seit_00171",
			"seit_00195",
			"hxrt_flter",
			"swap_00174",
			"saia_00094",//saia
			"saia_00131",
			"saia_00171",
			"saia_00193",
			"saia_00211",
			"saia_00304",
			"saia_00335",
			"saia_01600",
			"saia_01700",
			"saia_04500",
			"gong_farsd",//the farside
			"slis_chrom",
			"strb_00195",
			"stra_00195",
		);
		$charts = array(
			'xrays'=>array(
				'folder'=>'goes',
				'file'=>'goes_xrays',//full file name = sace_xrays_date.gif
				'ext'=>'.png'
				),
			'protons'=>array(
				'folder'=>'goes',
				'file'=>'goes_prtns',//full file name = sace_xrays_date.gif
				'ext'=>'.png'
				),
			'electrons'=>array(
				'folder'=>'goes',
				'file'=>'goes_elect',//full file name = sace_xrays_date.gif
				'ext'=>'.png'
				),
			'plasma'=>array(
				'folder'=>'ace',
				'file'=>'sace_plasma',//full file name = sace_xrays_date.gif
				'ext'=>'.gif'
				),
			'bfield'=>array(
				'folder'=>'ace',
				'file'=>'sace_bfield',//full file name = sace_xrays_date.gif
				'ext'=>'.gif'
				),
			'3day'=>array(
				'folder'=>'eve',
				'file'=>'seve_3day',//full file name = sace_xrays_date.gif
				'ext'=>'.png'
				),
			'6hour'=>array(
				'folder'=>'eve',
				'file'=>'seve_6hr',//full file name = sace_xrays_date.gif
				'ext'=>'.png'
				)
			);
			
	$png_folders = array(
		'bbso',
		'shmi',
		'chmi',
		'smdi',
		'stra',
		'strb',
		'swap',
		'gong',
		'hxrt',
		'saia',
		'seit',
		'slis'
		);


//provides a mapping between the position in the list structure and the index of the type of the image to be displayed  
$instrument_groups = array
	(
	0 => array
		(
		0   => array
			(
			"shmi_maglc",
			"smdi_maglc",
			"gong_maglc"//,
			//"shmi_maglc"
			),
		1   => array
			(
			"saia_04500"
			),
		2 => array
			(
			"bbso_halph"
			),
		3  => array
			(
			"swap_00174",
			"saia_00171"
			),
		4  => array
			(
			"saia_00193",
			"seit_00195"
			),
		5   => array
			(
			"hxrt_flter"
			)
		),
	1   => array
		(
		0   => array
			(
			"shmi_maglc",
			"smdi_maglc",
			"gong_maglc"//,
			//"shmi_maglc"
			),
		1   => array
			(
			"slis_chrom"
			),
		2 => array
			(
			"gong_farsd"
			),
		3  => array
			(
			"strb_00195"
			),
		4  => array
			(
			"saia_00193"//try also seit_00195? as above
			),
		5   => array
			(
			"stra_00195"
			)
		),
	2   => array
		(
		0   => array
			(
			"shmi_maglc",
			"smdi_maglc",
			"gong_maglc"//,
			//"shmi_maglc"
			),
		1   => array
			(
			"saia_00094"
			),
		2 => array
			(
			"saia_00131"
			),
		3  => array
			(
			"saia_00171"
			),
		4  => array
			(
			"saia_00193"
			),
		5   => array
			(
			"saia_00211"
			)
		),
	3   => array
		(
		0   => array
			(
			"shmi_maglc",
			"smdi_maglc",
			"gong_maglc"//,
			//"shmi_maglc"
			),
		1   => array
			(
			"saia_00304"
			),
		2 => array
			(
			"saia_00335"
			),
		3  => array
			(
			"saia_01600"
			),
		4  => array
			(
			"saia_01700"
			),
		5   => array
			(
			"saia_04500"
			)
		)
	);

	$site_settings = array(
		//'thumbs'=>'Thumbnails',
		//'home'=>'normal'
	);
		




	

	 	$index_types = array("smdi_maglc", "smdi_igram", "swap_00174", "seit_00195", "hxrt_flter");  //"gsxi_flter");
	//	$index_types = array("gong_maglc", "smdi_igram", "bbso_halph", "seit_00171", "seit_00195", "hxrt_flter");  //"gsxi_flter");
		$index_types_strs = array("gong_maglc" => "GONG Magnetogram", "gong_igram" => "GONG Continuum", "smdi_maglc" => "SOHO MDI Magnetogram", "smdi_igram" => "SOHO MDI Continuum", "bbso_halph" => "BBSO GHN Hydrogen-Alpha", "seit_00171" => "SOHO Ultraviolet (17.1nm)", "seit_00195" => "SOHO Ultraviolet (19.5nm)", "hxrt_flter" => "X-ray Telescope", "swap_00174" => "Sun Watcher APS (17.4nm)"); //"gsxi_flter" => "SXI X-rays");
	//	$index_types_strs = array("gong_maglc" => "GONG Mag", "smdi_igram" => "MDI Cont", "bbso_halph" => "GHN H&alpha;", "seit_00171" => "EIT 171&Aring", "seit_00195" => "EIT 195&Aring", "hxrt_flter" => "XRT"); //"gsxi_flter" => "SXI X-rays");
	//  SWAPPED BACK TO MDI AS GONG MAGS WERE NOT BEING FOUND
		$index2_types = array("smdi_maglc", "slis_chrom", "gong_farsd", "strb_00195", "seit_00195", "stra_00195");
	//	$index2_types = array("gong_maglc", "slis_chrom", "gong_farsd", "strb_00195", "seit_00195", "stra_00195");
		$index2_types_strs = array("smdi_maglc" => "SOHO MDI Magnetogram", "slis_chrom" => "SOLIS Magnetogram", "gong_farsd" => "GONG Farside", "strb_00195" => "STEREO B (19.5nm)", "seit_00195" => "SOHO Ultraviolet (19.5nm)", "stra_00195" => "STEREO A (19.5nm)");
	//	$index2_types_strs = array("gong_maglc" => "GONG Mag", "slis_chrom" => "SOLIS Mag", "gong_farsd" => "GONG Farside", "strb_00195" => "STEREO B", "seit_00195" => "EIT 195&Aring", "stra_00195" => "STEREO A");
		$bakeout_index_types = array("smdi_maglc", "smdi_igram", "bbso_halph", "swap_00174", "bake_00195", "hxrt_flter"); //"gsxi_flter");
	//	$bakeout_index_types = array("gong_maglc", "smdi_igram", "bbso_halph", "trce_m0171", "bake_00195", "hxrt_flter"); //"gsxi_flter");
	    $bakeout_index_types_strs = array("smdi_maglc" => "SOHO MDI Magnetogram", "smdi_igram" => "SOHO MDI Continuum", "bbso_halph" => "BBSO GHN Hydrogen-Alpha", "trce_m0171" => "TRC 17.1nm", "bake_00195" => "CCD BAKEOUT", "hxrt_flter" => "X-ray Telescope", "swap_00174" => "Sun Watcher APS (17.4nm)"); //"gsxi_flter" => "SXI X-rays");
	//  $bakeout_index_types_strs = array("gong_maglc" => "GONG Mag", "smdi_igram" => "MDI Cont", "bbso_halph" => "GHN H&alpha;", "trce_m0171" => "TRC 171&Aring", "bake_00195" => "CCD BAKEOUT", "hxrt_flter" => "XRT"); //"gsxi_flter" => "SXI X-rays");
	//	$bakeout_index2_types = array("smdi_maglc", "slis_chrom", "gong_farsd", "strb_00195", "trce_m0171", "stra_00195"); //"gsxi_flter");
		$bakeout_index2_types = array("gong_maglc", "slis_chrom", "gong_farsd", "strb_00195", "trce_m0171", "stra_00195"); //"gsxi_flter");
	//  $bakeout_index2_types_strs = array("smdi_maglc" => "MDI Mag", "slis_chrom" => "SOLIS Mag", "gong_farsd" => "GONG Farside", "strb_00195" => "STEREO B", "trce_m0171" => "TRC 171&Aring", "stra_00195" => "STEREO A"); //"gsxi_flter" => "SXI X-rays");	
	    $bakeout_index2_types_strs = array("gong_maglc" => "GONG Magnetogram", "slis_chrom" => "SOLIS Magnetogram", "gong_farsd" => "GONG Farside", "strb_00195" => "STEREO B (19.5nm)", "trce_m0171" => "TRC (17.1nm)", "stra_00195" => "STEREO A (19.5nm)"); //"gsxi_flter" => "SXI X-rays");	

		$keyhole_index_types = array("smdi_maglc", "smdi_igram", "bbso_halph", "swap_00174", "keyh_00195", "hxrt_flter");
	//	$keyhole_index_types = array("smdi_maglc", "smdi_igram", "bbso_halph", "trce_m0171", "keyh_00195", "hxrt_flter"); //"gsxi_flter");
	    $keyhole_index_types_strs = array("smdi_maglc" => "SOHO MDI Magnetogram", "smdi_igram" => "SOHO MDI Continuum", "bbso_halph" => "BBSO GHN Hydrogen-Alpha", "trce_m0171" => "TRC (17.1nm)", "keyh_00195" => "SOHO KEYHOLE", "hxrt_flter" => "X-ray Telescope", "swap_00174" => "Sun Watcher APS (17.4nm)"); //"gsxi_flter" => "SXI X-rays");
		$keyhole_index2_types = array("gong_maglc", "slis_chrom", "gong_farsd", "strb_00195", "trce_m0171", "stra_00195"); //"gsxi_flter");
	    $keyhole_index2_types_strs = array("gong_maglc" => "GONG Magnetogram", "slis_chrom" => "SOLIS Magnetogram", "gong_farsd" => "GONG Farside", "strb_00195" => "STEREO B (19.5nm)", "trce_m0171" => "TRC (17.1nm)", "stra_00195" => "STEREO A (19.5nm)"); //"gsxi_flter" => "SXI X-rays");	


		$region_types = array("smdi_igram", "smdi_maglc", "bbso_halph", "seit_00304", "seit_00171", "seit_00195", "seit_00284", "hxrt_flter", "gong_maglc", "gong_bgrad");
		$region_strs1 = array("smdi_igram" => "MDI Continuum", "smdi_maglc" => "MDI Magnetogram", "bbso_halph" => "BBSO H-Alpha", "seit_00304" => "EIT 304&Aring", 
		"seit_00171" => "EIT 171&Aring", "trce_m0171" => "Trace 171&Aring", "seit_00195" => "EIT 195&Aring", "seit_00284" => "EIT 284&Aring", "hxrt_flter" => "Hinode XRT", "gong_maglc" => "GONG+ Magnetogram", "gong_bgrad" => "Magnetic Gradient", 
		"slis_chrom" => "SOLIS Chromaspheric Mag", "gong_farsd" => "GONG Farside", "strb_00195" => "STEREO B 195&Aring", "stra_00195" => "STEREO A 195&Aring", "gong_igram" => "GONG+ Continuum", "swap_00174" => "SWAP 174&Aring");
		$region_strs2 = array("smdi_igram" => "Cont", "smdi_maglc" => "Mag", "bbso_halph" => "H&alpha;", 
		"seit_00304" => "304&Aring", "seit_00171" => "171&Aring", "seit_00195" => "195&Aring", "seit_00284" => "284&Aring", 
		"hxrt_flter" => "XRT", "gong_maglc" => "Mag", "gong_bgrad" => "Magnetic<br>Gradient");

	
?>
