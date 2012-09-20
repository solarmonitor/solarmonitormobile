$(document).ready(function(){
	$(":checkbox[id*='checkbox']").change(function () {
		$.get("settings_form.php",{ "checkbox" : $(this).val()}, function(data){
			//alert(data);
		});
	});
});
