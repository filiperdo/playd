<?php 

/** 
 * Classe Logpeca
 * @author __ 
 *
 * Data: 02/03/2016
 */
class Logpeca_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $logpeca;
	private $color;
	private $date;
	private $peca;
	private $user;

	public function __construct()
	{
		parent::__construct();

		$this->id_logpeca = '';
		$this->color = '';
		$this->date = '';
		$this->id_peca = '';
		$this->id_user = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_logpeca( $id_logpeca )
	{
		$this->id_logpeca = $id_logpeca;
	}

	public function setColor( $color )
	{
		$this->color = $color;
	}

	public function setDate( $date )
	{
		$this->date = $date;
	}

	public function setId_peca( $id_peca )
	{
		$this->id_peca = $id_peca;
	}

	public function setId_user( $id_user )
	{
		$this->id_user = $id_user;
	}

	/** 
	* Metodos get's
	*/
	public function getId_logpeca()
	{
		return $this->id_logpeca;
	}

	public function getColor()
	{
		return $this->color;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getId_peca()
	{
		return $this->id_peca;
	}

	public function getId_user()
	{
		return $this->id_user;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "logpeca", $data ) ){
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

		if( !$update = $this->db->update("logpeca", $data, "id_logpeca = {$id} ") ){
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

		if( !$delete = $this->db->delete("logpeca", "id_logpeca = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterLogpeca
	*/
	public function obterLogpeca( $id_logpeca )
	{
		$sql  = "select * ";
		$sql .= "from logpeca ";
		$sql .= "where id_logpeca = :id ";

		$result = $this->db->select( $sql, array("id" => $id_logpeca) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarLogpeca
	*/
	public function listarLogpeca()
	{
		$sql  = "select * ";
		$sql .= "from logpeca ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_logpeca like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_logpeca( $row["id_logpeca"] );
		$this->setColor( $row["color"] );
		$this->setDate( $row["date"] );
		$this->setId_peca( $row["id_peca"] );
		$this->setId_user( $row["id_user"] );

		return $this;
	}
}
?>