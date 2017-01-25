$(document).ready(function(){

	if( window.location.hostname == 'localhost' )
	{
		var URL = 'http://localhost/playd/';
	}
	else
	{
		var URL = 'http://www.playdisplay.com.br/system/';
	}

	$('#id_fornecedor').change(function(){
		$('#nome_fornecedor').val( $('#id_fornecedor option:selected').text() );
	});

	$('#marca').change(function(){
		$('#produto').load(URL+'peca/listProdByMarca/' + $(this).val());
		//$('#produto').load('http://www.playdisplay.com.br/system/peca/listProdByMarca/' + $(this).val());
	});

});
