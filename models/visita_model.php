<?php 

/** 
 * Classe Visita
 * @author __ 
 *
 * Data: 09/06/2016
 */ 

include_once 'cidade_model.php';

class Visita_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_visita;
	private $obs;
	private $data;
	private $cidade;

	public function __construct()
	{
		parent::__construct();

		$this->id_visita = '';
		$this->obs = '';
		$this->data = '';
		$this->cidade = new Cidade_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setId_visita( $id_visita )
	{
		$this->id_visita = $id_visita;
	}

	public function setObs( $obs )
	{
		$this->obs = $obs;
	}

	public function setData( $data )
	{
		$this->data = $data;
	}

	public function setCidade( Cidade_Model $cidade )
	{
		$this->cidade = $cidade;
	}

	/** 
	* Metodos get's
	*/
	public function getId_visita()
	{
		return $this->id_visita;
	}

	public function getObs()
	{
		return $this->obs;
	}

	public function getData()
	{
		return $this->data;
	}

	public function getCidade()
	{
		return $this->cidade;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "visita", $data ) ){
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

		if( !$update = $this->db->update("visita", $data, "id_visita = {$id} ") ){
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

		if( !$delete = $this->db->delete("visita", "id_visita = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterVisita
	*/
	public function obterVisita( $id_visita )
	{
		$sql  = "select * ";
		$sql .= "from visita ";
		$sql .= "where id_visita = :id ";

		$result = $this->db->select( $sql, array("id" => $id_visita) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarVisita
	*/
	public function listarVisita()
	{
		$sql  = "select * ";
		$sql .= "from visita as v ";
		$sql .= "order by v.data desc ";
		
		$result = $this->db->select( $sql );

		return $this->montarLista($result);
	}
	
	/**
	 * Listar visita por cidade
	 * @param unknown $id_cidade
	 * @return Visita_Model[]
	 */
	public function listarVisitaPorCidade( $id_cidade )
	{
		$sql  = "select * ";
		$sql .= "from visita as v ";
		$sql .= "where v.id_cidade = :id ";
		
		$result = $this->db->select( $sql, array("id" => $id_cidade) );
		
		return $this->montarLista( $result );
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
		$this->setId_visita( $row["id_visita"] );
		$this->setObs( $row["obs"] );
		$this->setData( $row["data"] );

		$objCidade = new Cidade_Model();
		$objCidade->obterCidade( $row["id_cidade"] );
		$this->setCidade( $objCidade );

		return $this;
	}
}
?>