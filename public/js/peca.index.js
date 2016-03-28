$(document).ready(function(){
	
	$('.btn-editStatus').click(function(){
		
		$('#idPeca').val( $(this).attr('id') );
		
		$('#myModalLabel').html('Editar peca: ' + $(this).attr('id') );
		
		$('#logPecaAjax').load('http://localhost/playdisplay/logpeca/listLogAjax/' + $(this).attr('id'));
	});
		
});