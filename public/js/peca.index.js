$(document).ready(function(){

	if( window.location.hostname == 'localhost' )
	{
		var URL = 'http://localhost/playd/';
	}
	else
	{
		var URL = 'http://www.playdisplay.com.br/system/';
	}

	$('.btn-editStatus').click(function(){

		$('#idPeca').val( $(this).attr('id') );

		$('#myModalLabel').html('Editar peca: ' + $(this).attr('id') );

		//$('#logPecaAjax').load('http://localhost/playd/logpeca/listLogAjax/' + $(this).attr('id'));

		$('#logPecaAjax').load(URL+'logpeca/listLogAjax/' + $(this).attr('id'));
	});

	$('#status').live('change',function(){

		if( $(this).val() == 2 || $(this).val() == 3 )
		{
			$('#gp-cor').css('display','');
		}
		else
		{
			$('#gp-cor').css('display','none');
		}

	});

});
