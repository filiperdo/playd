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
	private $qrcode;
	private $date;
	private $user;
	private $fornecedor;
	private $produto;
	private $statuspeca;

	public function __construct()
	{
		parent::__construct();

		$this->id_peca = '';
		$this->codigo = '';
		$this->qrcode = '';
		$this->date = '';
		$this->user = '';
		$this->fornecedor = '';
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

	public function setQrcode( $qrcode )
	{
		$this->qrcode = $qrcode;
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

	public function getQrcode()
	{
		return $this->qrcode;
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
		$this->db->beginTransaction();

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
		
		$this->db->commit();
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

		/************************************
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
		
		$this->db->commit();
		return $update;
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->db->beginTransaction();

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
			$sql .= "where id_peca like :id "; // Configurar o like com o campo necessario da tabela
			$sql .= 'order by p.id_peca desc ';
			$result = $this->db->select( $sql, array("id" => "%{$_POST["like"]}%") );
		}
		else
		{
			$sql .= 'order by p.id_peca desc ';
			$result = $this->db->select( $sql );
		}

		return $this->montarLista($result);
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
		$this->setQrcode( $row["qrcode"] );
		$this->setDate( $row["date"] );
	
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