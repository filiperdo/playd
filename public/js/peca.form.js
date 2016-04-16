$(document).ready(function(){
	
	$('#marca').change(function(){
		$('#produto').load('http://www.playdisplay.com.br/system/peca/listProdByMarca/' + $(this).val());
	});
		
});