<?php
/**
 * Classes e objetos relacionados com a Model da aplicação
 * @package	cms.mvc.model.mysql
 */

require_once 'cms/mvc/model/AbstractDataAccessFactory.php';
require_once 'cms/mvc/user/model/mysql/MySQLUserDataAccess.php';
require_once 'cms/mvc/group/model/mysql/MySQLGroupDataAccess.php';
require_once 'cms/mvc/configs/model/mysql/MySQLConfigsDataAccess.php';

/**
 * Fábrica de objetos Model que utilizam acesso a dados em
 * bancos MySQL
 * @author	mauricio
 */
class MySQLDataAccessFactory extends AbstractDataAccessFactory {


	public function __construct() {
		$registry = Registry::getInstance();

		if ( !$registry->has( 'pdo' ) ) {
			$resourceBundle = Application::getInstance()->getBundle();

			$registry->set( 'pdo',
			new PDO(
			$resourceBundle->getString( 'MYSQL_DSN' ),
			$resourceBundle->getString( 'MYSQL_USER' ),
			$resourceBundle->getString( 'MYSQL_PSWD' )
			)
			);
		}
	}


	/**
	 * @return UserDataAccess
	 * @see AbstractDataAccessFactory::createUserDataAccess
	 */
	public function createUserDataAccess(){
		return new MySQLUserDataAccess();
	}

	/**
	 * @return GroupDataAccess
	 * @see AbstractDataAccessFactory::createGroupDataAccess
	 */
	public function createGroupDataAccess(){
		return new MySQLGroupDataAccess();
	}
	
	public function createConfigsDataAccess(){
		return new MySQLConfigsDataAccess();
	}
	
}