<?php 

/** 
 * Classe User
 * @author __ 
 *
 * Data: 02/03/2016
 */
class User_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $user;
	private $name;
	private $email;
	private $login;
	private $password;
	private $typeuser;

	public function __construct()
	{
		parent::__construct();

		$this->id_user = '';
		$this->name = '';
		$this->email = '';
		$this->login = '';
		$this->password = '';
		$this->typeuser = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_user( $id_user )
	{
		$this->id_user = $id_user;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	public function setEmail( $email )
	{
		$this->email = $email;
	}

	public function setLogin( $login )
	{
		$this->login = $login;
	}

	public function setPassword( $password )
	{
		$this->password = $password;
	}

	public function setTypeuser( Typeuser_Model $typeuser )
	{
		$this->typeuser = $typeuser;
	}

	/** 
	* Metodos get's
	*/
	public function getId_user()
	{
		return $this->id_user;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getLogin()
	{
		return $this->login;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getTypeuser()
	{
		return $this->typeuser;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "user", $data ) ){
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

		if( !$update = $this->db->update("user", $data, "id_user = {$id} ") ){
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

		if( !$delete = $this->db->delete("user", "id_user = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterUser
	*/
	public function obterUser( $id_user )
	{
		$sql  = "select * ";
		$sql .= "from user ";
		$sql .= "where id_user = :id ";

		$result = $this->db->select( $sql, array("id" => $id_user) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarUser
	*/
	public function listarUser()
	{
		$sql  = "select * ";
		$sql .= "from user ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_user like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_user( $row["id_user"] );
		$this->setName( $row["name"] );
		$this->setEmail( $row["email"] );
		$this->setLogin( $row["login"] );
		$this->setPassword( $row["password"] );
		
		require_once 'typeuser_model.php';
		$objTypeUser = new Typeuser_Model();
		$objTypeUser->obterTypeuser( $row["id_typeuser"] );
		
		$this->setTypeuser( $objTypeUser );

		return $this;
	}
}
?>