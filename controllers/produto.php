<?php 

class Produto extends Controller {

	public function __construct() {
		parent::__construct();
<<<<<<< HEAD
		Auth::handleLogin();
=======
		//Auth::handleLogin();
>>>>>>> 34b1e18370ba8688d6d719a3c6276197d1a13910
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
<<<<<<< HEAD
=======
			'id_produto' => $_POST["id_produto"], 
>>>>>>> 34b1e18370ba8688d6d719a3c6276197d1a13910
			'name' => $_POST["name"], 
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
<<<<<<< HEAD
=======
			"id_produto" 	=> $id,
			'id_produto' => $_POST["id_produto"], 
>>>>>>> 34b1e18370ba8688d6d719a3c6276197d1a13910
			'name' => $_POST["name"], 
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
