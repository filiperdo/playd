$(document).ready(function(){
	
	$('#estado').change(function(){
		$('#cidade').load('http://www.playdisplay.com.br/system/fornecedor/listCityByState/' + $(this).val());
		//$('#cidade').load('http://localhost/playd/fornecedor/listCityByState/' + $(this).val()); 
	});
		
});