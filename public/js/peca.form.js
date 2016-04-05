$(document).ready(function(){
	
	$('#id_fornecedor').change(function(){
		$('#nome_fornecedor').val( $('#id_fornecedor option:selected').text() );
	});
	
	$('#marca').change(function(){
		//$('#produto').load('http://localhost/playd/peca/listProdByMarca/' + $(this).val());
		$('#produto').load('http://www.playdisplay.com.br/system/peca/listProdByMarca/' + $(this).val());
	});
		
});