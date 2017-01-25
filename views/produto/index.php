<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<div class="x_panel">
		<div class="x_title">
			<h2 class="page-header"><?php echo $this->title; ?></h2>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active"><a href="<?php echo URL;?>produto"><?php echo $this->title.'s'; ?></a></li>
					</ol>
				</div>
				<div class="col-lg-4 col-md-3">
				<form name="form-search" action="<?php echo URL;?>produto" method="post">
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
					<a href="<?php echo URL;?>produto/form" class="btn btn-success">Cadastrar <?php echo $this->title; ?></a>
				</div>
			</div>
		</div>

<!-- /.row -->

<div class="x_content">
<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>

<table class="table table-striped sortable table-condensed">
	<thead>
	<tr>
		<th style="text-align:left">Nome <small>(Marca)</small> </th>
		<th>Aro</th>
		<th>Cola</th>
		<th>Vidro</th>
		<th>Polarizador</th>
		<th>LCD</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $this->listarProduto as $produto ) { ?>
	<tr>
		<td style="text-align:left"><?php echo $produto->getName(); ?> <small>( <?php echo $produto->getMarca()->getName(); ?> )</small></td>
		<td><?php echo 'US$ ' . Data::formataMoeda($produto->getAro());?></td>
		<td><?php echo 'US$ ' . Data::formataMoeda($produto->getCola());?></td>
		<td><?php echo 'US$ ' . Data::formataMoeda($produto->getVidro());?></td>
		<td><?php echo 'US$ ' . Data::formataMoeda($produto->getPolarizador());?></td>
		<td><?php echo 'R$ ' . Data::formataMoeda($produto->getLcd());?></td>
		<td style="text-align:right">
			<a href="<?php echo URL;?>produto/form/<?php echo $produto->getId_produto();?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
			<a href="<?php echo URL;?>produto/delete/<?php echo $produto->getId_produto();?>" class="delete btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
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
