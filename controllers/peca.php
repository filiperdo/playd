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


		/*************************************
		 * Include QRcode
		 */
		/*require_once 'util/phpqrcode/qrlib.php';

		$this->view->dir = URL.'views/peca/temp/';

	    //ofcourse we need rights to create temp dir
	    if (!file_exists($this->view->dir))
	        mkdir($this->view->dir);

	    //$filename = $PNG_TEMP_DIR.'test.png';
        $this->view->filename = $this->view->dir.'test'.md5('teste').'.png';
        QRcode::png('teste', $this->view->filename, 'M', 10, 2);*/
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
		require_once 'models/config_model.php';
		$objConfig = new Config_Model();
		$this->view->config = $objConfig->obterConfig();
		/******************************************/

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
		$html .= '<option disabled selected>Selecione um produto</option>';

		foreach( $objProduto->listarProdutoPorMarca( $id_marca ) as $produto )
		{
			$html .= '<option value="' . $produto->getId_produto() . '"> ';
			$html .= $produto->getName();
			$html .= '</option>';
		}

		echo $html;
	}

	/**
	 * Metodo getCustoPeca
	 * @param unknown $id_marca
	 */
	public function getCustoPeca( $id_produto )
	{
		require 'models/produto_model.php';
		$objProduto = new Produto_Model();
		$objProduto->obterProduto( $id_produto );

		$dolar = 3.16;

		$soma = ( $objProduto->getAro() + $objProduto->getCola() + $objProduto->getVidro() + $objProduto->getPolarizador() ) * $dolar;

		$total = $soma + $objProduto->getlcd(); // soma separado pois nao e em dolar

		$dados = array(
			'aro'			=> $objProduto->getAro(),
			'cola'			=> $objProduto->getCola(),
			'vidro'			=> $objProduto->getVidro(),
			'polarizador'	=> $objProduto->getPolarizador(),
			'lcd'			=> $objProduto->getlcd(),
			'total'			=> $total
		);

		echo json_encode($dados);
	}


}
