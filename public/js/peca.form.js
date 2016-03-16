$(document).ready(function(){
	
	$('#marca').change(function(){
		$('#produto').load('http://localhost/playd/peca/listProdByMarca/' + $(this).val());
	});
		
});