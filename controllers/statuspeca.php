<?php 

class Statuspeca extends Controller {

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
		$this->view->title = "Statuspeca";
		$this->view->listarStatuspeca = $this->model->listarStatuspeca();

		$this->view->render( "header" );
		$this->view->render( "statuspeca/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Statuspeca";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Statuspeca";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterStatuspeca( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "statuspeca/form" );
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
			'id_statuspeca' => $_POST["id_statuspeca"], 
>>>>>>> 34b1e18370ba8688d6d719a3c6276197d1a13910
			'name' => $_POST["name"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "statuspeca?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
<<<<<<< HEAD
=======
			"id_statuspeca" 	=> $id,
			'id_statuspeca' => $_POST["id_statuspeca"], 
>>>>>>> 34b1e18370ba8688d6d719a3c6276197d1a13910
			'name' => $_POST["name"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "statuspeca?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "statuspeca?st=".$msg);
	}
}
