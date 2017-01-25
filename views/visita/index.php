<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<div class="x_panel">
		<div class="x_title">
		<h2 class="page-header"><?php echo $this->title.'s'; ?></h2>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li class="active"><a href="<?php echo URL;?>visita"><?php echo $this->title.'s'; ?></a></li>
				</ol>
			</div>

		</div>
	</div>


<div class="x_content">
<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>

<table class="table table-striped sortable table-condensed">
	<thead>
	<tr>
		<th>Id</th>
		<th style="text-align:left">Obs </th>
		<th>Data </th>
		<th>Cidade </th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php if( isset( $_GET['id_cidade'] ) ) { ?>

	<?php foreach( $this->model->listarVisitaPorCidade( $_GET['id_cidade'] ) as $visita ) { ?>
	<tr>
 		<td><?php echo $visita->getId_visita(); ?></td>
		<td style="text-align:left"><?php echo $visita->getObs(); ?></td>
		<td><?php echo Data::formataData( $visita->getData() ); ?></td>
		<td><?php echo $visita->getCidade()->getName(); ?></td>
		<td style="text-align:right">
			<a href="<?php echo URL;?>visita/form/<?php echo $visita->getId_visita();?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
			<a href="<?php echo URL;?>visita/delete/<?php echo $visita->getId_visita();?>" class="delete btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
		</td>
		</tr>
	<?php } ?>

	<?php } else { ?>

	<?php foreach( $this->listarVisita as $visita ) { ?>
	<tr>
 		<td><?php echo $visita->getId_visita(); ?></td>
		<td style="text-align:left"><?php echo $visita->getObs(); ?></td>
		<td><?php echo Data::formataData( $visita->getData() ); ?></td>
		<td><?php echo $visita->getCidade()->getName(); ?></td>
		<td style="text-align:right">
			<a href="<?php echo URL;?>visita/form/<?php echo $visita->getId_visita();?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
			<a href="<?php echo URL;?>visita/delete/<?php echo $visita->getId_visita();?>" class="delete btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
		</td>
		</tr>
	<?php } ?>

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
