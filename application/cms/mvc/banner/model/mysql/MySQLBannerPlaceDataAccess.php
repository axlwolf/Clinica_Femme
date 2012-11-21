<?php
/**
 * Pacote de classes e objetos das models dos usuários
 * @package cms.mvc.user.model
 */

require_once 'cms/mvc/banner/model/BannerPlaceDataAccess.php';
require_once 'cms/mvc/banner/model/entity/BannerPlace.php';

/**
 * Acesso de dados de locais de banners à um banco MySQL
 * @author mauricio
 *
 */
class MySQLBannerPlaceDataAccess implements BannerPlaceDataAccess {

	/**
	 * @see BannerPlaceDataAccess::getPlaceByID
	 * @param integer $id
	 * @return BannerPlace
	 */
	public function getPlaceByID( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT * FROM `cms_banner_places` AS `p` WHERE `p`.`idBannerPlace` = :id;' );
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'BannerPlace' );
		$stm->execute();

		$place = $stm->fetch();

		$stm->closeCursor();

		if ( $place instanceof BannerPlace ) {
			return $place;
		} else {
			throw new RuntimeException( 'Nenhum local encontrado com o ID fornecido.' );
		}
	}

	/**
	 * @see BannerPlaceDataAccess::getPlaces
	 * @return array
	 */
	public function getPlaces(){
		$pdo = Registry::getInstance()->get( 'pdo' );

		$stm = $pdo->prepare( 'SELECT * FROM `cms_banner_places`;' );

		$stm->setFetchMode( PDO::FETCH_CLASS , 'BannerPlace' );
		$stm->execute();

		return $stm->fetchAll();
	}

	/**
	 * Edita ou adiciona um local de banner. Caso for passado um BannerPlace::$idBannerPlace é editado, caso contrário é adicionado
	 * @param BannerPlace $bannerPlace Dados de um local para serem cadastrados
	 */
	public function save( BannerPlace $bannerPlace ){
		$pdo = Registry::getInstance()->get( 'pdo' );

		// Verifica se todos os campos estão preenchidos
		if( !$bannerPlace->getBannerPlaceHeight() ){
			throw new RuntimeException( 'É necessário informar a altura do local do banner.' );		
		}

		if( !$bannerPlace->getBannerPlaceWidth() ){
			throw new RuntimeException( 'É necessário informar a largura do local do banner.' );		
		}

		if( !$bannerPlace->getBannerPlaceName() ){
			throw new RuntimeException( 'É necessário informar o nome do local do banner.' );		
		}

		if( !$bannerPlace->getIdBannerPlace() ){ // adiciona
			$stm = $pdo->prepare( 'INSERT INTO `cms_banner_places`(`bannerPlaceName`, `bannerPlaceWidth`, `bannerPlaceHeight`)
										VALUES (:name,:width,:height); ' );
			$stm->bindParam( ':name' , $bannerPlace->getBannerPlaceName(), PDO::PARAM_STR );
			$stm->bindParam( ':width' , $bannerPlace->getBannerPlaceWidth(), PDO::PARAM_INT );
			$stm->bindParam( ':height' , $bannerPlace->getBannerPlaceHeight(), PDO::PARAM_INT );
		}else{
			$stm = $pdo->prepare( 'UPDATE `cms_banner_places` SET `bannerPlaceName`=:name,`bannerPlaceWidth`=:width,`bannerPlaceHeight`=:height
										WHERE `idBannerPlace` = :id ' );
			$stm->bindParam( ':name' , $bannerPlace->getBannerPlaceName(), PDO::PARAM_STR );
			$stm->bindParam( ':width' , $bannerPlace->getBannerPlaceWidth(), PDO::PARAM_INT );
			$stm->bindParam( ':height' , $bannerPlace->getBannerPlaceHeight(), PDO::PARAM_INT );
			$stm->bindParam( ':id' , $bannerPlace->getIdBannerPlace(), PDO::PARAM_INT );
		}
		$stm->execute();
	}

	/**
	 * Deleta um local de banner e todos os banners que fazem relação com este local
	 * @param integer $id Id do local
	 */
	public function delete( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'DELETE  cms_banner_places, cms_banner FROM cms_banner_places
							LEFT JOIN cms_banner ON cms_banner.idBannerPlace = cms_banner_places.idBannerPlace WHERE cms_banner_places.idBannerPlace = :id' );
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->execute();
	}

}