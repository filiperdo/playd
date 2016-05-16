
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

</div><!-- col-md-6 col-sm-6 col-lg-6 -->

<div class="col-md-6 col-sm-6 col-lg-6">

<div class="form-group">
	<label for="estado">Estado</label>
	<select name="estado" class="form-control" required="required">
		<?php foreach( $this->listarEstado as $estado ){?>
		<option value="<?php echo $estado->getId_estado(); ?>"><?php echo $estado->getName(); ?></option>
		<?php } ?>
	</select>
</div>

<div class="form-group">
	<label for="cidade">Cidade</label>
	<select name="cidade" class="form-control" required="required">
		<?php foreach( $this->listarCidade as $cidade ){?>
		<option value="<?php echo $cidade->getId_cidade(); ?>" <?php if( $cidade->getId_cidade() == $this->obj->getCidade()->getId_cidade() ){?>selected="selected"<?php } ?>>
			<?php echo $cidade->getName(); ?>
		</option>
		<?php } ?>
	</select>
</div>

<div class="form-group">
	<label for="endereco">Endereço</label> 
	<input type="text" name="endereco" id="endereco"  class="form-control" required="required" value="<?=$this->obj->getEndereco()?>" />
</div>

<div class="form-group">
	<label for="note">Observação</label> 
	<textarea rows="3" name="note" id="note"  class="form-control" cols=""><?=$this->obj->getNote()?></textarea>

</div>

</div><!-- col-md-6 col-sm-6 col-lg-6 -->

<div class="col-md-12col-sm-12 col-lg-12">
	<div class="form-group">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>fornecedor" class="btn btn-info">Cancelar</a>
	</div>
</div>

</div><!-- row -->

</form>