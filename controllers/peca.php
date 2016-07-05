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
		$this->view->title = "Peças";
		$this->view->listarPeca = $this->model->listarPeca();
		$this->view->js[] = 'peca.index.js';
		
		/*************************************
		 * Instancia do status
		 */
		require_once 'models/statuspeca_model.php';
		$objStatus = new Statuspeca_Model();
		$this->view->listarStatus = $objStatus->listarStatuspeca();
		/******************************************/
		
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
		
		$this->view->gfornecedor = isset( $_GET['f'] ) ? $_GET['f'] : '';
		
		/*************************************
		 * Instancia do fornecedor
		 */
		require_once 'models/fornecedor_model.php';
		$objFornecedor = new Fornecedor_Model();
		$this->view->listarFornecedor = $objFornecedor->listarFornecedor();
		/******************************************/
		
		/*************************************
		 * Instancia do produto
		 */
		require_once 'models/produto_model.php';
		$objProduto = new Produto_Model();
		$this->view->listarProduto = $objProduto->listarProduto();
		/******************************************/
		
		/*************************************
		 * Instancia da marca
		 */
		require_once 'models/marca_model.php';
		$objMarca = new Marca_Model();
		$this->view->listarMarca = $objMarca->listarMarca();
		/******************************************/
		
		/*************************************
		 * Instancia do status
		 */
		require_once 'models/statuspeca_model.php';
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
	 * Metodo report // relatorio
	 */
	public function report()
	{
		$this->view->title = "Relatórios";
		$this->view->js[] = 'bootstrap-datepicker.js';
		$this->view->css[] = 'bootstrap-datepicker.css';
		$this->view->nomeStatus = '';
		
		require_once 'models/peca_model.php';
		$this->view->objPeca = new Peca_Model();
		
		
		
		require_once 'models/fornecedor_model.php';
		$objFornecedor = new Fornecedor_Model();
		$this->view->listarFornecedor = $objFornecedor->listarFornecedor();
		
		require_once 'models/statuspeca_model.php';
		$objStatus = new Statuspeca_Model();
		$this->view->listarStatus = $objStatus->listarStatuspeca();
		
		if( isset( $_POST['fornecedor'] ) )
		{
			$objStatus->obterStatuspeca($_POST['status']);
			$this->view->objStatus = $objStatus;
			
			if( $_POST['fornecedor'] != 'todos' )
			{
				$objFornecedor->obterFornecedor( $_POST['fornecedor'] );
				$this->view->nomeFornecedor = $objFornecedor->getName();
			}
			else {
				$this->view->nomeFornecedor = 'TODOS';
			}
		}
		
		$this->view->render('header');
		$this->view->render('peca/report');
		$this->view->render('footer');
	}
	
	
	/** 
	* Metodo create
	*/
	public function create()
	{
		require_once 'models/statuspeca_model.php';
		
		$this->model->db->beginTransaction();
		
		for( $i = 0; $i < $_POST['quantidade']; $i++ )
		{
			$data = array(
				'id_user' 			=> Session::get('userid'),
				'fornecedor'		=> $_POST['nome_fornecedor'], 
				'id_fornecedor' 	=> $_POST["id_fornecedor"], 
				'id_produto' 		=> $_POST["produto"], 
				'id_statuspeca' 	=> Statuspeca_Model::EM_ABERTO,
				'valor'				=> $_POST['valor']
			);
	
			$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );
			
		}
		
		$this->model->db->commit();
		
		header("location: " . URL . "peca?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{

		$data = array(  
			'valor' 			=> $_POST["valor"], 
			'id_fornecedor' 	=> $_POST["id_fornecedor"], 
			'id_produto'		=> $_POST["id_produto"], 
			'id_statuspeca' 	=> $_POST["id_statuspeca"], 
		);
		
		// Chamar metodo de log para edicao das pecas
		
		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "peca?st=".$msg);
	}
	
	public function editStatus()
	{
		$data = array(
			'id_statuspeca' => $_POST["status"],
			'cor'			=> isset( $_POST['cor'] ) ? $_POST['cor'] : NULL
		);
		
		$this->model->editStatus( $data, $_POST['idPeca'] ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );
		
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
