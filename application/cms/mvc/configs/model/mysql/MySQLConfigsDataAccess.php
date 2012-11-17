<?php
/**
 * Pacote de classes e objetos das models  de configuração
 * @package cms.mvc.configs.model
 */

require_once 'cms/mvc/configs/model/ConfigsDataAccess.php';
require_once 'cms/mvc/configs/model/entity/Configuration.php';

/**
 * Acesso de dados às configurações à um banco MySQL
 * @author mauricio
 *
 */
class MySQLConfigsDataAccess implements ConfigsDataAccess {

	/**
	 * @see ConfigsDataAccess::getConfigByID
	 * @return Configuration
	 */
	public function getConfig(){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT * FROM `cms_config` AS `e` WHERE `e`.`idConfig` = 1;' );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'Configuration' );
		$stm->execute();

		$config = $stm->fetch();

		$stm->closeCursor();

		if ( $config instanceof Configuration ) {
			return $config;
		} else {
			throw new RuntimeException( 'Nenhuma configuração foi encontrada.' );
		}
	}


	/**
	 * @see ConfigsDataAccess::save
	 * @param Configuration $config Dados a serem salvos da configuração
	 */
	public function save( Configuration $config ){
		$pdo = Registry::getInstance()->get( 'pdo' );

		//Verifica se o usuário alterou a senha do GA
		if( $config->getConfigGAPassword() ){
			$stm = $pdo->prepare( 'UPDATE `cms_config`
		SET `configTitle`=:title,`configDescription`=:description,`configKeyWords`=:keywords,
		`configScriptGA`=:script,`configGAAcc`=:acc,`configGAPassword`=:password,`configGAId`=:report_id,`configEmail`=:email 
		WHERE `idConfig`=1' );
			$stm->bindParam( ':password' , $config->getConfigGAPassword(), PDO::PARAM_STR );
		}else{
			$stm = $pdo->prepare( 'UPDATE `cms_config`
		SET `configTitle`=:title,`configDescription`=:description,`configKeyWords`=:keywords,
		`configScriptGA`=:script,`configGAAcc`=:acc,`configEmail`=:email,`configGAId`=:report_id
		WHERE `idConfig`=1' );
		}
		$stm->bindParam( ':title' , $config->getConfigTitle(), PDO::PARAM_STR );
		$stm->bindParam( ':description' , $config->getConfigDescription(), PDO::PARAM_STR );
		$stm->bindParam( ':keywords' , $config->getConfigKeyWords(), PDO::PARAM_STR );
		$stm->bindParam( ':script' , $config->getConfigScriptGA(), PDO::PARAM_STR );
		$stm->bindParam( ':acc' , $config->getConfigGAAcc(), PDO::PARAM_STR );
		$stm->bindParam( ':email' , $config->getConfigEmail(), PDO::PARAM_STR );
		$stm->bindParam( ':report_id' , $config->getConfigGAId(), PDO::PARAM_STR );
		$stm->execute();
	}

}