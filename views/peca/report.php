<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<div class="x_panel">
		<div class="x_title">
			<h2 class="page-header"><?php echo $this->title; ?></h2>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active"><a href="<?php echo URL;?>peca"><?php echo $this->title; ?></a></li>
					</ol>
				</div>

			</div>
		</div>


<div class="x_content">
<div class="row">
	<div class="col-md-6">
		<form action="<?php echo URL;?>peca/report" method="post" class="form-horizontal">
		<input type="hidden" name="action" value="report">
			<h4>Fornecedor</h4>
			<div class="form-group">

				<div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-sound-dolby"></i></span>
						<select name="fornecedor" class="form-control " required="required">
							<option value="todos">Todos</option>
							<?php foreach ( $this->listarFornecedor as $fornecedor ) { ?>
							<option value="<?php echo $fornecedor->getId_fornecedor(); ?>"><?php echo $fornecedor->getName(); ?></option>
							<?php } ?>
						</select>
					</div>
				</div><!-- col-sm-8 -->

				<div class="col-sm-4">
					<div class="checkbox">
					    <label>
					      <input type="checkbox" name="checkbox-power" value="1" checked="checked"> Considerar Power
					    </label>
					</div>
				</div><!-- col-sm-4 -->

			</div>

			<h4>Período a ser considerado</h4>
	        <div class="form-group">

				<!-- <label for="data_ini" class="col-sm-1 control-label">De&nbsp;&nbsp;</label> -->
				<div class="col-sm-4">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-calendar"></i></span>
						<input type="text" name="data_ini" required="required" class="form-control calendary" placeholder="__/__/____" />
					</div>
				</div>

				<!-- <label for="data_fim" class="col-sm-1 control-label">At&eacute;&nbsp;&nbsp;</label> -->
				<div class="col-sm-4">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-calendar"></i></span>
						<input type="text" name="data_fim" class="form-control calendary" placeholder="__/__/____" value="<?php echo date('d/m/Y')?>" />
					</div>
				</div>

			</div>

			<h4>Status a ser considerado</h4>
			<div class="form-group">
				<div class="col-sm-8">
					<select name="status" class="form-control " required="required">
						<option value="todos">Todos</option>
						<?php foreach ( $this->listarStatus as $status ) { ?>
						<option value="<?php echo $status->getId_statuspeca(); ?>"><?php echo $status->getName(); ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="control-group" style="margin-top: 20px">
				<input type="submit" name="emitir" id="emitir" class="btn btn-info" value="Emitir relat&oacute;rio" />
			</div>
		</form>
	</div><!-- col-md-6 -->

	<?php if( isset( $_POST['action'] ) ) { ?>
	<div class="col-md-6">
		<h5><?php echo '<strong>Fornecedor:</strong> ' . $this->nomeFornecedor ; ?></h5>
		<h5><?php echo '<strong>Status:</strong> <span class="text-'. $this->objStatus->getClass() .'"><i class="' . $this->objStatus->getIcon() .'"></i> ' . $this->objStatus->getName() . '</span>'; ?></h5>
		<h5><?php echo '<strong>Período:</strong> ' . $_POST['data_ini'] . ' - ' . $_POST['data_fim']; ?></h5>

		<table class="table table-striped sortable table-condensed">
			<thead>
			<tr>
				<th style="text-align:left">Produto</th>
				<th>Total</th>
				<th>Valor</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ( $this->objPeca->reportByStatus( $_POST['data_ini'], $_POST['data_fim'], $_POST['status'], $_POST['fornecedor'] ) as $report ) { ?>
			<tr>
				<td style="text-align:left"><?php echo $report['nome_produto'].' / '.$report['nome_marca'];?></td>
		 		<td><?php echo $report['total'];?></td>
		 		<td><?php echo $report['valor'];?></td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div><!-- col-md-6 -->

	<?php } ?>

</div>

</div>
</div>
</div>

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo URL; ?>util/select2/select2.min.css">
<!-- Select2 -->
<script src="<?php echo URL; ?>util/select2/select2.full.min.js"></script>

<!-- Page script -->
<script>
$(function () {
	//Initialize Select2 Elements
	$(".select2").select2();
});
</script>

<script>
$(function() {
	$(".delete").click(function(e) {
		var c = confirm("Deseja realmente deletar este registro?");
		if (c == false) return false;
	});
 });
</script>
