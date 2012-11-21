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
final class Scrap {
	/**
	 *
	 * @var integer
	 */
	private $idScrap;

	/**
	 *
	 * @var string
	 */
	private $scrapName;

	/**
	 *
	 * @var string
	 */
	private $scrapEmail;

	/**
	 *
	 * @var string
	 */
	private $scrapDesc;

	/**
	 *
	 * @var boolean
	 */
	private $scrapApproved;

	/**
	 * @param integer $id
	 */
	public function setIdScrap( $id ){
		$this->idScrap = (int) $id;
	}

	/**
	 *
	 * @param string $name
	 */
	public function setScrapName( $name ){
		$this->scrapName = $name;
	}

	/**
	 *
	 * @param string $email
	 */
	public function setScrapEmail( $email ){
		$this->scrapEmail = $email;
	}

	/**
	 *
	 * @param string $desc
	 */
	public function setScrapDesc( $desc ){
		$this->scrapDesc = $desc;
	}

	/**
	 *
	 * @param boolean $approved
	 */
	public function setScrapApproved( $approved = false ){
		$this->scrapApproved = $approved;
	}

	/**
	 * @return integer
	 */
	public function getIdScrap(){
		return $this->idScrap;
	}

	/**
	 * @return string
	 */
	public function getScrapName(){
		return $this->scrapName;
	}

	/**
	 * @return string
	 */
	public function getScrapEmail(){
		return $this->scrapEmail;
	}

	/**
	 * @return string
	 */
	public function getScrapDesc(){
		return $this->scrapDesc;
	}

	/**
	 * @return string
	 */
	public function getScrapApproved(){
		return $this->scrapApproved;
	}
}