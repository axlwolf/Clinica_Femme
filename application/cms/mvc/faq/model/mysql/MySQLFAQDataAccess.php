<?php
/**
 * Pacote de classes e objetos das models dos usuários
 * @package cms.mvc.user.model
 */

require_once 'cms/mvc/faq/model/FAQDataAccess.php';
require_once 'cms/mvc/faq/model/entity/FAQ.php';

/**
 * Acesso de dados de usuários à um banco MySQL
 * @author mauricio
 *
 */
class MySQLFAQDataAccess implements FAQDataAccess {

	/**
	 * @see FAQDataAccess::getByID
	 * @param integer $id
	 * @return FAQ
	 */
	public function getByID( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT  *
							FROM  `cms_faq`
							WHERE  `idFAQ` = :id;' );
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'FAQ' );
		$stm->execute();

		$faq = $stm->fetch();

		$stm->closeCursor();

		if ( $faq instanceof FAQ ) {
			return $faq;
		} else {
			throw new RuntimeException( 'Nenhuma pergunta encontrada com o ID fornecido.' );
		}
	}

	/**
	 * @see FAQDataAccess::getAll
	 * @return array[FAQ]
	 */
	public function getAll(){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT  *
							FROM  `cms_faq`');
		$stm->setFetchMode( PDO::FETCH_CLASS , 'FAQ' );
		$stm->execute();

		return $stm->fetchAll();
	}

	public function save( FAQ $FAQ ){
		$pdo = Registry::getInstance()->get( 'pdo' );

		// Verifica se todos os campos estão preenchidos
		if(!$FAQ->getFAQQuestion()){
			throw new RuntimeException( 'É necessário digitar uma pergunta.' );
		}

		if(!$FAQ->getFAQAnswer()){
			throw new RuntimeException( 'É necessário informar uma resposta para a pergunta.' );
		}

		if( !$FAQ->getIdFAQ() ){ // adiciona
			$stm = $pdo->prepare( 'INSERT INTO `cms_faq`(`FAQQuestion`, `FAQAnswer`)
										VALUES (:question, :answer);' );
			$stm->bindParam( ':question' , $FAQ->getFAQQuestion(), PDO::PARAM_STR );
			$stm->bindParam( ':answer' , $FAQ->getFAQAnswer(), PDO::PARAM_STR );
		}else{
			$stm = $pdo->prepare( 'UPDATE `cms_faq` 
									SET `FAQQuestion`=:question,`FAQAnswer`=:answer
									WHERE `idFAQ` = :id ' );
			$stm->bindParam( ':question' , $FAQ->getFAQQuestion(), PDO::PARAM_STR );
			$stm->bindParam( ':answer' , $FAQ->getFAQAnswer(), PDO::PARAM_STR );
			$stm->bindParam( ':id' , $FAQ->getIdFAQ(), PDO::PARAM_INT );
				
		}
		$stm->execute();
	}

	/**
	 * @param int $id ID do usuário a ser deletado
	 * @see LinkDataAccess::delete
	 */
	public function delete( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'DELETE FROM `cms_faq` WHERE `idFAQ` = :id' );
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->execute();
	}

}