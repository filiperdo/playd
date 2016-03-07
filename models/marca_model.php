<?php 

/** 
 * Classe Marca
 * @author __ Filipe Rodrigues | filiperdo@gmail.com
 *
 * Data: 02/03/2016
 */
class Marca_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $marca;
	private $name;

	public function __construct()
	{
		parent::__construct();

		$this->id_marca = '';
		$this->name = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_marca( $id_marca )
	{
		$this->id_marca = $id_marca;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	

	/** 
	* Metodos get's
	*/
	public function getId_marca()
	{
		return $this->id_marca;
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

		if( !$id = $this->db->insert( "marca", $data ) ){
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

		if( !$update = $this->db->update("marca", $data, "id_marca = {$id} ") ){
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

		if( !$delete = $this->db->delete("marca", "id_marca = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterMarca
	*/
	public function obterMarca( $id_marca )
	{
		$sql  = "select * ";
		$sql .= "from marca ";
		$sql .= "where id_marca = :id ";

		$result = $this->db->select( $sql, array("id" => $id_marca) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarMarca
	*/
	public function listarMarca()
	{
		$sql  = "select * ";
		$sql .= "from marca ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_marca like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_marca( $row["id_marca"] );
		$this->setName( $row["name"] );

		return $this;
	}
}
?>