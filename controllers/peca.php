<?php 

class Peca extends Controller {

	public function __construct() {
		parent::__construct();
		Auth::handleLogin();
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
		$this->view->js[] = 'peca.form.js';
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
		require_once 'models/statuspeca_model.php';
		
		for( $i = 0; $i < $_POST['quantidade']; $i++ )
		{
			$data = array(
				'id_user' 			=> Session::get('userid'), 
				'id_fornecedor' 	=> $_POST["fornecedor"], 
				'id_produto' 		=> $_POST["produto"], 
				'id_statuspeca' 	=> Statuspeca_Model::EM_ABERTO, 
			);
	
			//var_dump($data);
			
			$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );
		
		}
		header("location: " . URL . "peca?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array( 
			'codigo' 			=> $_POST["codigo"], 
			'qrcode' 			=> $_POST["qrcode"], 
			'id_fornecedor' 	=> $_POST["id_fornecedor"], 
			'id_produto'		=> $_POST["id_produto"], 
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
	
	/**
	 * 
	 * @param unknown $id_marca
	 */
	public function listProdByMarca( $id_marca )
	{
		require 'models/produto_model.php';
		$objProduto = new Produto_Model();
		
		$html  = '';
		
		foreach( $objProduto->listarProdutoPorMarca( $id_marca ) as $produto )
		{
			$html .= '<option value="' . $produto->getId_produto() . '"> ';
			$html .= $produto->getName(); 
			$html .= '</option>';
		}

		ini_set('default_charset', 'ISO-8859-1');
		echo $html;
	}
}
