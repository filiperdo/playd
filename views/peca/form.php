
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>peca"><?php echo $this->title; ?></a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>
</div>
<!-- /.row -->

<form id="form1" name="form1" method="post" action="<?php echo URL;?>peca/<?php echo $this->action;?>/">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idPeca" value="<?=$this->obj->getId_peca()?>" />
<input type="hidden" name="nome_fornecedor" id="nome_fornecedor" value="" />

<div class="form-group">
	<label for="id_fornecedor">Fornecedor</label>
	<select name="id_fornecedor" id="id_fornecedor" class="form-control">
	<option value="" disabled="disabled" selected="selected">Selecione o fornecedor</option>
	<?php foreach( $this->listarFornecedor as $fornecedor ) { ?>
		<option value="<?php echo $fornecedor->getId_fornecedor();?>"><?php echo $fornecedor->getName();?></option>
	<?php } ?>
	</select>
</div>

<div class="form-group">
	<label for="marca">Marca</label> 
	<select name="marca" id="marca" class="form-control">
	<option value="0" disabled="disabled" selected="selected">Selecione uma marca</option>
	<?php foreach( $this->listarMarca as $marca ) { ?>
		<option value="<?php echo $marca->getId_marca();?>"><?php echo $marca->getName();?></option>
	<?php } ?>
	</select>
</div>

<div class="form-group">
	<label for="produto">Produto</label> 
	<select name="produto" id="produto" class="form-control">
	
	</select>
</div>

<div class="form-group">
	<label for="quantidade">Quantidade</label> 
	<input type="text" name="quantidade" id="quantidade"  class="form-control" required="required" value="" />
</div>

<div class="form-group">
	<label for="valor">Valor</label> 
	<input type="text" name="valor" id="valor"  class="form-control" required="required" value="" />
</div>

<div class="form-group">
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
	<a href="<?php echo URL; ?>peca" class="btn btn-info">Cancelar</a>
</div>

</div>
</div>

</form>

