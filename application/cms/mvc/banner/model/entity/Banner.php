<?php
/**
 * Classes e objetos relacionados com a model dos usuários
 * @package	cms.mvc.banner.model
 */

/**
 * Entidade de um banner
 * @author mauricio
 *
 */
final class Banner {

	/**
	 *
	 * @var integer
	 */
	private $idBanner;

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
	 * @var string
	 */
	private $bannerTitle;

	/**
	 *
	 * @var string
	 */
	private $bannerDescription;

	/**
	 *
	 * @var datetime
	 */
	private $bannerDateIn;

	/**
	 *
	 * @var datetime
	 */
	private $bannerDateOut;

	/**
	 *
	 * @var string
	 */
	private $bannerFile;

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
	 *
	 * @var string
	 */
	private $bannerLink;


	/**
	 * @param integer $id Id do banner
	 */
	public function setIdBanner( $id ){
		$this->idBanner = (int) $id;
	}

	/**
	 * @param integer $id Id do local do banner
	 */
	public function setIdBannerPlace( $id ){
		$this->idBannerPlace = (int) $id;
	}

	/**
	 *
	 * @param string $name Nome do local
	 */
	public function setBannerPlaceName( $name ){
		$this->bannerPlaceName = $name;
	}

	/**
	 *
	 * @param string $title Título do banner
	 */
	public function setBannerTitle( $title ){
		$this->bannerTitle = $title;
	}

	/**
	 *
	 * @param string $description Descrição do banner
	 */
	public function setBannerDescription( $description ){
		$this->bannerDescription = $description;
	}

	/**
	 *
	 * @param datetime $dateIn Data e hora de entrada do banner
	 */
	public function setBannerDateIn( $dateIn ){
		$this->bannerDateIn = $dateIn;
	}

	/**
	 *
	 * @param datetime $dateOut Data e hora de saída do banner
	 */
	public function setBannerDateOut( $dateOut ){
		$this->bannerDateOut = $dateOut;
	}

	/**
	 *
	 * @param string $file Nome do arquivo do banner
	 */
	public function setBannerFile( $file ){
		$this->bannerFile = $file;
	}


	/**
	 * @return integer
	 */
	public function getIdBanner(){
		return $this->idBanner;
	}

	/**
	 * @return integer
	 */
	public function getIdBannerPlace(){
		return $this->idBannerPlace;
	}

	/**
	 *
	 * @return string
	 */
	public function getBannerTitle(){
		return $this->bannerTitle;
	}

	/**
	 *
	 * @return string
	 */
	public function getBannerPlaceName(){
		return $this->bannerPlaceName;
	}

	/**
	 *
	 * @return string
	 */
	public function getBannerDescription(){
		return $this->bannerDescription;
	}

	/**
	 *
	 * @return datetime
	 */
	public function getBannerDateIn(){
		return $this->bannerDateIn;
	}

	/**
	 *
	 * @return datetime
	 */
	public function getBannerDateOut(){
		return $this->bannerDateOut;
	}

	/**
	 *
	 * @return string
	 */
	public function getBannerFile(){
		return $this->bannerFile;
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
	 * @return integer
	 */
	public function getBannerPlaceWidth(){
		return $this->bannerPlaceWidth;
	}

	/**
	 * 
	 * @param string $link Link do Banner
	 */
	public function setBannerLink( $link = null ){		
		if( $link === null || empty( $link ) ){
			$this->bannerLink = '#';
		}else{
			$this->bannerLink = $link;
		}
	}

	/**
	 * @return string
	 */
	public function getBannerLink(){
		return $this->bannerLink;
	}

	/**
	 * @return integer
	 */
	public function getBannerPlaceHeight(){
		return $this->bannerPlaceHeight;
	}

}