<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		
	</div>
</div>
<!-- /.row -->

<div class="row">

	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="glyphicon glyphicon-tag"></i> Em aberto</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>Aparelho</th>
								<th>Qtde</th>
								<th>V</th>
								<th>A</th>
							</tr>
						</thead>
						
						<tbody>
						<?php foreach( $this->objProduto->listarProdutoPorStatus( Statuspeca_Model::EM_ABERTO ) as $row ) { ?>
							<tr>
								<td><?php echo strtoupper($row['name']);?></td>
								<td><?php echo $row['total'];?></td>
								<td><?php echo '';?></td>
								<td><?php echo '';?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="text-right">
					<a href="#">Visualizar todos <i class="glyphicon glyphicon-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>


	<div class="col-lg-4">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="glyphicon glyphicon-thumbs-down"></i> Quebrados</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>Aparelho</th>
								<th>Qtde</th>
								<th>V</th>
								<th>A</th>
							</tr>
						</thead>
						
						<tbody>
						<?php foreach( $this->objProduto->listarProdutoPorStatus( Statuspeca_Model::QUEBRADO ) as $row ) { ?>
							<tr>
								<td><?php echo strtoupper($row['name']);?></td>
								<td><?php echo $row['total'];?></td>
								<td><?php echo '';?></td>
								<td><?php echo '';?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="text-right">
					<a href="#">Visualizar todos <i class="glyphicon glyphicon-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-4">
	<fieldset>
		<legend>Total</legend>
		<table class="table table-hover">
		<thead>
			<tr>
				<th>Status</th>
				<th>Qtde</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ( $this->objStatus->listarStatuspeca() as $status ) { ?>
			<tr>
				<td><span class="text-<?php echo $status->getClass();?>"><i class="<?php echo $status->getIcon(); ?>"></i> <?php echo $status->getName();?></span></td>
				<?php if( $status->getId_statuspeca() == Statuspeca_Model::PRONTO_AMARELO || $status->getId_statuspeca() == Statuspeca_Model::PRONTO_VERDE ) { ?>
				<td><span class="text-<?php echo $status->getClass();?>"><?php echo $this->objPeca->getTotalByStatus( $status->getId_statuspeca(), true );?></span></td>
				<?php } else { ?>
				<td><span class="text-<?php echo $status->getClass();?>"><?php echo $this->objPeca->getTotalByStatus( $status->getId_statuspeca() );?></span></td>
				<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
		</table>
	</fieldset>
	</div>
	
	
	
</div><!-- /.row -->




<div class="row">
	
	

</div><!-- /.row -->
