<?php
/**
 * Classes e objetos relacionados com a autenticação da aplicação
 * @package	cms.mvc.model.auth
 */

require_once 'cms/mvc/model/auth/adapter/AbstractAuthAdapter.php';

/**
 * Interface para definição dos adaptadores de autenticação
 * @author	mauricio
 */
class DataAccessAuthAdapter extends AbstractAuthAdapter {
	/**
	 * Autentica um usuário à acessar o sistema, com a senha e login informados
	 * @return User
	 */
	public function autenticate(){
		$userDataAccess = Registry::getInstance()->get( 'dataAccessFactory' )->createUserDataAccess();
		$data = $userDataAccess->getUserByLoginPassword( $this->login, sha1( $this->password ) );
		return $data;
	}

}