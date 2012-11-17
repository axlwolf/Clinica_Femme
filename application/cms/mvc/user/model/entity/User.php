<?php
/**
 * Classes e objetos relacionados com a model dos usuários
 * @package	cms.mvc.user.model
 */

require_once 'cms/util/validators/EmailValidator.php';

/**
 * Entidade de um usuário
 * @author mauricio
 *
 */
final class User {

	/**
	 *
	 * @var integer
	 */
	private $idUser = null;

	/**
	 *
	 * @var integer
	 */
	private $idGroup = 3;
	
	/**
	 *
	 * @var string
	 */
	private $groupName;

	/**
	 *
	 * @var string
	 */
	private $userName = null;

	/**
	 *
	 * @var string
	 */
	private $userEmail = null;

	/**
	 *
	 * @var string
	 */
	private $userLogin = null;

	/**
	 *
	 * @var string
	 */
	private $userPassword = null;

	/**
	 *
	 * @var string
	 */
	private $userPhoto = null;


	/**
	 * Atribui um ID para um usuário
	 * @param integer $id
	 * @throws UnexpectedValueException Quando o ID informado não é inteiro
	 */
	public function setIdUser( $id ){
		$this->idUser = (int) $id;
	}

	/**
	 * Atribui um ID para um grupo
	 * @param integer $id
	 * @throws UnexpectedValueException Quando o ID informado não é inteiro
	 */
	public function setIdGroup( $id ){
		if(is_int( $id )){
			$this->idGroup = (int) $id;
		}else{
			throw new UnexpectedValueException( 'O ID do grupo deve ser um inteiro.' );
		}
	}

	/**
	 * Retorna o id do usuário
	 * @return integer
	 */
	public function getIdUser(){
		return $this->idUser;
	}

	/**
	 * Retorna o id do grupo
	 * @return integer
	 */
	public function getIdGroup(){
		return $this->idGroup;
	}

	/**
	 * Atribui um nome ao usuário
	 * @param string $name Nome do usuário
	 */
	public function setUserName( $name ){
		$this->userName = $name;
	}
	
/**
	 * Atribui um nome ao grupo que o usuário pertence
	 * @param string $name Nome do grupo
	 */
	public function setGroupName( $name ){
		$this->groupName = $name;
	}

/**
	 * Retorna o nome do grupo do usuário
	 * @return string
	 */
	public function getGroupName(){
		return $this->groupName;
	}
	
	/**
	 * Retorna o nome do usuário
	 * @return string
	 */
	public function getUserName(){
		return $this->userName;
	}

	/**
	 * Atribui um e-mail ao usuário
	 * @param string $email E-mail do usuário
	 * @throws UnexpectedValueException Quando o e-mail informado não estiver correto
	 */
	public function setUserEmail( $email ){
		if(EmailValidator::valid( $email )){
			$this->userEmail = $email;
		}else{
			throw new UnexpectedValueException( 'O E-mail está incorreto.' );
		}
	}

	/**
	 * Retorna o e-mail do usuário
	 * @return string
	 */
	public function getUserEmail(){
		return $this->userEmail;
	}

	/**
	 * Atribui um login ao usuário
	 * @param string $login Login do usuário
	 */
	public function setUserLogin( $login ){
		$this->userLogin = $login;
	}

	/**
	 * Retorna o login do usuário
	 * @return string
	 */
	public function getUserLogin(){
		return $this->userLogin;
	}

	/**
	 * Atribui uma senha para o usuário e encriptografa a senha com SHA1
	 * @param string $password Senha do usuário
	 */
	public function setUserPassword( $password ){
		$this->userPassword = sha1( $password );
	}

	/**
	 * Retorna a senha do usuário
	 * @return string
	 */
	public function getUserPassword(){
		return $this->userPassword;
	}

	/**
	 * Atribui uma foto ao usuário
	 * @param string $photo Nome da foto do usuário
	 */
	public function setUserPhoto( $photo ){
		$this->userPhoto = $photo;
	}

	/**
	 * Retorna uma foto do usuário
	 * @return string
	 */
	public function getUserPhoto(){
		return $this->userPhoto;
	}

}