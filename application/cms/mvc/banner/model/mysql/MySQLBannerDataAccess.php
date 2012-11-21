<?php
/**
 * Pacote de classes e objetos das models dos banners
 * @package cms.mvc.banner.model
 */

require_once 'cms/mvc/banner/model/BannerDataAccess.php';
require_once 'cms/mvc/banner/model/entity/Banner.php';

/**
 * Acesso de dados de banner à um banco MySQL
 * @author mauricio
 *
 */
class MySQLBannerDataAccess implements BannerDataAccess {

	/**
	 * @see BannerDataAccess::getBannerByID
	 * @param integer $id
	 * @return Banner
	 */
	public function getBannerByID( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT * FROM `cms_banner` AS `b`
							INNER JOIN `cms_banner_places` as `p` ON `b`.`idBannerPlace` = `p`.`idBannerPlace` 
							WHERE `b`.`idBanner` = :id;' );
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'Banner' );
		$stm->execute();

		$banner = $stm->fetch();

		$stm->closeCursor();

		if ( $banner instanceof Banner ) {
			return $banner;
		} else {
			throw new RuntimeException( 'Nenhum banner encontrado com o ID fornecido.' );
		}
	}

	/**
	 * @see BannerDataAccess::getBanners
	 * @return array
	 */
	public function getBanners(){
		$pdo = Registry::getInstance()->get( 'pdo' );

		$stm = $pdo->prepare( 'SELECT * FROM `cms_banner` as `b`
								INNER JOIN `cms_banner_places` as `p` ON `b`.`idBannerPlace` = `p`.`idBannerPlace` ');

		$stm->setFetchMode( PDO::FETCH_CLASS , 'Banner' );
		$stm->execute();

		return $stm->fetchAll();
	}

	/**
	 * @see BannerDataAccess::getBannersByPlace
	 * @param integer $idBannerPlace ID do local do banner
	 * @return array
	 */
	public function getBannersByPlace( $idBannerPlace ){
		$pdo = Registry::getInstance()->get( 'pdo' );

		$stm = $pdo->prepare( 'SELECT * FROM `cms_banner` as `b`
				       INNER JOIN `cms_banner_places` as `p` ON `b`.`idBannerPlace` = `p`.`idBannerPlace`
				       WHERE `p`.`idBannerPlace` = :id ');
		$stm->bindParam( ':id' , $idBannerPlace, PDO::PARAM_INT );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'Banner' );
		$stm->execute();

		return $stm->fetchAll();
	}

	/**
	 * Edita ou adiciona um banner. Caso for passado um Banner::$idBanner é editado, caso contrário é adicionado
	 * @param Banner $banner Dados de um banner para serem cadastrados
	 */
	public function save( Banner $banner ){
		$pdo = Registry::getInstance()->get( 'pdo' );

		// Verifica se todos os campos estão preenchidos
		if( !$banner->getIdBannerPlace() ){
			throw new RuntimeException( 'É necessário informar o local do banner.' );
		}

		if( !$banner->getBannerTitle() ){
			throw new RuntimeException( 'É necessário informar o título do banner.' );
		}

		if( !$banner->getBannerFile() ){
			throw new RuntimeException( 'É necessário enviar um arquivo de imagem ou animação em flash para publicação.' );
		}

		if( !$banner->getBannerDateOut() ){
			throw new RuntimeException( 'É necessário informar a data de saída do banner.' );
		}

		if( !$banner->getBannerDateIn() ){
			throw new RuntimeException( 'É necessário informar a data de entrada do banner.' );
		}


		if( !$banner->getIdBanner() ){ // adiciona
			
			//Quando adiciona é necessário inserir um arquivo
			if( !$banner->getBannerFile() ){
				throw new RuntimeException( 'Insira o arquivo do banner.' );
			}
			
			$stm = $pdo->prepare( 'INSERT INTO `cms_banner`(`idBannerPlace`, `bannerTitle`, `bannerDescription`, `bannerDateIn`, `bannerDateOut`, `bannerFile`, `bannerLink`)
										VALUES (:idBannerPlace,:title,:description,:datein,:dateout,:file,:link); ' );
		}else{
			$stm = $pdo->prepare( 'UPDATE `cms_banner` SET `idBannerPlace`=:idBannerPlace, `bannerTitle`=:title, `bannerDescription`=:description, `bannerDateIn`=:datein, `bannerDateOut`=:dateout, `bannerFile`=:file, `bannerLink` =:link 
						WHERE `idBanner` = :id ' );
			$stm->bindParam( ':id' , $banner->getIdBanner(), PDO::PARAM_INT );
		}
		$stm->bindParam( ':idBannerPlace' , $banner->getIdBannerPlace(), PDO::PARAM_INT );
		$stm->bindParam( ':title' , $banner->getBannerTitle(), PDO::PARAM_STR );
		$stm->bindParam( ':description' , $banner->getBannerDescription(), PDO::PARAM_STR );
		$stm->bindParam( ':datein' , $banner->getBannerDateIn(), PDO::PARAM_STR );
		$stm->bindParam( ':dateout' , $banner->getBannerDateOut(), PDO::PARAM_STR );
		$stm->bindParam( ':file' , $banner->getBannerFile(), PDO::PARAM_STR );
		$stm->bindParam( ':link' , $banner->getBannerLink(), PDO::PARAM_STR );
		$stm->execute();
	}

	/**
	 * Deleta um banner
	 * @param int $id ID do banner a ser deletado
	 * @see BannerDataAccess::delete
	 */
	public function delete( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'DELETE FROM `cms_banner` WHERE `idBanner` = :id' );
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->execute();
	}

}
