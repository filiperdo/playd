<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li class="active"><a href="<?php echo URL;?>user"><?php echo $this->title; ?></a></li>
				</ol>
			</div>
			<div class="col-lg-4 col-md-3">
			<form name="form-search" action="<?php echo URL;?>user" method="post">
				<div class="form-group input-group">
					<input type="text" class="form-control" required="required" name="like" id="busca">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">
								<i class="glyphicon glyphicon-search"></i>
						</button>
					</span>
				</div>
				</form>
			</div>
			<div class="col-lg-2 col-md-2">
				<a href="<?php echo URL;?>user/form" class="btn btn-success">Cadastrar <?php echo $this->title; ?></a>
			</div>
		</div>
	</div>
</div>
<!-- /.row -->

<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>

<table class="table table-striped sortable table-condensed">
	<thead>
	<tr>
<<<<<<< HEAD
		
=======
		<th>Id_user </th>
>>>>>>> 34b1e18370ba8688d6d719a3c6276197d1a13910
		<th>Name </th>
		<th>Email </th>
		<th>Login </th>
		<th>Password </th>
		<th>Id_typeuser </th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $this->listarUser as $user ) { ?>
	<tr>
<<<<<<< HEAD
 		
		<td><?php echo $user->getName(); ?></td>
		<td><?php echo $user->getEmail(); ?></td>
		<td><?php echo $user->getLogin(); ?></td>
		<td><?php echo '*******'; ?></td>
=======
 		<td><?php echo $user->getId_user(); ?></td>
		<td><?php echo $user->getName(); ?></td>
		<td><?php echo $user->getEmail(); ?></td>
		<td><?php echo $user->getLogin(); ?></td>
		<td><?php echo $user->getPassword(); ?></td>
>>>>>>> 34b1e18370ba8688d6d719a3c6276197d1a13910
		<td><?php echo $user->getId_typeuser(); ?></td>
		<td align="right">
			<a href="<?php echo URL;?>user/form/<?php echo $user->getId_user();?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
			<a href="<?php echo URL;?>user/delete/<?php echo $user->getId_user();?>" class="delete btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
		</td>
		</tr>
	<?php } ?>
	</tbody>
</table>


<script>
$(function() {
	$(".delete").click(function(e) {
		var c = confirm("Deseja realmente deletar este registro?");
		if (c == false) return false;
	}); 
 });
</script>