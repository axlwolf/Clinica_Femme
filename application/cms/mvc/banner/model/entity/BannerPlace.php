<?php
/**
 * Classes e objetos relacionados com a model dos usuários
 * @package	cms.mvc.banner.model
 */

/**
 * Entidade de um local de banner
 * @author mauricio
 *
 */
final class BannerPlace {

	/**
	 *
	 * @var integer
	 */
	private $idBannerPlace;

	/**
	 *
	 * @var string
	 */
	private $bannerPlaceName;

	/**
	 *
	 * @var integer
	 */
	private $bannerPlaceWidth;

	/**
	 *
	 * @var integer
	 */
	private $bannerPlaceHeight;

	/**
	 * @param integer $id Id do local do banner
	 */
	public function setIdBannerPlace( $id ){
		$this->idBannerPlace = (int) $id;
	}

	/** Atribui a largura do local
	 * @param integer $width Largura do local do banner
	 */
	public function setBannerPlaceWidth( $width ){
		$this->bannerPlaceWidth = (int) $width;
	}

	/** Atribui a altura do local
	 * @param integer $height Altura do local do banner
	 */
	public function setBannerPlaceHeight( $height ){
		$this->bannerPlaceHeight = (int) $height;
	}

	/**
	 * @param string $name Nome do local do banner
	 */
	public function setBannerPlaceName( $name ){
		$this->bannerPlaceName = $name;
	}


	/**
	 * @return integer
	 */
	public function getIdBannerPlace(){
		return $this->idBannerPlace;
	}

	/**
	 * @return integer
	 */
	public function getBannerPlaceWidth(){
		return $this->bannerPlaceWidth;
	}

	/**
	 * @return integer
	 */
	public function getBannerPlaceHeight(){
		return $this->bannerPlaceHeight;
	}

	/**
	 * @return string
	 */
	public function getBannerPlaceName(){
		return $this->bannerPlaceName;
	}

}