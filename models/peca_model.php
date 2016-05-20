<?php 

/** 
 * Classe Peca
 * @author __ 
 *
 * Data: 02/03/2016
 */
class Peca_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $peca;
	private $codigo;
	private $valor;
	private $nome_fornecedor;
	private $date;
	private $user;
	private $fornecedor;
	private $cor;
	private $produto;
	private $statuspeca;

	public function __construct()
	{
		parent::__construct();

		$this->id_peca = '';
		$this->codigo = '';
		$this->valor = '';
		$this->nome_fornecedor = '';
		$this->date = '';
		$this->user = '';
		$this->fornecedor = '';
		$this->cor = '';
		$this->produto = '';
		$this->statuspeca = '';

	}

	/** 
	* Metodos set's
	*/
	public function setId_peca( $id_peca )
	{
		$this->id_peca = $id_peca;
	}

	public function setCodigo( $codigo )
	{
		$this->codigo = $codigo;
	}

	public function setValor( $valor )
	{
		$this->valor = $valor;
	}

	public function setNomeFornecedor( $nome_fornecedor )
	{
		$this->nome_fornecedor = $nome_fornecedor;
	}
	
	public function setDate( $date )
	{
		$this->date = $date;
	}
	
	public function setUser( $user )
	{
		$this->user = $user;
	}
	
	public function setFornecedor( $fornecedor )
	{
		$this->fornecedor = $fornecedor;
	}
	
	public function setCor( $cor )
	{
		$this->cor = $cor;
	}
	
	public function setProduto( $produto )
	{
		$this->produto = $produto;
	}
	
	public function setStatuspeca( $statuspeca )
	{
		$this->statuspeca = $statuspeca;
	}
	
	/** 
	* Metodos get's
	*/
	public function getId_peca()
	{
		return $this->id_peca;
	}

	public function getCodigo()
	{
		return $this->codigo;
	}

	public function getValor()
	{
		return $this->valor;
	}
	
	public function getNomeFornecedor()
	{
		return $this->nome_fornecedor;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function getFornecedor()
	{
		return $this->fornecedor;
	}
	
	public function getCor()
	{
		return $this->cor;
	}

	public function getProduto()
	{
		return $this->produto;
	}

	public function getStatuspeca()
	{
		return $this->statuspeca;
	}

	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		//$this->db->beginTransaction();

		if( !$id_peca = $this->db->insert( "peca", $data ) ){
			$this->db->rollBack();
			return false;
		}
		
		/************************************
		 * Inicio do Datalog
		 */
		require_once 'logpeca_model.php';
		$objLog = new Logpeca_Model();

		$data_log = array(
			'id_peca' 		=> $id_peca,
			'id_user' 		=> Session::get('userid'),
			'id_statuspeca' => Statuspeca_Model::EM_ABERTO,
		);
		
		if( !$id = $this->db->insert( "logpeca", $data_log ) ){
			$this->db->rollBack();
			return false;
		}
		/**
		 * Fim Datalog
		 *************************************/
		
		//$this->db->commit();
		return true;
	}

	/** 
	* Metodo edit
	*/
	public function edit( $data, $id )
	{
		$this->db->beginTransaction();

		if( !$update = $this->db->update("peca", $data, "id_peca = {$id} ") ){
			$this->db->rollBack();
			return false;
		}
		
		$this->db->commit();
		return $update;
	}
	
	/**
	 * Metodo edit
	 */
	public function editStatus( $data, $id )
	{
		$this->db->beginTransaction();
	
		if( !$update = $this->db->update("peca", $data, "id_peca = {$id} ") ){
			$this->db->rollBack();
			return false;
		}
	
		/**
		 * Inicio do Datalog
		 */
		require_once 'logpeca_model.php';
		$objLog = new Logpeca_Model();
		
		$data_log = array(
				'id_peca' 		=> $id,
				'id_user' 		=> Session::get('userid'),
				'id_statuspeca' => $data['id_statuspeca']
		);
	
		if( !$id_datalog = $this->db->insert( "logpeca", $data_log ) ){
			$this->db->rollBack();
			return false;
		}
		/**
		 * Fim Datalog
		 *************************************/
		
		/**
		 * Se for PRONTA VERDE ou PRONTA AMARELA
		 * Atualiza o log novamente para ENTREGUE
		 */
		require_once 'models/statuspeca_model.php';
		if( $data['id_statuspeca'] == Statuspeca_Model::PRONTO_AMARELO || $data['id_statuspeca'] == Statuspeca_Model::PRONTO_VERDE )
		{
			// Edita o status
			$dados_peca = array(
				'id_statuspeca' => Statuspeca_Model::ENTREGUE
			);
			
			if( !$update = $this->db->update("peca", $dados_peca, "id_peca = {$id} ") ){
				$this->db->rollBack();
				return false;
			}
			// -------------------------
			
			// Edita o log
			$data_log = array(
					'id_peca' 		=> $id,
					'id_user' 		=> Session::get('userid'),
					'id_statuspeca' => Statuspeca_Model::ENTREGUE
			);
			
			if( !$id_datalog = $this->db->insert( "logpeca", $data_log ) ){
				$this->db->rollBack();
				return false;
			}
		}
		/**
		 * Fim if
		 *************************************/
	
		$this->db->commit();
		return $update;
	}
	
	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->db->beginTransaction();
		
		/**
		 * Deleta a peca
		 */
		if( !$delete = $this->db->delete("peca", "id_peca = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterPeca
	*/
	public function obterPeca( $id_peca )
	{
		$sql  = "select * ";
		$sql .= "from peca ";
		$sql .= "where id_peca = :id ";

		$result = $this->db->select( $sql, array("id" => $id_peca) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarPeca
	*/
	public function listarPeca()
	{
		$sql  = "select * ";
		$sql .= "from peca as p ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_peca = :id "; // Configurar o like com o campo necessario da tabela
			$sql .= 'order by p.id_peca desc ';
			$sql .= 'limit 100 ';
			$result = $this->db->select( $sql, array("id" => $_POST["like"]) );
		}
		else
		{
			$sql .= 'order by p.id_peca desc ';
			$sql .= 'limit 100 ';
			$result = $this->db->select( $sql );
		}

		return $this->montarLista($result);
	}

	public function getTotalByStatus( $id_status, $contar_log = false )
	{
		if( $contar_log )
		{
			$sql  = 'select distinct count(*) as total  ';
			$sql .= 'from logpeca as p ';
			$sql .= 'where p.id_statuspeca = :id_status ';
		}
		else
		{
			$sql  = 'select count(*) as total  ';
			$sql .= 'from peca as p ';
			$sql .= 'where p.id_statuspeca = :id_status ';
		}
		
		$result = $this->db->select( $sql, array( "id_status" => $id_status ) );
		
		return $result[0]['total'];
	}
	
	
	public function obterTotalPecasPorFornecedor( $id_fornecedor )
	{
		$sql  = 'select count(p.id_peca) as total ';
		$sql .= 'from peca as p ';
		$sql .= "where p.id_fornecedor = :id_fornecedor ";
		
		$result = $this->db->select( $sql, array( "id_fornecedor" => $id_fornecedor ) );
		return $result[0];
		
	}
	
	/** 
	* Metodo montarLista
	*/
	private function montarLista( $result )
	{
		$objs = array();
		if( !empty( $result ) )
		{
			foreach( $result as $row )
			{
				$obj = new self();
				$obj->montarObjeto( $row );
				$objs[] = $obj;
				$obj = null;
			}
		}
		return $objs;
	}

	/** 
	* Metodo montarObjeto
	*/
	private function montarObjeto( $row )
	{
		$this->setId_peca( $row["id_peca"] );
		$this->setCodigo( $row["codigo"] );
		$this->setValor( $row["valor"] );
		$this->setNomeFornecedor( $row['fornecedor'] );
		$this->setDate( $row["date"] );
		$this->setCor( $row['cor'] );
		
		require_once 'models/user_model.php';
		$objUser = new User_Model();
		$this->setUser( $objUser->obterUser( $row["id_user"] ) );
		
		require_once 'models/fornecedor_model.php';
		$objFornecedor = new Fornecedor_Model();
		$this->setFornecedor( $objFornecedor->obterFornecedor( $row["id_fornecedor"] ) );
		
		require_once 'models/produto_model.php';
		$objProduto = new Produto_Model();
		$this->setProduto( $objProduto->obterProduto( $row["id_produto"] ) );
		
		require_once 'models/statuspeca_model.php';
		$objStatus = new Statuspeca_Model();
		$this->setStatuspeca( $objStatus->obterStatuspeca( $row["id_statuspeca"] ) );
		
		return $this;
	}
	
}
?>