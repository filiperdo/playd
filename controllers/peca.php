<?php 

class Peca extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Peça";
		$this->view->listarPeca = $this->model->listarPeca();

		$this->view->render( "header" );
		$this->view->render( "peca/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Peça";
		$this->view->action = "create";
		$this->view->obj = $this->model;
		
		/*************************************
		 * Instancia do fornecedor
		 */
		require 'models/fornecedor_model.php';
		$objFornecedor = new Fornecedor_Model();
		$this->view->listarFornecedor = $objFornecedor->listarFornecedor();
		/******************************************/
		
		/*************************************
		 * Instancia do produto
		 */
		require 'models/produto_model.php';
		$objProduto = new Produto_Model();
		$this->view->listarProduto = $objProduto->listarProduto();
		/******************************************/
		
		/*************************************
		 * Instancia da marca
		 */
		require 'models/marca_model.php';
		$objMarca = new Marca_Model();
		$this->view->listarMarca = $objMarca->listarMarca();
		/******************************************/
		
		/*************************************
		 * Instancia do status
		 */
		require 'models/statuspeca_model.php';
		$objStatus = new Statuspeca_Model();
		$this->view->listarStatus = $objStatus->listarStatuspeca();
		/******************************************/
		
		if( $id ) 
		{
			$this->view->title = "Editar Peça";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterPeca( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "peca/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'name' 				=> $_POST["name"], 
			'codigo' 			=> $_POST["codigo"], 
			'qrcode' 			=> $_POST["qrcode"], 
			'date' 				=> $_POST["date"], 
			'id_user' 			=> $_POST["id_user"], 
			'id_fornecedor' 	=> $_POST["id_fornecedor"], 
			'id_marca' 			=> $_POST["id_marca"], 
			'id_statuspeca' 	=> $_POST["id_statuspeca"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "peca?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array( 
			'name' 				=> $_POST["name"], 
			'codigo' 			=> $_POST["codigo"], 
			'qrcode' 			=> $_POST["qrcode"], 
			'id_fornecedor' 	=> $_POST["id_fornecedor"], 
			'id_marca' 			=> $_POST["id_marca"], 
			'id_statuspeca' 	=> $_POST["id_statuspeca"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "peca?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "peca?st=".$msg);
	}
}
