<?php 

class Logpeca extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Logpeca";
		$this->view->listarLogpeca = $this->model->listarLogpeca();

		$this->view->render( "header" );
		$this->view->render( "logpeca/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Logpeca";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Logpeca";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterLogpeca( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "logpeca/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'id_logpeca' => $_POST["id_logpeca"], 
			'color' => $_POST["color"], 
			'date' => $_POST["date"], 
			'id_peca' => $_POST["id_peca"], 
			'id_user' => $_POST["id_user"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "logpeca?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			"id_logpeca" 	=> $id,
			'id_logpeca' => $_POST["id_logpeca"], 
			'color' => $_POST["color"], 
			'date' => $_POST["date"], 
			'id_peca' => $_POST["id_peca"], 
			'id_user' => $_POST["id_user"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "logpeca?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "logpeca?st=".$msg);
	}
}
