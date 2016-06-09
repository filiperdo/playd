<?php 

class Visita extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Visita";
		$this->view->listarVisita = $this->model->listarVisita();
		$this->view->model = $this->model;
		
		$this->view->render( "header" );
		$this->view->render( "visita/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Visita";
		$this->view->action = "create";
		$this->view->obj = $this->model;
		$this->view->id_cidade = isset( $_GET['cidade'] ) ? $_GET['cidade'] : '';
		
		$this->view->js[] = 'bootstrap-datepicker.js';
		$this->view->css[] = 'bootstrap-datepicker.css';		
		
		if( $id ) 
		{
			$this->view->title = "Editar Visita";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterVisita( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "visita/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'obs' 			=> $_POST["obs"], 
			'data' 			=> Data::formataDataBD( $_POST["data"] ), 
			'id_cidade' 	=> $_POST["id_cidade"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "visita?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			'obs' 			=> $_POST["obs"], 
			'data' 			=> Data::formataDataBD( $_POST["data"] )
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "visita?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "visita?st=".$msg);
	}
}
