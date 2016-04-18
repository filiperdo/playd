<?php 

/** 
 * Classe Estado
 * @author __ 
 *
 * Data: 18/04/2016
 */ 


class Estado_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_estado;
	private $name;
	private $uf;

	public function __construct()
	{
		parent::__construct();

		$this->id_estado = '';
		$this->name = '';
		$this->uf = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_estado( $id_estado )
	{
		$this->id_estado = $id_estado;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	public function setUf( $uf )
	{
		$this->uf = $uf;
	}

	/** 
	* Metodos get's
	*/
	public function getId_estado()
	{
		return $this->id_estado;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getUf()
	{
		return $this->uf;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "estado", $data ) ){
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

		if( !$update = $this->db->update("estado", $data, "id_estado = {$id} ") ){
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

		if( !$delete = $this->db->delete("estado", "id_estado = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterEstado
	*/
	public function obterEstado( $id_estado )
	{
		$sql  = "select * ";
		$sql .= "from estado ";
		$sql .= "where id_estado = :id ";

		$result = $this->db->select( $sql, array("id" => $id_estado) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarEstado
	*/
	public function listarEstado()
	{
		$sql  = "select * ";
		$sql .= "from estado ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_estado like :id "; // Configurar o like com o campo necessario da tabela 
			$result = $this->db->select( $sql, array("id" => "%{$_POST["like"]}%") );
		}
		else
			$result = $this->db->select( $sql );

		return $this->montarLista($result);
	}
	
	/**
	 * Metodo listarEstado 
	 * Lista apenas os estado que tem cidades cadastradas
	 */
	public function listarEstadosUtilizados()
	{
		$sql  = 'select e.* ';
		$sql .= 'from estado as e ';
		$sql .= 'inner join cidade as c ';
		$sql .= 'on c.id_estado = e.id_estado ';
		$sql .= 'group by e.id_estado ';
		
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
		$this->setId_estado( $row["id_estado"] );
		$this->setName( $row["name"] );
		$this->setUf( $row["uf"] );

		return $this;
	}
}
?>