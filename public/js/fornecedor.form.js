$(document).ready(function(){

	if( window.location.hostname == 'localhost' )
	{
		var URL = 'http://localhost/playd/';
	}
	else
	{
		var URL = 'http://www.playdisplay.com.br/system/';
	}

	$('#estado').change(function(){
		$('#cidade').load(URL+'fornecedor/listCityByState/' + $(this).val());
	});

});
