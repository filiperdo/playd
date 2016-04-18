<?php 

/** 
 * Classe Cidade
 * @author __ 
 *
 * Data: 18/04/2016
 */ 

include_once 'estado_model.php';

class Cidade_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_cidade;
	private $name;
	private $estado;

	public function __construct()
	{
		parent::__construct();

		$this->id_cidade = '';
		$this->name = '';
		$this->estado = new Estado_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setId_cidade( $id_cidade )
	{
		$this->id_cidade = $id_cidade;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	public function setEstado( Estado_Model $estado )
	{
		$this->estado = $estado;
	}

	/** 
	* Metodos get's
	*/
	public function getId_cidade()
	{
		return $this->id_cidade;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getEstado()
	{
		return $this->estado;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "cidade", $data ) ){
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

		if( !$update = $this->db->update("cidade", $data, "id_cidade = {$id} ") ){
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

		if( !$delete = $this->db->delete("cidade", "id_cidade = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterCidade
	*/
	public function obterCidade( $id_cidade )
	{
		$sql  = "select * ";
		$sql .= "from cidade ";
		$sql .= "where id_cidade = :id ";

		$result = $this->db->select( $sql, array("id" => $id_cidade) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarCidade
	*/
	public function listarCidade()
	{
		$sql  = "select * ";
		$sql .= "from cidade ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_cidade like :id "; // Configurar o like com o campo necessario da tabela 
			$result = $this->db->select( $sql, array("id" => "%{$_POST["like"]}%") );
		}
		else
			$result = $this->db->select( $sql );

		return $this->montarLista($result);
	}
	
	/**
	 * Listar Cidades por estados
	 */
	public function listarCidadePorEstado( $id_estado )
	{
		$sql  = "select * ";
		$sql .= "from cidade as c ";
		$sql .= "where c.id_estado = {$id_estado} ";
		
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
		$this->setId_cidade( $row["id_cidade"] );
		$this->setName( $row["name"] );

		$objEstado = new Estado_Model();
		$objEstado->obterEstado( $row["id_estado"] );
		$this->setEstado( $objEstado );

		return $this;
	}
}
?>