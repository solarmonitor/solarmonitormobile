$(document).ready(function(){
	//replace these with a generic function for all such radio boxes? would need to re-name all boxes.
	$(':radio[name*="xrays"]').change(function(){
		window.location = 'chart_page.php?date='+ $("#global_date").text()+'&type=xrays';
	});
	$(':radio[name*="protons"]').change(function(){
		window.location = 'chart_page.php?date='+ $("#global_date").text()+'&type=protons';
	});
	$(':radio[name*="electrons"]').change(function(){
		window.location = 'chart_page.php?date='+ $("#global_date").text()+'&type=electrons';
	});
	
	$(':radio[name*="plasma"]').change(function(){
		window.location = 'chart_page.php?date='+ $("#global_date").text()+'&type=plasma';
	});
	$(':radio[name*="bfield"]').change(function(){
		window.location = 'chart_page.php?date='+ $("#global_date").text()+'&type=bfield';
	});
	$(':radio[name*="3day"]').change(function(){
		window.location = 'chart_page.php?date='+ $("#global_date").text()+'&type=3day';
	});
	$(':radio[name*="6hour"]').change(function(){
		window.location = 'chart_page.php?date='+ $("#global_date").text()+'&type=6hour';
	});
	
	
	$(".ui-li-count").click(function () {
		//alert($(this).attr("id"));
		$.get("GET_flares.php",{"args":$(this).attr("id")},
			function(data){
				if(data!='noflare'){
					alert(data);
				}
			}
		);
	});
	$("#date_picker").scroller();
             $("#date_picker").scroller({
                 dateFormat : "yymmdd",
                 dateOrder : "yMd",// for some reason this doesn't work : dispays as ymd always regardless of how this is set eventhough this is not the default (mmddy).
                 setText : "Go",
                 onClose : function(date,inst)  {
			 var url;
                         type = $("#this_type").val();
			 region=$("#this_region").val();
			 page = $("#this_page").val();
			 if(date != $('#global_date').text()){
				 $.get("GET_date_selector.php",{"date":date,"type":type,"region":region,"page":page},
					function(data){
						window.location = data;
					});
			 }
                 }
             });
	$(":checkbox[name*='preference']").change(function(){
//		alert('preference : ' + $(this).val());
		$.get("FORM_mypreferences.php", {"preference":$(this).val()},
		function(data){
//			alert(data);	
		});
		
	});
	$('#footer_tcd_link').click(function(){
		window.location = 'http://www.tcd.ie';
	})

	$('#MAGNITUDE').live('click',function(){
		date = $("#global_date").text();
		$.get('GET_flare_list.php',{"date":date, "sort":'MAGNITUDE'},
			function(data){
				$('#flare_section').html(data);
				//alert(data);
			});
		});
	
	$('#NOAA').live('click',function(){
		date = $("#global_date").text();
		$.get('GET_flare_list.php',{"date":date, 'sort':'NOAA'},
			function(data){
				$('#flare_section').html(data);
				//alert(data);
			});
	});
	$('#TIME').live('click',function(){
		date = $("#global_date").text();
		$.get('GET_flare_list.php',{"date":date,'sort':'TIME'},
			function(data){
				$('#flare_section').html(data);
				//alert(data);
			});
	});
	
//	$('#NOAA').removeClass('ui-bar-d');
//	$('#NOAA').addClass('ui-bar-a');

	$('#ar_search').click(function() {
		region = prompt("Enter NOAA active region number:");	
		if(region){
			$.get('GET_ar_start.php',{'region':region},
				function(data){
					if(data.length == 8){
						window.location = 'ar_grid_page.php?date='+data+'&region='+region;
					}else{
						alert( 'Error : \n'+data + ' is not a valid NOAA active region number.');
					}
			});
		}
	});
	$('#ar_search').focus(function() {
		region = prompt("Enter NOAA active region number:");	
		if(region){
			$.get('GET_ar_start.php',{'region':region},
				function(data){
					if(data.length == 8){
						window.location = 'ar_grid_page.php?date='+data+'&region='+region;
					}else{
						alert( 'Error : \n'+data + ' is not a valid NOAA active region number.');
					}

			});
		}
	});
	$('#date_text').click(function() {
		date = $('#global_date').text();
		window.location = 'index.php?date='+date;
	});
	$('#date_text').focus(function() {
		date = $('#global_date').text();
		window.location = 'index.php?date='+date;
	});
	$('#date_picker_alias').click(function(){
		$('#date_picker').focus();
		$('#date_picker').click();
	});
	//$('#date_picker').click(function() { $('#date_picker').focus(); });
	$('#fd_ar_carousel > div').click(function(){
		//alert('carousel');
		$('.main').attr('src',$(this).attr('id'));
		$('.highlight').removeClass('highlight');
		$(this).addClass('highlight');
		src = $('.main').attr('src');
		date = src.match('[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]');
		date = date[0];
		if(date==$('#global_date').text()){
			$('#date_alert').text('');
		}else{
			$('#date_alert').text(date);
		}

	});
});

$('#page').live('pagecreate',function() {
	$('.main').live('tap',function(){
	});
	$('.main').live('swiperight',function(){
	});

	$('[id*="car"]').live('tap', function (){
	});
});








