$(document).ready(function(){
	
	$('.btn-editStatus').click(function(){
		$('#idPeca').val( $(this).attr('id') );
		$('#myModalLabel').html('Editar codigo: ' + $(this).attr('id') );
	});
		
});