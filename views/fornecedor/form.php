
<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><?php echo $this->title; ?></h1>
<ol class="breadcrumb">
<li><a href="<?php echo URL; ?>">Home</a></li>
<li><a href="<?php echo URL; ?>fornecedor"><?php echo $this->title; ?></a></li>
<li class="active"><?php echo $this->title; ?></li>
</ol>
</div>
</div>
<!-- /.row -->
<form id="form1" name="form1" method="post" action="<?php echo URL;?>fornecedor/<?php echo $this->action;?>/">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idFornecedor" value="<?=$this->obj->getId_fornecedor()?>" />

<div class="form-group">
	<label for="name">Name</label> 
		<input type="text" name="name" id="name"  class="form-control" required="required" value="<?=$this->obj->getName()?>" />
</div>

<div class="form-group">
	<label for="telefone">Telefone</label> 
	<input type="text" name="telefone" id="telefone"  class="form-control" required="required" value="<?=$this->obj->getTelefone()?>" />
</div>

<div class="form-group">
	<label for="email">E-mail</label> 
	<input type="text" name="email" id="email"  class="form-control" required="required" value="<?=$this->obj->getEmail()?>" />
</div>

<div class="form-group">
	<label for="banco">Dados bancários</label> 
	<input type="text" name="banco" id="banco"  class="form-control" required="required" value="<?=$this->obj->getBanco()?>" />
</div>

<div class="form-group">
	<label for="cidade">Cidade</label> 
	<input type="text" name="cidade" id="cidade"  class="form-control" required="required" value="<?=$this->obj->getCidade()?>" />
</div>

<div class="form-group">
	<label for="estado">Estado</label> 
	<input type="text" name="estado" id="estado"  class="form-control" required="required" value="<?=$this->obj->getEstado()?>" />
</div>

<div class="form-group">
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
	<a href="<?php echo URL; ?>fornecedor" class="btn btn-info">Cancelar</a>
</div>


</div>
</div>

</form>