
<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><?php echo $this->title; ?></h1>
<ol class="breadcrumb">
<li><a href="<?php echo URL; ?>">Home</a></li>
<li><a href="<?php echo URL; ?>produto"><?php echo $this->title; ?></a></li>
<li class="active"><?php echo $this->title; ?></li>
</ol>
</div>
</div>
<!-- /.row -->
<form id="form1" name="form1" method="post" action="<?php echo URL;?>produto/<?php echo $this->action;?>/">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
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

<div class="form-group">
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
	<a href="<?php echo URL; ?>produto" class="btn btn-info">Cancelar</a>
</div>


</div>
</div>

</form>