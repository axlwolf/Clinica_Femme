<?php
/**
 * Classes e objetos relacionados com a autenticação da aplicação
 * @package	cms.mvc.model.auth
 */

require_once 'cms/mvc/model/auth/AuthFactory.php';

/**
 * Interface para definição de uma fábrica abstrata para
 * criação das Autenticações da aplicação.
 * @author	mauricio
 */
class Auth implements AuthFactory {
	
	private static $instance = null;
	
	/**
	 * Autentica e grava as sessões do usuário autenticado
	 * @param AbstractAuthAdapter $adapter Adaptador de autenticação
	 * @return boolean
	 */
	public function write( AbstractAuthAdapter $adapter ){
		
		$autenticate = $adapter->autenticate();
		
		if( !empty($autenticate) ){
			$_SESSION['CMS']['user']['auth'] = true;
			$_SESSION['CMS']['user']['login'] = $adapter->getLogin();
			$_SESSION['CMS']['user']['name'] = $autenticate->getUserName();
			$_SESSION['CMS']['user']['group'] = $autenticate->getIdGroup();
			$_SESSION['CMS']['user']['img'] = $autenticate->getUserPhoto();
			$_SESSION['CMS']['user']['id'] = $autenticate->getIdUser();
			
			return true;
		}
		
		return false;
	}
	
	/**
	 * Retorna verdadeiro se o usuário está autenticado, e falso se não está
	 * @return boolean
	 */
	public function isAuth(){
		if($_SESSION['CMS']['user']['auth']){
			return true;
		}
		
		return false;
	}
	
	/**
	 * Exclui as sessões autenticadas que estão gravadas
	 */
	public function logout(){
		unset($_SESSION['CMS']['user']);
	}
	
	/**
	 * Retorna uma instância única da autenticação
	 * @return Auth
	 */
	public static function getInstance(){
		if( self::$instance == null ){
			self::$instance = new Auth();
		}
		
		return self::$instance;
	}
	
}
