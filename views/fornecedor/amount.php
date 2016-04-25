<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
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
</div>
<!-- /.row -->

<table class="table table-striped sortable table-condensed">
	<thead>
	<tr>
		
		<th>Produto / Marca </th>
		<th>Valor</th>
		<th>Quantidade</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $this->listarQuantitativo as $amount ) { ?>
	<tr>
 		
		<td><?php echo $amount['nome_produto'] . ' / ' . $amount['nome_marca'] ; ?></td>
		<td><?php echo 'R$ ' . $amount['valor']; ?></td>
		<td><?php echo $amount['total']; ?></td>
		<td align="right"></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

