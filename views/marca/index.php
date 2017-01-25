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
						<li class="active"><a href="<?php echo URL;?>marca"><?php echo $this->title.'s'; ?></a></li>
					</ol>
				</div>
				<div class="col-lg-4 col-md-3">
				<form name="form-search" action="<?php echo URL;?>marca" method="post">
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
					<a href="<?php echo URL;?>marca/form" class="btn btn-success">Cadastrar <?php echo $this->title; ?></a>
				</div>
			</div>
		</div>


<div class="x_content">
<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>

<table class="table table-striped sortable table-condensed">
	<thead>
	<tr>
		<th style="text-align:left">Id</th>
		<th style="text-align:left">Name </th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $this->listarMarca as $marca ) { ?>
	<tr>
 		<td style="text-align:left"><?php echo $marca->getId_marca(); ?></td>
		<td style="text-align:left"><?php echo $marca->getName(); ?></td>

		<td style="text-align:right">
			<a href="<?php echo URL;?>marca/form/<?php echo $marca->getId_marca();?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
			<a href="<?php echo URL;?>marca/delete/<?php echo $marca->getId_marca();?>" class="delete btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
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
