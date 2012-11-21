<?php
/**
 * Pacote de classes e objetos das models do mural de recados
 * @package cms.mvc.scrapbook.model
 */

require_once 'cms/mvc/scrapbook/model/ScrapbookDataAccess.php';
require_once 'cms/mvc/scrapbook/model/entity/Scrap.php';

/**
 * Acesso de dados de mural de recados à um banco MySQL
 * @author mauricio
 *
 */
class MySQLScrapbookDataAccess implements ScrapbookDataAccess {

	/**
	 * @see scrapbookDataAccess::getByID
	 * @param integer $id
	 * @return Scrap
	 */
	public function getByID( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT * FROM `cms_scrapbook` AS `e` WHERE `e`.`idScrap` = :id' );
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'Scrap' );
		$stm->execute();

		$scrap = $stm->fetch();

		$stm->closeCursor();

		if ( $scrap instanceof Scrap ) {
			return $scrap;
		} else {
			throw new RuntimeException( 'Nenhum recado encontrado com o ID fornecido.' );
		}
	}

	/**
	 * @see scrapbookDataAccess::getAll
	 * @return array
	 */
	public function getAll(){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT * FROM `cms_scrapbook` ' );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'Scrap' );
		$stm->execute();

		return $stm->fetchAll();
	}

	/**
	 * @see scrapbookDataAccess::edit
	 * @param Scrap $scrap
	 */
	public function edit( Scrap $scrap ){
		$pdo = Registry::getInstance()->get( 'pdo' );

		if( !$scrap->getIdScrap() ){
			throw new RuntimeException( 'É necessário informar um recado para editar.' );
		}
		
		// Verifica se todos os campos estão preenchidos
		if( !$scrap->getScrapName() ){
			throw new RuntimeException( 'É necessário informar um nome para este recado.' );
		}

		if( !$scrap->getScrapEmail() ){
			throw new RuntimeException( 'É necessário informar um email para este recado.' );
		}

		if( !$scrap->getScrapDesc() ){
			throw new RuntimeException( 'É necessário informar uma descrição para este recado.' );
		}

		$stm = $pdo->prepare( 'UPDATE `cms_scrapbook`
									SET `scrapName`=:name, `scrapEmail`=:email, `scrapDesc`=:desc, `scrapApproved`=:approved  
									WHERE `idScrap`=:id' );
		$stm->bindParam( ':id' , $scrap->getIdScrap(), PDO::PARAM_INT );
		$stm->bindParam( ':name' , $scrap->getScrapName(), PDO::PARAM_STR );
		$stm->bindParam( ':email' , $scrap->getScrapEmail(), PDO::PARAM_STR );
		$stm->bindParam( ':desc' , $scrap->getScrapDesc(), PDO::PARAM_STR );
		$stm->bindParam( ':approved' , $scrap->getScrapApproved(), PDO::PARAM_BOOL );
		$stm->execute();
	}

	/**
	 * @param int $id
	 * @see scrapbookDataAccess::delete
	 */
	public function delete( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'DELETE FROM `cms_scrapbook` WHERE `idScrap` = :id' );
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->execute();
	}
}