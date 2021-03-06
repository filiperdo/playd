
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<div class="x_panel">
		<div class="x_title">
			<h2 class="page-header"><?php echo $this->title; ?></h2>
			<div class="clearfix"></div>
			<ol class="breadcrumb">
				<li><a href="<?php echo URL; ?>">Home</a></li>
				<li><a href="<?php echo URL; ?>user">Usuários</a></li>
				<li class="active"><?php echo $this->title; ?></li>
			</ol>
		</div>


<div class="x_content">

	<form id="form1" name="form1" method="post" action="<?php echo URL;?>user/<?php echo $this->action;?>/" >

		<div class="row">
			<div class="col-md-6 col-sm-6 col-lg-6">
				<input type="hidden" name="idUser" value="<?=$this->obj->getId_user()?>" />
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name"   class="form-control" required="required" value="<?=$this->obj->getName()?>" />
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" name="email"  class="form-control" required="required" value="<?=$this->obj->getEmail()?>" />
				</div>

				<div class="form-group">
					<label for="login">Login</label>
						<input type="text" name="login"  class="form-control" required="required" value="<?=$this->obj->getLogin()?>" />
				</div>

				<div class="form-group">
					<label for="password">Password</label>
						<input type="text" name="password"   class="form-control" required="required" value="<?=$this->obj->getPassword()?>" />
				</div>

				<div class="form-group">
					<label for="id_typeuser">Tipo</label>
					<select class="form-control" name="id_typeuser">
						<option value="2" selected="selected">Administrador</option>
					</select>
				</div>

				<div class="form-group">
					<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
					<a href="<?php echo URL; ?>user" class="btn btn-info">Cancelar</a>
				</div>
			</div>
		</div>

	</form>
</div>
</div>
</div>
</div>
