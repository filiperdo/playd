<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->title; ?></h1>
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li class="active"><a href="<?php echo URL;?>peca"><?php echo $this->title; ?></a></li>
				</ol>
			</div>
			<div class="col-lg-4 col-md-3">
			<form name="form-search" action="<?php echo URL;?>peca" method="post">
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
				<a href="<?php echo URL;?>peca/form" class="btn btn-success">Cadastrar <?php echo $this->title; ?></a>
			</div>
		</div>
	</div>
</div>
<!-- /.row -->

<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>

<table class="table table-striped sortable table-condensed">
	<thead>
	<tr>
		<th>Codigo </th>
		<th>Produto / Marca </th>
		<th>Fornecedor </th>
		<th>User </th>
		<th>Data </th>
		<th>Status </th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $this->listarPeca as $peca ) { ?>
	<tr>
 		<td><?php echo str_pad( $peca->getId_peca(), 3, "0", STR_PAD_LEFT); ?></td>
		<td><?php echo $peca->getProduto()->getName() . ' / ' . $peca->getProduto()->getMarca()->getName(); ?></td>
		<td><?php echo $peca->getFornecedor()->getName(); ?></td>
		<td><?php echo $peca->getUser()->getName(); ?></td>
		<td><?php echo Data::formataDataRetiraHora($peca->getDate()); ?></td>
		<td><?php echo $peca->getStatuspeca()->getName(); ?></td>
		<td align="right">
			<button type="button" class="btn btn-primary btn-sm btn-editStatus" id="<?php echo $peca->getId_peca(); ?>" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-pencil"></i></button>
			<a href="<?php echo URL;?>peca/form/<?php echo $peca->getId_peca();?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
			<a href="<?php echo URL;?>peca/delete/<?php echo $peca->getId_peca();?>" class="delete btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
		</td>
	</tr>
	<?php } ?>
	</tbody>
</table>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
    <form id="form1" name="form1" method="post" action="<?php echo URL;?>peca/editStatus/">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar peça</h4>
      </div>
      <div class="modal-body">

		<div class="row">
		
		<div class="col-md-6 col-sm-6 col-lg-6">
		<input type="hidden" name="idPeca" id="idPeca" value="" />
		
		<div class="form-group">
			<label for="status">Status</label> 
			<select name="status" id="status" class="form-control">
			<option value="0" disabled="disabled" selected="selected">Selecione o status</option>
			<?php foreach( $this->listarStatus as $status ) { ?>
				<option value="<?php echo $status->getId_statuspeca();?>"><?php echo $status->getName();?></option>
			<?php } ?>
			</select>
		</div>
		
		</div>
		</div>
		
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Salvar</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
      </div>
      
      </form>
      
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