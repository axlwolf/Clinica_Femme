<?php
/**
 * Pacote de classes e objetos das models dos usuários
 * @package cms.mvc.user.model
 */

require_once 'cms/mvc/link/model/LinkDataAccess.php';
require_once 'cms/mvc/link/model/entity/Link.php';

/**
 * Acesso de dados de usuários à um banco MySQL
 * @author mauricio
 *
 */
class MySQLLinkDataAccess implements LinkDataAccess {

	/**
	 * @see LinkDataAccess::getByID
	 * @param integer $id
	 * @return Link
	 */
	public function getByID( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT  *
							FROM  `cms_link`
							WHERE  `idLink` = :id;' );
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'Link' );
		$stm->execute();

		$link = $stm->fetch();

		$stm->closeCursor();

		if ( $link instanceof Link ) {
			return $link;
		} else {
			throw new RuntimeException( 'Nenhum link encontrado com o ID fornecido.' );
		}
	}

	/**
	 * @see LinkDataAccess::getAll
	 * @return array[Link]
	 */
	public function getAll(){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT  *
							FROM  `cms_link`');
		$stm->setFetchMode( PDO::FETCH_CLASS , 'Link' );
		$stm->execute();

		return $stm->fetchAll();
	}

	public function save( Link $link ){
		$pdo = Registry::getInstance()->get( 'pdo' );

		// Verifica se todos os campos estão preenchidos
		if(!$link->getLinkName()){
			throw new RuntimeException( 'É necessário informar um nome para o link.' );
		}

		if(!$link->getLinkUrl()){
			throw new RuntimeException( 'É necessário informar uma url para o link.' );
		}

		if( !( $user->getIdUser() ) ){ // adiciona
			$stm = $pdo->prepare( 'INSERT INTO `cms_link`(`linkName`, `linkUrl`)
										VALUES (:name, :url);' );
			$stm->bindParam( ':name' , $link->getLinkName(), PDO::PARAM_STR );
			$stm->bindParam( ':url' , $link->getLinkUrl(), PDO::PARAM_STR );
		}else{
			$stm = $pdo->prepare( 'UPDATE `cms_link` 
									SET `linkName`=:name,`linkUrl`=:url
									WHERE `idLink` = :id ' );
			$stm->bindParam( ':name' , $link->getLinkName(), PDO::PARAM_STR );
			$stm->bindParam( ':url' , $link->getLinkUrl(), PDO::PARAM_STR );
			$stm->bindParam( ':id' , $link->getIdLink(), PDO::PARAM_INT );
				
		}
		$stm->execute();
	}

	/**
	 * @param int $id ID do usuário a ser deletado
	 * @see LinkDataAccess::delete
	 */
	public function delete( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'DELETE FROM `cms_link` WHERE `idLink` = :id' );
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->execute();
	}

}