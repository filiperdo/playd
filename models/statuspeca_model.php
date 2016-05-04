<?php 

/** 
 * Classe Statuspeca
 * @author __ 
 *
 * Data: 02/03/2016
 */
class Statuspeca_Model extends Model
{
	const EM_ABERTO = 1;
	const PRONTO_VERDE = 2;
	const PRONTO_AMARELO = 3;
	const QUEBRADO = 4;
	const AGUARDANDO_FLEX = 5;
	const ENTREGUE = 6;
	
	/** 
	* Atributos Private 
	*/
	private $statuspeca;
	private $name;
	private $class;
	private $icon;

	public function __construct()
	{
		parent::__construct();

		$this->id_statuspeca = '';
		$this->name = '';
		$this->class = '';
		$this->icon = '';
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

	public function setClass( $class )
	{
		$this->class = $class;
	}
	
	public function setIcon( $icon )
	{
		$this->icon = $icon;
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

	public function getClass()
	{
		return $this->class;
	}
	
	public function getIcon()
	{
		return $this->icon;
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
		$this->setClass( $row['class'] );
		$this->setIcon( $row['icon'] );

		return $this;
	}
}
?>