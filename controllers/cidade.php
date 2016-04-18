<?php 

class Cidade extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Cidade";
		$this->view->listarCidade = $this->model->listarCidade();

		$this->view->render( "header" );
		$this->view->render( "cidade/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Cidade";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		/**
		 * Instancia da classe Estado
		 */
		require_once 'models/estado_model.php';
		$objEstado = new Estado_Model();
		$this->view->listarEstado = $objEstado->listarEstado();
		
		if( $id ) 
		{
			$this->view->title = "Editar Cidade";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterCidade( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "cidade/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'name' 		=> $_POST["name"], 
			'id_estado' => $_POST["estado"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "cidade?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			'name' 		=> $_POST["name"], 
			'id_estado' => $_POST["estado"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "cidade?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "cidade?st=".$msg);
	}
}
