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
					<li><a href="<?php echo URL;?>fornecedor">Fornecedores</a></li>
					<li class="active"><?php echo $this->title; ?></li>
				</ol>
			</div>

		</div>
	</div>

<div class="x_content">
<table class="table table-striped sortable table-condensed">
	<thead>
	<tr>

		<th style="text-align:left">Produto / Marca </th>
		<th>Valor</th>
		<th>Quantidade</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $this->listarQuantitativo as $amount ) { ?>
	<tr>
		<td style="text-align:left"><?php echo $amount['nome_produto'] . ' / ' . $amount['nome_marca'] ; ?></td>
		<td><?php echo 'R$ ' . $amount['valor']; ?></td>
		<td><?php echo $amount['total']; ?></td>
		<td align="right"></td>
	</tr>
	<?php } ?>
	</tbody>
</table>

</div>
</div>
</div>
</div>
