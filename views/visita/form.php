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
			<li><a href="<?php echo URL; ?>visita">Visitas</a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>


<div class="x_content">
<form id="form1" name="form1" method="post" action="<?php echo URL;?>visita/<?php echo $this->action;?>/" class="form-horizontal">
<input type="hidden" name="id_cidade" value="<?php echo $this->id_cidade; ?>">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idVisita" value="<?=$this->obj->getId_visita()?>" />

<div class="form-group">
	<label for="data" class="col-sm-2 control-label">Data</label>
	<div class="col-sm-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-calendar"></i></span>
			<input type="text" name="data"  class="form-control calendary" placeholder="__/__/____" value="<?php echo date('d/m/Y'); ?>" />
		</div>
	</div>
</div>

<div class="form-group">
	<label for="obs" class="col-sm-2 control-label">Obs</label>
	<div class="col-sm-10">
		<textarea name="obs" rows="4" cols="" class="form-control" required="required"><?=$this->obj->getObs()?></textarea>
	</div>
</div>

<div class="form-group">
	<label for="obs" class="col-sm-2 control-label">Custo R$</label>
	<div class="col-sm-10">
		<input name="custo" class="form-control moeda_real" required="required" value="<?=$this->obj->getCusto()?>" />
	</div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>cidade" class="btn btn-info">Cancelar</a>
	</div>
</div>

</div>
</div>

</form>


</div>
</div>
</div>
</div>

<script type="text/javascript">
	$(".moeda_real").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
</script>
