<?php 

/** 
 * Classe Fornecedor
 * @author __ 
 *
 * Data: 15/03/2016
 */
class Fornecedor_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $fornecedor;
	private $name;
	private $telefone;
	private $email;
	private $banco;
	private $cidade;
	private $estado;
	private $date;

	public function __construct()
	{
		parent::__construct();

		$this->id_fornecedor = '';
		$this->name = '';
		$this->telefone = '';
		$this->email = '';
		$this->banco = '';
		$this->cidade = '';
		$this->estado = '';
		$this->date = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_fornecedor( $id_fornecedor )
	{
		$this->id_fornecedor = $id_fornecedor;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	public function setTelefone( $telefone )
	{
		$this->telefone = $telefone;
	}

	public function setEmail( $email )
	{
		$this->email = $email;
	}

	public function setBanco( $banco )
	{
		$this->banco = $banco;
	}

	public function setCidade( $cidade )
	{
		$this->cidade = $cidade;
	}

	public function setEstado( $estado )
	{
		$this->estado = $estado;
	}

	public function setDate( $date )
	{
		$this->date = $date;
	}

	/** 
	* Metodos get's
	*/
	public function getId_fornecedor()
	{
		return $this->id_fornecedor;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getTelefone()
	{
		return $this->telefone;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getBanco()
	{
		return $this->banco;
	}

	public function getCidade()
	{
		return $this->cidade;
	}

	public function getEstado()
	{
		return $this->estado;
	}

	public function getDate()
	{
		return $this->date;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "fornecedor", $data ) ){
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

		if( !$update = $this->db->update("fornecedor", $data, "id_fornecedor = {$id} ") ){
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

		if( !$delete = $this->db->delete("fornecedor", "id_fornecedor = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterFornecedor
	*/
	public function obterFornecedor( $id_fornecedor )
	{
		$sql  = "select * ";
		$sql .= "from fornecedor ";
		$sql .= "where id_fornecedor = :id ";

		$result = $this->db->select( $sql, array("id" => $id_fornecedor) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarFornecedor
	*/
	public function listarFornecedor()
	{
		$sql  = "select * ";
		$sql .= "from fornecedor ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_fornecedor like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_fornecedor( $row["id_fornecedor"] );
		$this->setName( $row["name"] );
		$this->setTelefone( $row["telefone"] );
		$this->setEmail( $row["email"] );
		$this->setBanco( $row["banco"] );
		$this->setCidade( $row["cidade"] );
		$this->setEstado( $row["estado"] );
		$this->setDate( $row["date"] );

		return $this;
	}
}
?>