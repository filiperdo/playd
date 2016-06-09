<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li class="active"><a href="<?php echo URL;?>visita"><?php echo $this->title; ?></a></li>
				</ol>
			</div>
			
		</div>
	</div>
</div>
<!-- /.row -->

<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>

<table class="table table-striped sortable table-condensed">
	<thead>
	<tr>
		<th>Id_visita </th>
		<th>Obs </th>
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
		<td><?php echo $visita->getObs(); ?></td>
		<td><?php echo Data::formataData( $visita->getData() ); ?></td>
		<td><?php echo $visita->getCidade()->getName(); ?></td>
		<td align="right">
			<a href="<?php echo URL;?>visita/form/<?php echo $visita->getId_visita();?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
			<a href="<?php echo URL;?>visita/delete/<?php echo $visita->getId_visita();?>" class="delete btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
		</td>
		</tr>
	<?php } ?>
	
	<?php } else { ?>
	
	<?php foreach( $this->listarVisita as $visita ) { ?>
	<tr>
 		<td><?php echo $visita->getId_visita(); ?></td>
		<td><?php echo $visita->getObs(); ?></td>
		<td><?php echo Data::formataData( $visita->getData() ); ?></td>
		<td><?php echo $visita->getCidade()->getName(); ?></td>
		<td align="right">
			<a href="<?php echo URL;?>visita/form/<?php echo $visita->getId_visita();?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
			<a href="<?php echo URL;?>visita/delete/<?php echo $visita->getId_visita();?>" class="delete btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
		</td>
		</tr>
	<?php } ?>
	
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