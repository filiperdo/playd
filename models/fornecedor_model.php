<?php 

/** 
 * Classe Fornecedor
 * @author __ 
 *
 * Data: 15/03/2016
 */

include_once 'cidade_model.php';

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
	private $date;
	private $endereco;
	private $cidade;
	private $note;
	public $pecas;

	public function __construct()
	{
		parent::__construct();

		$this->id_fornecedor = '';
		$this->name = '';
		$this->telefone = '';
		$this->email = '';
		$this->banco = '';
		$this->date = '';
		$this->endereco = '';
		$this->cidade = new Cidade_Model();
		$this->pecas = '';
		$this->note = '';
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

	public function setDate( $date )
	{
		$this->date = $date;
	}

	public function setEndereco( $endereco )
	{
		$this->endereco = $endereco;
	}
	
	public function setCidade( Cidade_Model $cidade )
	{
		$this->cidade = $cidade;
	}
	
	public function setNote( $note )
	{
		$this->note = $note;
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
		return strtoupper($this->name);
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

	public function getDate()
	{
		return $this->date;
	}

	public function getEndereco()
	{
		return $this->endereco;
	}
	
	public function getCidade()
	{
		return $this->cidade;
	}
	
	public function getNote()
	{
		return $this->note;
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
	 * Recebe o id de um fornecedor
	 * Retorna o quantitativo de pecas por aparelho
	 * @param unknown $id_fornecedor
	 */
	public function listarQuantitativo( $id_fornecedor )
	{
		$sql  = 'select '; 
		$sql .= 'prod.name as nome_produto, ';
		$sql .= 'm.name as nome_marca, ';
		$sql .= 'p.valor, ';
		$sql .= 'count(p.id_produto) as total ';
		$sql .= 'from peca as p ';
		$sql .= 'inner join produto as prod ';
		$sql .= 'on prod.id_produto = p.id_produto ';
		$sql .= 'inner join marca as m ';
		$sql .= 'on m.id_marca = prod.id_marca ';
		$sql .= 'where p.id_fornecedor = '. $id_fornecedor .' ';
		$sql .= 'group by p.id_produto ';
		
		$result = $this->db->select( $sql );
		
		$objs = array();
		if( !empty( $result ) )
		{
			foreach( $result as $row )
				$objs[] = $row;
		}
		return $objs;
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
			$sql .= "where name like :name "; // Configurar o like com o campo necessario da tabela 
			$result = $this->db->select( $sql, array("name" => "%{$_POST["like"]}%") );
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
		$this->setDate( $row["date"] );
		$this->setEndereco( $row["endereco"] );
		$this->setNote( $row['note'] );
		
		$objCidade = new Cidade_Model();
		$objCidade->obterCidade( $row["id_cidade"] );
		$this->setCidade( $objCidade );
		
		require_once 'models/peca_model.php';
		$objPeca = new Peca_Model();
		$this->pecas = $objPeca->obterTotalPecasPorFornecedor( $row["id_fornecedor"] );
		
		return $this;
	}
}
?>