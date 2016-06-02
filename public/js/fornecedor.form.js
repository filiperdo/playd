$(document).ready(function(){
	
	$('#estado').change(function(){
	
		$('#cidade').load('http://localhost/playdisplay/listCityByState/' + $(this).val());
	});
		
});