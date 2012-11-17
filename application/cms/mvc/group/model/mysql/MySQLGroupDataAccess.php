<?php
/**
 * Pacote de classes e objetos das models dos grupos de usuários
 * @package cms.mvc.group.model
 */

require_once 'cms/mvc/group/model/GroupDataAccess.php';
require_once 'cms/mvc/group/model/entity/Group.php';

/**
 * Acesso de dados de grupos de usuários à um banco MySQL
 * @author mauricio
 *
 */
class MySQLGroupDataAccess implements GroupDataAccess {

	/**
	 * @see GroupDataAccess::getGroupByID
	 * @param integer $id
	 * @return Group
	 */
	public function getGroupByID( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT `idGroup`, `groupName`, HEX(`groupPermission`) as groupPermission FROM `cms_groups` AS `g` WHERE `g`.`idGroup` = :id;' );
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'Group' );
		$stm->execute();

		$group = $stm->fetch();

		$stm->closeCursor();

		if ( $group instanceof Group ) {
			return $group;
		} else {
			throw new RuntimeException( 'Nenhum grupo de usuário encontrado com o ID fornecido.' );
		}
	}
	
}