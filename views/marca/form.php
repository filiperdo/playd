
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<div class="x_panel">
			<div class="x_title">
				<h2 class="page-header"><?php echo $this->title; ?></h2>
				<div class="clearfix"></div>
				<ol class="breadcrumb">
					<li><a href="<?php echo URL; ?>">Home</a></li>
					<li><a href="<?php echo URL; ?>marca">Marcas</a></li>
					<li class="active"><?php echo $this->title; ?></li>
				</ol>
			</div>
			<div class="x_content">
				<form id="form1" name="form1" method="post" action="<?php echo URL;?>marca/<?php echo $this->action;?>/">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-6">
						<input type="hidden" name="idMarca" value="<?=$this->obj->getId_marca()?>" />
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" id="name"  class="form-control" required="required" value="<?=$this->obj->getName()?>" />
							</div>
							<div class="form-group">
								<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
								<a href="<?php echo URL; ?>marca" class="btn btn-info">Cancelar</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
