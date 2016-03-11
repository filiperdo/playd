
<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><?php echo $this->title; ?></h1>
<ol class="breadcrumb">
<li><a href="<?php echo URL; ?>">Home</a></li>
<li><a href="<?php echo URL; ?>logpeca"><?php echo $this->title; ?></a></li>
<li class="active"><?php echo $this->title; ?></li>
</ol>
</div>
</div>
<!-- /.row -->
<form id="form1" name="form1" method="post" action="<?php echo URL;?>logpeca/<?php echo $this->action;?>/">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6">
<input type="hidden" name="idLogpeca" value="<?=$this->obj->getId_logpeca()?>" />

<div class="form-group">
	<label for="id_logpeca">Id_logpeca</label> 
		<input type="text" name="id_logpeca" id="id_logpeca"  class="form-control" required="required" value="<?=$this->obj->getId_logpeca()?>" />
</div>

<div class="form-group">
	<label for="color">Color</label> 
		<input type="text" name="color" id="color"  class="form-control" required="required" value="<?=$this->obj->getColor()?>" />
</div>

<div class="form-group">
	<label for="date">Date</label> 
		<input type="text" name="date" id="date"  class="form-control" required="required" value="<?=$this->obj->getDate()?>" />
</div>

<div class="form-group">
	<label for="id_peca">Id_peca</label> 
		<input type="text" name="id_peca" id="id_peca"  class="form-control" required="required" value="<?=$this->obj->getId_peca()?>" />
</div>

<div class="form-group">
	<label for="id_user">Id_user</label> 
		<input type="text" name="id_user" id="id_user"  class="form-control" required="required" value="<?=$this->obj->getId_user()?>" />
</div>

<div class="form-group">
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
	<a href="<?php echo URL; ?>logpeca" class="btn btn-info">Cancelar</a>
</div>


</div>
</div>

</form>