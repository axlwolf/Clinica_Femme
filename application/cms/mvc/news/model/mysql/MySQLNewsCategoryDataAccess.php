<?php
/**
 * Pacote de classes e objetos das models da galeria de fotos
 * @package cms.mvc.photo.model
 */

require_once 'cms/mvc/news/model/NewsCategoryDataAccess.php';
require_once 'cms/mvc/news/model/entity/NewsCategory.php';

/**
 * Acesso de dados de cateogorias da galeria de fotos à um banco MySQL
 * @author mauricio
 *
 */
class MySQLNewsCategoryDataAccess implements NewsCategoryDataAccess {

	/**
	 * @see NewsCategoryDataAccess::getCategoryByID
	 * @param integer $id
	 * @return NewsCategory
	 */
	public function getCategoryByID( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT * FROM `cms_news_category` AS `u` WHERE `u`.`idCategory` = :id;' );
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'NewsCategory' );
		$stm->execute();

		$category = $stm->fetch();

		$stm->closeCursor();

		if ( $category instanceof NewsCategory ) {
			return $category;
		} else {
			throw new RuntimeException( 'Nenhuma categoria encontrada com o ID fornecido.' );
		}
	}

	/**
	 * @see PhotoCategoryDataAccess::getCategories
	 * @return array
	 */
	public function getCategories(){
		$pdo = Registry::getInstance()->get( 'pdo' );

		$stm = $pdo->prepare( 'SELECT * FROM `cms_news_category` ' );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'NewsCategory' );
		$stm->execute();

		return $stm->fetchAll();
	}

	/**
	 * Edita ou adiciona uma categoria.
	 * @param PhotoCategory $category Dados de uma categoria para ser salva
	 * @throws RuntimeException Se a categoria existir
	 */
	public function save( NewsCategory $category ){
		$pdo = Registry::getInstance()->get( 'pdo' );

		// Verifica se todos os campos estão preenchidos
		if( !$category->getCategoryName() ){
			throw new RuntimeException( 'É necessário informar um nome para a categoria.' );
		}

		// Verifica se o usuário existe
		if( $this->existsCategory( $category ) ){
			throw new RuntimeException( 'Esta categoria já existe.' );
		}else{ // faz uma verificação se é para editar ou adicionar
			if( !$category->getIdCategory() ){ // adiciona
				$stm = $pdo->prepare( 'INSERT INTO `cms_news_category`(`categoryName`)
										VALUES (:name); ' );
				$stm->bindParam( ':name' , $category->getCategoryName(), PDO::PARAM_STR );
			}else{
				$stm = $pdo->prepare( 'UPDATE `cms_news_category` SET `categoryName`=:name
										WHERE `idCategory` = :id ' );
				$stm->bindParam( ':name' , $category->getCategoryName(), PDO::PARAM_STR );
				$stm->bindParam( ':id' , $category->getIdCategory(), PDO::PARAM_INT );
			}
			$stm->execute();
		}


	}

	/**
	 * @param int $id ID da categoria a ser deletado
	 * @see PhotoCategoryDataAccess::delete
	 */
	public function delete( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'DELETE  cms_news_category, cms_news FROM cms_news_category  
							LEFT JOIN cms_news ON cms_news.idCategory = cms_news_category.idCategory 
							WHERE cms_news_category.idCategory = :id' );		
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->execute();
	}


	/**
	 * Verifica se a categoria já existe
	 * @param PhotoCategory $category Dados da categoria para verificar
	 * @return boolean
	 */
	private function existsCategory( NewsCategory $category ){
		$pdo = Registry::getInstance()->get( 'pdo' );

		// verifica a existencia de uma categoria para adicionar
		if( !$category->getIdCategory() ){
			$stm = $pdo->prepare( 'SELECT * FROM `cms_news_category` as `u`
									WHERE `u`.`categoryName` = :name' );
		}else{ // verifica a existencia de uma categoria para editar
			$stm = $pdo->prepare( 'SELECT * FROM `cms_news_category` as `u`
									WHERE `u`.`categoryName` = :name
									AND `u`.`idCategory` <> :id' );
			$stm->bindParam( ':id' , $category->getIdCategory(), PDO::PARAM_INT );
		}

		$stm->bindParam( ':name' , $category->getCategoryName(), PDO::PARAM_STR );
		$stm->execute();

		if(count($stm->fetchAll())){
			return true;
		}
	}

}
