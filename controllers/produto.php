<?php 

class Produto extends Controller {

	public function __construct() {
		parent::__construct();
		Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Produto";
		$this->view->listarProduto = $this->model->listarProduto();

		$this->view->render( "header" );
		$this->view->render( "produto/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Produto";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		/*************************************
		 * Instancia da marca
		 */
		require 'models/marca_model.php';
		$objMarca = new Marca_Model();
		$this->view->listarMarca = $objMarca->listarMarca();
		/******************************************/
		
		if( $id ) 
		{
			$this->view->title = "Editar Produto";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterProduto( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "produto/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array( 
			'name' 		=> $_POST["name"],
			'id_marca'	=> $_POST['marca']	
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "produto?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			'name' 		=> $_POST["name"],
			'id_marca'	=> $_POST['marca']
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "produto?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "produto?st=".$msg);
	}
}
