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
				<li><a href="<?php echo URL; ?>produto">Produtos</a></li>
				<li class="active"><?php echo $this->title; ?></li>
			</ol>
		</div>

<!-- /.row -->
<form id="form1" name="form1" method="post" action="<?php echo URL;?>produto/<?php echo $this->action;?>/">
	<div class="x_content">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="hidden" name="idProduto" value="<?=$this->obj->getId_produto()?>" />

			<div class="form-group">
				<label for="marca">Marca</label>
				<select name="marca" class="form-control">
					<?php foreach ( $this->listarMarca as $marca ){ ?>
					<option value="<?php echo $marca->getId_marca();?>"><?php echo $marca->getName();?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" id="name"  class="form-control" required="required" value="<?=$this->obj->getName()?>" />
			</div>

			<h5 class="page-header">Materiais</h5>

			<div class="form-group row">
				<div class="col-md-3">
					<label for="aro" >Aro US$</label>
					<input type="text" name="aro" id="aro"  class="form-control moeda" required="required" value="<?=Data::formataMoeda($this->obj->getAro())?>" />
				</div>
				<div class="col-md-3">
					<label for="cola" >Cola US$</label>
					<input type="text" name="cola" id="cola"  class="form-control moeda" required="required" value="<?=Data::formataMoeda($this->obj->getCola())?>" />
				</div>
				<div class="col-md-3 ">
					<label for="vidro">Vidro US$</label>
					<input type="text" name="vidro" id="vidro"  class="form-control moeda" required="required" value="<?=Data::formataMoeda($this->obj->getVidro())?>" />
				</div>
				<div class="col-md-3">
					<label for="polarizador" >Polarizador US$</label>
					<input type="text" name="polarizador" id="polarizador"  class="form-control moeda" required="required" value="<?=Data::formataMoeda($this->obj->getPolarizador())?>" />
				</div>
			</div>
			<div class="form-group">
				<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
				<a href="<?php echo URL; ?>produto" class="btn btn-info">Cancelar</a>
			</div>
		</div>

		<div class="col-md-6 col-sm-6 col-xs-12">
			<h5 class="page-header">Outros materiais</h5>
			<div class="col-md-3 ">
				<label for="vidro">LCD R$</label>
				<input type="text" name="lcd" id="lcd"  class="form-control moeda_real" required="required" value="<?=Data::formataMoeda($this->obj->getLcd())?>" />
			</div>
		</div>


	</div><!-- x_content -->
</form>

</div>
</div>
</div>


<script type="text/javascript">
	$(".moeda").maskMoney({prefix:'US$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
	$(".moeda_real").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
</script>
