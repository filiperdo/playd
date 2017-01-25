<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<div class="x_panel">
		<div class="x_title">
		<h2 class="page-header"><?php echo $this->title.'s'; ?></h2>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li class="active"><a href="<?php echo URL;?>cidade"><?php echo $this->title.'s'; ?></a></li>
				</ol>
			</div>
			<div class="col-lg-4 col-md-3">
			<form name="form-search" action="<?php echo URL;?>cidade" method="post">
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
				<a href="<?php echo URL;?>cidade/form" class="btn btn-success">Cadastrar <?php echo $this->title; ?></a>
			</div>
		</div>
	</div>

<div class="x_content">
<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>

<table class="table table-striped sortable table-condensed">
	<thead>
	<tr>
		<th style="text-align:left">Name </th>
		<th>Estado </th>
		<th>Visitas</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $this->listarCidade as $cidade ) { ?>
	<tr>
		<td style="text-align:left"><?php echo $cidade->getName(); ?></td>
		<td><?php echo $cidade->getEstado()->getUf(); ?></td>
		<td><a href="<?php echo URL?>visita/?id_cidade=<?php echo $cidade->getId_cidade(); ?>"><?php echo $cidade->getTotalVisitas(); ?></a></td>
		<td style="text-align:right">
			<a href="<?php echo URL;?>visita/form/?cidade=<?php echo $cidade->getId_cidade();?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-map-marker"></i> Visita</a>
			<a href="<?php echo URL;?>cidade/form/<?php echo $cidade->getId_cidade();?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
			<a href="<?php echo URL;?>cidade/delete/<?php echo $cidade->getId_cidade();?>" class="delete btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
		</td>
		</tr>
	<?php } ?>
	</tbody>
</table>

</div>
</div>
</div>
</div>

<script>
$(function() {
	$(".delete").click(function(e) {
		var c = confirm("Deseja realmente deletar este registro?");
		if (c == false) return false;
	});
 });
</script>
