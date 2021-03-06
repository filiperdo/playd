<?php

class Fornecedor extends Controller {

	public function __construct() {
		parent::__construct();
		Auth::handleLogin();
	}

	/**
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Fornecedores";
		$this->view->listarFornecedor = $this->model->listarFornecedor();

		$this->view->render( "header" );
		$this->view->render( "fornecedor/index" );
		$this->view->render( "footer" );
	}

	public function amount()
	{
		$this->view->title = "Quantitativo";
		$this->view->listarQuantitativo = $this->model->listarQuantitativo( $_GET['id'] );

		$this->view->render( "header" );
		$this->view->render( "fornecedor/amount" );
		$this->view->render( "footer" );
	}

	/**
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Fornecedor";
		$this->view->action = "create";
		$this->view->obj = $this->model;
		$this->view->js[] = 'fornecedor.form.js';

		/**
		 * Instancia da classe Estado
		 */
		require_once 'models/estado_model.php';
		$objEstado = new Estado_Model();
		$this->view->listarEstado = $objEstado->listarEstadosUtilizados();

		/**
		 * Instancia da classe Cidade
		 */
		require_once 'models/cidade_model.php';
		$objCidade = new Cidade_Model();
		$this->view->listarCidade = $objCidade->listarCidadePorEstado( 25 ); // Sao paulo

		if( $id )
		{
			$this->view->title = "Editar Fornecedor";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterFornecedor( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "fornecedor/form" );
		$this->view->render( "footer" );
	}

	/**
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'name' 			=> $_POST["name"],
			'telefone' 		=> $_POST["telefone"],
			'email' 		=> $_POST["email"],
			'banco' 		=> $_POST["banco"],
			/* 'cidade' 	=> $_POST["cidade"],
			'estado' 		=> $_POST["estado"],  */
			'endereco' 		=> $_POST["endereco"],
			'note'			=> $_POST['note'],
			'id_cidade' 	=> $_POST["cidade"],
		);

		if( $id_fornecedor = $this->model->create( $data ) )
		{
			$msg = base64_encode( "OPERACAO_SUCESSO" );
		}
		else {
			$msg = base64_encode( "OPERACAO_ERRO" );
		}

		header( "location: " . URL . "peca/form/?st=".$msg."&f=" . $id_fornecedor );
	}

	/**
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			'name' 			=> $_POST["name"],
			'telefone' 		=> $_POST["telefone"],
			'email' 		=> $_POST["email"],
			'banco' 		=> $_POST["banco"],
			/* 'cidade' 	=> $_POST["cidade"],
			'estado' 		=> $_POST["estado"],  */
			'endereco' 		=> $_POST["endereco"],
			'note'			=> $_POST['note'],
			'id_cidade' 	=> $_POST["cidade"],
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "fornecedor?st=".$msg);
	}

	/**
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "fornecedor?st=".$msg);
	}


	/**
	 *
	 * @param unknown $id_estado
	 */
	public function listCityByState( $id_estado )
	{
		require_once 'models/cidade_model.php';
		$objCidade = new Cidade_Model();

		$html  = '';

		foreach( $objCidade->listarCidadePorEstado( $id_estado ) as $cidade )
		{
			$html .= '<option value="' . $cidade->getId_cidade() . '"> ';
			$html .= $cidade->getName();
			$html .= '</option>';
		}

		echo $html;
	}
}
