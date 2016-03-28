$(document).ready(function(){
	
	$('#marca').change(function(){
		$('#produto').load('http://localhost/playdisplay/peca/listProdByMarca/' + $(this).val());
	});
		
});