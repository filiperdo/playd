
<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><?php echo $this->title; ?></h1>
<ol class="breadcrumb">
<li><a href="<?php echo URL; ?>">Home</a></li>
<li><a href="<?php echo URL; ?>cidade"><?php echo $this->title; ?></a></li>
<li class="active"><?php echo $this->title; ?></li>
</ol>
</div>
</div>
<!-- /.row -->
<form id="form1" name="form1" method="post" action="<?php echo URL;?>cidade/<?php echo $this->action;?>/">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idCidade" value="<?=$this->obj->getId_cidade()?>" />


<div class="form-group">
	<label for="name">Nome</label> 
	<input type="text" name="name" id="name"  class="form-control" required="required" value="<?=$this->obj->getName()?>" />
</div>

<div class="form-group">
	<label for="estado">Estado</label>
	<select name="estado" class="form-control" required="required">
		<?php foreach( $this->listarEstado as $estado ){?>
		<option value="<?php echo $estado->getId_estado(); ?>" <?php if( $estado->getId_estado() ==  $this->obj->getEstado()->getId_estado() ) { ?> selected="selected"<?php } ?>>
			<?php echo $estado->getName(); ?>
		</option>
		<?php } ?>
	</select>
</div>

<div class="form-group">
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
	<a href="<?php echo URL; ?>cidade" class="btn btn-info">Cancelar</a>
</div>


</div>
</div>

</form>