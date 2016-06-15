<?php 

/** 
 * Classe Produto
 * @author __ Filipe Rodrigues | filiperdo@gmail.com
 *
 * Data: 02/03/2016
 */
class Produto_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $produto;
	private $name;
	private $marca;
	private $aro;
	private $cola;
	private $vidro;
	private $polarizador;

	public function __construct()
	{
		parent::__construct();

		$this->id_produto = '';
		$this->name = '';
		$this->marca = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_produto( $id_produto )
	{
		$this->id_produto = $id_produto;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	public function setMarca( Marca_Model $marca )
	{
		$this->marca = $marca;
	}
	
	public function setAro( $aro )
	{
		$this->aro = $aro;
	}
	
	public function setCola( $cola )
	{
		$this->cola = $cola;
	}
	
	public function setVidro( $vidro )
	{
		$this->vidro = $vidro;
	}
	
	public function setPolarizador( $polarizador )
	{
		$this->polarizador = $polarizador;
	}
	
	/** 
	* Metodos get's
	*/
	public function getId_produto()
	{
		return $this->id_produto;
	}

	public function getName()
	{
		return strtoupper( $this->name );
	}

	public function getMarca()
	{
		return $this->marca;
	}
	
	public function getAro()
	{
		return $this->aro;
	}
	
	public function getCola()
	{
		return $this->cola;
	}
	
	public function getVidro()
	{
		return $this->vidro;
	}
	
	public function getPolarizador()
	{
		return $this->polarizador;
	}

	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "produto", $data ) ){
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

		if( !$update = $this->db->update("produto", $data, "id_produto = {$id} ") ){
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

		if( !$delete = $this->db->delete("produto", "id_produto = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterProduto
	*/
	public function obterProduto( $id_produto )
	{
		$sql  = "select * ";
		$sql .= "from produto ";
		$sql .= "where id_produto = :id ";

		$result = $this->db->select( $sql, array("id" => $id_produto) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarProduto
	*/
	public function listarProduto()
	{
		$sql  = "select * ";
		$sql .= "from produto as p ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where p.name like :name "; // Configurar o like com o campo necessario da tabela 
			$sql .= 'order by p.id_marca asc ';
			$result = $this->db->select( $sql, array("name" => "%{$_POST["like"]}%") );
		}
		else
		{
			$sql .= 'order by p.id_marca asc ';
			$result = $this->db->select( $sql );
		}

		return $this->montarLista($result);
	}

	/**
	 * Metodo listarProdutoPorMarca
	 */
	public function listarProdutoPorMarca( $id_marca, $status = NULL )
	{
		$sql  = "select * ";
		$sql .= "from produto as p ";
		$sql .= 'where p.id_marca = ' . $id_marca . ' ';
		
		$result = $this->db->select( $sql );
		
		return $this->montarLista($result);
	}
	
	/**
	 * Lista os produtos por status
	 * trazendo os totais de cada um
	 * @param unknown $id_status
	 */
	public function listarProdutoPorStatus( $id_status )
	{
		$sql  = 'select ';
		$sql .= 'prod.*, ';
		$sql .= 'count(prod.id_produto) as total ';
		$sql .= 'from peca as p ';
		$sql .= 'inner join produto as prod ';
		$sql .= 'on prod.id_produto = p.id_produto ';
		$sql .= 'where p.id_statuspeca = :idStatus ';
		$sql .= 'group by prod.id_produto ';
		
		$result = $this->db->select( $sql, array( 'idStatus' => $id_status ) );
		
		return $result;
		
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
		$this->setId_produto( $row["id_produto"] );
		$this->setName( $row["name"] );
		
		require_once 'models/marca_model.php';
		$objMarca = new Marca_Model();
		$this->setMarca( $objMarca->obterMarca( $row['id_marca'] ) );

		$this->setAro( $row["aro"] );
		$this->setCola( $row["cola"] );
		$this->setVidro( $row["vidro"] );
		$this->setPolarizador( $row["polarizador"] );
		
		return $this;
	}
}
?>