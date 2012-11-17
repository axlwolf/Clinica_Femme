<?php
/**
 * Classes e objetos relacionados com os controladores
 * da aplicação
 * @package	cms.mvc.controller
 */

/**
 * Interface para definição de um Controller que interpretará
 * as requisições do usuário.
 * @author	mauricio
 */
abstract class Controller {
	
	const PERMISSION_OTHERS = 1;
	const PERMISSION_MODERATOR = 2;
	const PERMISSION_ADMIN = 4;
	
	protected $permission;
	
	public function __construct(){
		$this->permission = self::PERMISSION_ADMIN;
	}
	
	/**
	 * Verifica se o usuário tem permissão para acessar este controlador
	 * @param integer $groupId Id do grupo ao qual o usuário pertence
	 */
	public function canBeHandleBy( $groupId ){		
		$groupDataAccess = Registry::getInstance()->get( 'dataAccessFactory' )->createGroupDataAccess();
		$group = $groupDataAccess->getGroupByID( $groupId );
		
		if(!($this->permission & $group->getGroupPermission())){
			throw new RuntimeException( 'Você não possuí permissão para acessar esta página.' );
		}
		return true;
	}
	
	/**
	 * Verifica se esse Controller sabe como manipular a requisição
	 * do usuário.
	 * @return	boolean
	 */
	public abstract function canHandle();

	/**
	 * Manipula a requisição do usuário.
	 */
	public abstract function handle();
}