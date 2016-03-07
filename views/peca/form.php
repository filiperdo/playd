
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

<div class="form-group">
	<label for="produto">Produto</label> 
	<select name="produto" class="form-control">
	<?php foreach( $this->listarProduto as $produto ) { ?>
		<option value=""><?php echo $produto->getName();?></option>
	<?php } ?>
	</select>
</div>

<div class="form-group">
	<label for="name">Name</label> 
		<input type="text" name="name" id="name"  class="form-control" required="required" value="<?=$this->obj->getName()?>" />
</div>

<div class="form-group">
	<label for="codigo">Codigo</label> 
		<input type="text" name="codigo" id="codigo"  class="form-control" required="required" value="<?=$this->obj->getCodigo()?>" />
</div>

<div class="form-group">
	<label for="qrcode">Qrcode</label> 
		<input type="text" name="qrcode" id="qrcode"  class="form-control" required="required" value="<?=$this->obj->getQrcode()?>" />
</div>

<div class="form-group">
	<label for="id_fornecedor">Fornecedor</label> 
	<input type="text" name="id_fornecedor" id="id_fornecedor"  class="form-control" required="required" value="<?=$this->obj->getId_fornecedor()?>" />
</div>

<div class="form-group">
	<label for="id_marca">Marca</label> 
	<input type="text" name="id_marca" id="id_marca"  class="form-control" required="required" value="<?=$this->obj->getId_marca()?>" />
</div>

<div class="form-group">
	<label for="id_statuspeca">Statuspeca</label> 
		<input type="text" name="id_statuspeca" id="id_statuspeca"  class="form-control" required="required" value="<?=$this->obj->getId_statuspeca()?>" />
</div>

<div class="form-group">
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
	<a href="<?php echo URL; ?>peca" class="btn btn-info">Cancelar</a>
</div>


</div>
</div>

</form>