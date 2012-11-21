<?php
/**
 * Classes e objetos relacionados com a model do mural de recados
 * @package	cms.mvc.scrapbook.model
 */

/**
 * Entidade de um recado
 * @author mauricio
 *
 */
final class FAQ {
	/**
	 *
	 * @var integer
	 */
	private $idFAQ;

	/**
	 *
	 * @var string
	 */
	private $FAQQuestion;

	/**
	 *
	 * @var string
	 */
	private $FAQAnswer;

	/**
	 * @param integer $id
	 */
	public function setIdFAQ( $id ){
		$this->idFAQ = (int) $id;
	}

	/**
	 *
	 * @param string $question
	 */
	public function setFAQQuestion( $question ){
		$this->FAQQuestion = $question;
	}

	/**
	 *
	 * @param string $answer
	 */
	public function setFAQAnswer( $answer ){
		$this->FAQAnswer = $answer;
	}

	/**
	 * @return integer
	 */
	public function getIdFAQ(){
		return $this->idFAQ;
	}

	/**
	 * @return string
	 */
	public function getFAQQuestion(){
		return $this->FAQQuestion;
	}

	/**
	 * @return string
	 */
	public function getFAQAnswer(){
		return $this->FAQAnswer;
	}

}