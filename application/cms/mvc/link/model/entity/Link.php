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
final class Link {
	/**
	 *
	 * @var integer
	 */
	private $idLink;

	/**
	 *
	 * @var string
	 */
	private $linkName;

	/**
	 *
	 * @var string
	 */
	private $linkUrl;

	/**
	 * @param integer $id
	 */
	public function setIdLink( $id ){
		$this->idLink = (int) $id;
	}

	/**
	 *
	 * @param string $name
	 */
	public function setLinkName( $name ){
		$this->linkName = $name;
	}

	/**
	 *
	 * @param string $url
	 */
	public function setLinkUrl( $url ){
		$this->linkUrl = $url;
	}

	/**
	 * @return integer
	 */
	public function getIdLink(){
		return $this->idLink;
	}

	/**
	 * @return string
	 */
	public function getLinkName(){
		return $this->linkName;
	}

	/**
	 * @return string
	 */
	public function getLinkUrl(){
		return $this->linkUrl;
	}

}