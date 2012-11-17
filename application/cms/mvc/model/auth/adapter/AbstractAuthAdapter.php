<?php
/**
 * Classes e objetos relacionados com a autenticação da aplicação
 * @package	cms.mvc.model.auth
 */

/**
 * Interface para definição dos adaptadores de autenticação
 * @author	mauricio
 */
abstract class AbstractAuthAdapter {

	/**
	 *
	 * @var string
	 */
	protected $login;
	/**
	 *
	 * @var string
	 */
	protected $password;
	
	/**
	 * Atribui uma senha para autenticar
	 * @param string $password Senha para autenticar
	 */
	public function setPassword( $password ){
		$this->password = $password;
	}

	/**
	 * Atribui um login para fazer a autenticação
	 * @param string $login Login para autenticar
	 */
	public function setLogin( $login ){
		$this->login = $login;
	}

	/**
	 * Retorna o login que foi autenticado
	 * @return string
	 */
	public function getLogin(){
		return $this->login;
	}
	
	/**
	 * Autentica um usuário à acessar o sistema, com a senha e login informados
	 * @return User
	 */
	public abstract function autenticate();

}