<?php 

/** 
 * Classe Statuspeca
 * @author __ 
 *
 * Data: 02/03/2016
 */
class Statuspeca_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $statuspeca;
	private $name;

	public function __construct()
	{
		parent::__construct();

		$this->id_statuspeca = '';
		$this->name = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_statuspeca( $id_statuspeca )
	{
		$this->id_statuspeca = $id_statuspeca;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	/** 
	* Metodos get's
	*/
	public function getId_statuspeca()
	{
		return $this->id_statuspeca;
	}

	public function getName()
	{
		return $this->name;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "statuspeca", $data ) ){
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

		if( !$update = $this->db->update("statuspeca", $data, "id_statuspeca = {$id} ") ){
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

		if( !$delete = $this->db->delete("statuspeca", "id_statuspeca = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterStatuspeca
	*/
	public function obterStatuspeca( $id_statuspeca )
	{
		$sql  = "select * ";
		$sql .= "from statuspeca ";
		$sql .= "where id_statuspeca = :id ";

		$result = $this->db->select( $sql, array("id" => $id_statuspeca) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarStatuspeca
	*/
	public function listarStatuspeca()
	{
		$sql  = "select * ";
		$sql .= "from statuspeca ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_statuspeca like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_statuspeca( $row["id_statuspeca"] );
		$this->setName( $row["name"] );

		return $this;
	}
}
?>