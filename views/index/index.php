<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		
	</div>
</div>
<!-- /.row -->

<div class="row">
	<div class="col-lg-6 col-sm-6">
	
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
			<td><span class="text-<?php echo $status->getClass();?>"><?php echo $this->objPeca->getTotalByStatus( $status->getId_statuspeca() );?></span></td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
	
	</div>
	
</div><!-- /.row -->

