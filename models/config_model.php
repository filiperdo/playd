<?php

/**
 * Classe Typeuser
 * @author __ Filipe Rodrigues
 *
 * Data: 24/01/2017
 */
class Config_Model extends Model
{
	/**
	* Atributos Private
	*/
	private $config;
	private $dolar;

	public function __construct()
	{
		parent::__construct();

		$this->id_config = '';
		$this->config = '';
	}

	/**
	* Metodos set's
	*/
	public function setId_config( $id_config )
	{
		$this->id_config = $id_config;
	}

	public function setDolar( $dolar )
	{
		$this->dolar = $dolar;
	}

	/**
	* Metodos get's
	*/
	public function getId_config()
	{
		return $this->id_config;
	}

	public function getDolar()
	{
		return $this->dolar;
	}


	/**
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "config", $data ) ){
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

		if( !$update = $this->db->update("config", $data, "id_config = {$id} ") ){
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

		if( !$delete = $this->db->delete("config", "id_config = {$id} ") ){
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/**
	* Metodo obterTypeuser
	*/
	public function obterConfig()
	{
		$sql  = "select * ";
		$sql .= "from config ";
		$sql .= "where id_config = 1 ";

		$result = $this->db->select( $sql );
		return $this->montarObjeto( $result[0] );
	}

	/**
	* Metodo montarObjeto
	*/
	private function montarObjeto( $row )
	{
		$this->setId_config( $row["id_config"] );
		$this->setDolar( $row["dolar"] );

		return $this;
	}
}
?>
