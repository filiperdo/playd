$(document).ready(function(){
	
	$('.btn-editStatus').click(function(){
		
		$('#idPeca').val( $(this).attr('id') );
		
		$('#myModalLabel').html('Editar peca: ' + $(this).attr('id') );
		
		$('#logPecaAjax').load('http://www.playdisplay.com.br/system/logpeca/listLogAjax/' + $(this).attr('id'));
	});
		
});