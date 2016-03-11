<?php 

class Marca extends Controller {

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
		$this->view->title = "Marca";
		$this->view->listarMarca = $this->model->listarMarca();

		$this->view->render( "header" );
		$this->view->render( "marca/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Marca";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Marca";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterMarca( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "marca/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
<<<<<<< HEAD
		$data = array(		
=======
		$data = array(
			'id_marca' => $_POST["id_marca"], 
>>>>>>> 34b1e18370ba8688d6d719a3c6276197d1a13910
			'name' => $_POST["name"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "marca?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array( 
			'name' => $_POST["name"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "marca?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "marca?st=".$msg);
	}
}
