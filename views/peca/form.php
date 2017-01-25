
<script src="<?=URL?>public/js/jquery.maskMoney.min.js"></script>
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
        <div class="x_panel">
		<div class="x_title">
		<h2 class="page-header"><?php echo $this->title; ?></h2>
        <div class="clearfix"></div>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>peca">Peças</a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>

<!-- /.row -->
<div class="x_content">
<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>
<div class="col-md-6 col-sm-6 col-xs-12">


<form id="form1" name="form1" method="post" action="<?php echo URL;?>peca/<?php echo $this->action;?>/" class="form-horizontal">

<input type="hidden" name="idPeca" value="<?=$this->obj->getId_peca()?>" />
<input type="hidden" name="nome_fornecedor" id="nome_fornecedor" value="" />

<div class="form-group" style="margin-top:25px">

	<label for="id_fornecedor" class="col-md-2 col-sm-2 col-xs-12 control-label">Fornecedor</label>

		<div class="col-md-6 col-sm-6 col-xs-12">
			<select name="id_fornecedor" id="id_fornecedor" class="form-control select2">
			<option value="" disabled="disabled" selected="selected">Selecione o fornecedor</option>

			<?php foreach( $this->listarFornecedor as $fornecedor ) { ?>
				<option value="<?php echo $fornecedor->getId_fornecedor();?>" <?php if( $this->gfornecedor == $fornecedor->getId_fornecedor() ){?>selected="selected"<?php }?>>
					<?php echo $fornecedor->getName();?>
				</option>
			<?php } ?>

			</select>
		</div>

		<div class="col-md-3 col-sm-3 col-xs-12">
            <a href="<?php echo URL?>fornecedor/form" class="btn btn-sm btn-success">Novo Fornecedor</a>
        </div>

</div>

<div class="form-group">
	<label for="marca" class="col-md-2 col-sm-2 col-xs-12 control-label">Marca</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
    	<select name="marca" id="marca" class="form-control">
    	<option value="0" disabled="disabled" selected="selected">Selecione uma marca</option>
    	<?php foreach( $this->listarMarca as $marca ) { ?>
    		<option value="<?php echo $marca->getId_marca();?>"><?php echo $marca->getName();?></option>
    	<?php } ?>
    	</select>
    </div>
</div>

<div class="form-group">
	<label for="produto" class="col-md-2 col-sm-2 col-xs-12 control-label">Produto</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
    	<select name="produto" id="produto" class="form-control"><!-- conteudo ajax --></select>
    </div>
</div>

<div class="form-group">
	<label for="quantidade" class="col-md-2 col-sm-2 col-xs-12 control-label">Quantidade</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
	       <input type="text" name="quantidade" id="quantidade"  class="form-control" required="required" value="" />
    </div>
</div>



<div class="form-group">
	<label for="valor" class="col-md-2 col-sm-2 col-xs-12 control-label">Valor</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" name="valor" id="valor"  class="form-control" required="required" value="" />
    </div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
    	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
    	<a href="<?php echo URL; ?>peca" class="btn btn-info">Cancelar</a>
    </div>
</div>

</form>
</div><!-- col-md-6 col-sm-6 col-xs-12 -->


<div class="col-md-3 col-sm-3 col-xs-12">

	<table class="countries_list">

	</table>

	<h1><span>US$</span> <?php echo $this->config->getDolar();?> <a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i> Alterar</a></h1>
	<table class="countries_list">
      <tbody>
        <tr>
          <td>Aro</td>
          <td class="fs15 fw700 text-right"> <div id="valor_aro"></div> </td>
        </tr>
        <tr>
          <td>Cola</td>
          <td class="fs15 fw700 text-right"> <div id="valor_cola"></div> </td>
        </tr>
        <tr>
          <td>Vidro</td>
          <td class="fs15 fw700 text-right"> <div id="valor_vidro"></div> </td>
        </tr>
        <tr>
          <td>Polarizador</td>
          <td class="fs15 fw700 text-right"> <div id="valor_polarizador"></div> </td>
        </tr>
        <tr>
          <td>LCD</td>
          <td class="fs15 fw700 text-right"> <div id="valor_lcd"></div> </td>
        </tr>
      </tbody>
    </table>
</div>


</div><!-- x_content -->
</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<form class="" action="<?=URL?>config/edit" method="post">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Alterar valor</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group">
						<label for="dolar" class="col-md-2 col-sm-2 col-xs-12 control-label">Valor</label>
					    <div class="col-md-9 col-sm-9 col-xs-12">
					        <input type="text" name="dolar" id="dolar"  class="form-control moeda" required="required" value="<?php echo $this->config->getDolar();?>" />
					    </div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="submit" class="btn btn-primary">Alterar</button>
			</div>
		</form>
		</div>
	</div>
</div>


<!-- Select2 -->
<link rel="stylesheet" href="<?php echo URL; ?>util/select2/select2.min.css">
<!-- Select2 -->
<script src="<?php echo URL; ?>util/select2/select2.full.min.js"></script>

<script type="text/javascript">
	$(".moeda").maskMoney({prefix:'US$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
</script>

<!-- Page script -->
<script>
$(function () {
	//Initialize Select2 Elements
	$(".select2").select2();

});

if( window.location.hostname == 'localhost' )
{
	var URL = 'http://localhost/playd/';
}
else
{
	var URL = 'http://www.playdisplay.com.br/system/';
}

$(document).ready(function(){



$('#produto').change(function(){

	$.getJSON( URL+'peca/getCustoPeca/'+$(this).val(), function( data ) {
		$('#valor_aro').html('US$ ' + data.aro);
		$('#valor_cola').html('US$ ' + data.cola);
		$('#valor_vidro').html('US$ ' + data.vidro);
		$('#valor_polarizador').html('US$ ' + data.polarizador);
		$('#valor_lcd').html('R$ ' + data.lcd);

		$('#valor').val(data.total);
	});
	//alert( data.vidro );
	/*$.post( URL+'peca/getCustoPeca', { id_produto: $(this).val() }, function(data){

		alert( "Data Loaded: " + data.vidro );
	});*/
});

});

</script>
