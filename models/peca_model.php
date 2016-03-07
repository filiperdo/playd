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
	private $name;
	private $codigo;
	private $qrcode;
	private $date;
	private $user;
	private $fornecedor;
	private $marca;
	private $statuspeca;

	public function __construct()
	{
		parent::__construct();

		$this->id_peca = '';
		$this->name = '';
		$this->codigo = '';
		$this->qrcode = '';
		$this->date = '';
		$this->id_user = '';
		$this->id_fornecedor = '';
		$this->id_marca = '';
		$this->id_statuspeca = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_peca( $id_peca )
	{
		$this->id_peca = $id_peca;
	}

	public function setName( $name )
	{
		$this->name = $name;
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

	public function setId_user( $id_user )
	{
		$this->id_user = $id_user;
	}

	public function setId_fornecedor( $id_fornecedor )
	{
		$this->id_fornecedor = $id_fornecedor;
	}

	public function setId_marca( $id_marca )
	{
		$this->id_marca = $id_marca;
	}

	public function setId_statuspeca( $id_statuspeca )
	{
		$this->id_statuspeca = $id_statuspeca;
	}

	/** 
	* Metodos get's
	*/
	public function getId_peca()
	{
		return $this->id_peca;
	}

	public function getName()
	{
		return $this->name;
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

	public function getId_user()
	{
		return $this->id_user;
	}

	public function getId_fornecedor()
	{
		return $this->id_fornecedor;
	}

	public function getId_marca()
	{
		return $this->id_marca;
	}

	public function getId_statuspeca()
	{
		return $this->id_statuspeca;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "peca", $data ) ){
			$this->db->rollBack();
			return false;
		}

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
		$sql .= "from peca ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_peca like :id "; // Configurar o like com o campo necessario da tabela 
			$result = $this->db->select( $sql, array("id" => "%{$_POST["like"]}%") );
		}
		else
			$result = $this->db->select( $sql );

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
		$this->setName( $row["name"] );
		$this->setCodigo( $row["codigo"] );
		$this->setQrcode( $row["qrcode"] );
		$this->setDate( $row["date"] );
		$this->setId_user( $row["id_user"] );
		$this->setId_fornecedor( $row["id_fornecedor"] );
		$this->setId_marca( $row["id_marca"] );
		$this->setId_statuspeca( $row["id_statuspeca"] );

		return $this;
	}
}
?>