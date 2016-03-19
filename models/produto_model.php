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
		$sql .= "from produto ";

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
	 * Metodo listarProdutoPorMarca
	 */
	public function listarProdutoPorMarca( $id_marca )
	{
		$sql  = "select * ";
		$sql .= "from produto as p ";
		$sql .= 'where p.id_marca = ' . $id_marca . ' ';
		
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
		$this->setId_produto( $row["id_produto"] );
		$this->setName( $row["name"] );
		
		require_once 'models/marca_model.php';
		$objMarca = new Marca_Model();
		$this->setMarca( $objMarca->obterMarca( $row['id_marca'] ) );

		return $this;
	}
}
?>