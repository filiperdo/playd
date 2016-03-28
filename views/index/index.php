<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		
	</div>
</div>
<!-- /.row -->

<div class="row">
	<div class="col-lg-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Em aberto</h3>
			</div>
			<div class="panel-body">
				<h3><?php echo $this->getTotal['EM_ABERTO'];?></h3>
			</div>  
		</div>
	</div>
	<div class="col-lg-3">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Prontas Verdes</h3>
			</div>
			<div class="panel-body">
				<h3><?php echo $this->getTotal['PRONTO_VERDE'];?></h3>
			</div>  
		</div>
	</div>
	<div class="col-lg-3">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<h3 class="panel-title">Prontas Amarelas</h3>
			</div>
			<div class="panel-body">
				<h3><?php echo $this->getTotal['PRONTO_AMARELO'];?></h3>
			</div>  
		</div>
	</div>
	<div class="col-lg-3">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Aguardando Flex</h3>
			</div>
			<div class="panel-body">
				<h3><?php echo $this->getTotal['AGUARDANDO_FLEX'];?></h3>
			</div>  
		</div>
	</div>
</div><!-- /.row -->

