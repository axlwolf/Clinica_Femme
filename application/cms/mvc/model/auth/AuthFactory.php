<?php
/**
 * Classes e objetos relacionados com a autenticação da aplicação
 * @package	cms.mvc.model.auth
 */

/**
 * Interface para definição de uma fábrica abstrata para
 * criação das Autenticações da aplicação.
 * @author	mauricio
 */
interface AuthFactory {
	
	/**
	 * Autentica e grava as sessões do usuário autenticado
	 * @param AbstractAuthAdapter $adapter Adaptador de autenticação
	 */
	public function write( AbstractAuthAdapter $adapter );
	
	/**
	 * Retorna verdadeiro se o usuário está autenticado, e falso se não está
	 * @return boolean
	 */
	public function isAuth();
	
	/**
	 * Exclui as sessões autenticadas que estão gravadas
	 */
	public function logout();
	
	/**
	 * Retorna uma instância única da autenticação
	 * @return AuthFactory
	 */
	public static function getInstance();
}