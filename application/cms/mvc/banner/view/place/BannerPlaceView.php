<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/banner/view/AbstractBannerView.php';

/**
 * Implementação da View de local de um banner
 * @author	mauricio
 */
class BannerPlaceView extends AbstractBannerView {

	/**
	 *
	 * @var string
	 */
	protected $contentSubPage = 'place/default.html';

	/**
	 * @var BannerPlace
	 */
	private $bannerPlace;

	/**
	 *
	 * @var array
	 */
	private $bannerPlaces;


	public function __construct(){
		parent::__construct();

		// define a aba que está sendo utilizada pelo usuário
		$this->setTab( 'place' );

		$this->categories = array();
	}

	/**
	 * @see CrudView::setTemplateForEdit
	 * @throws LogicException Quando não haver nenhum registro para popular o formulário
	 */
	public function setTemplateForEdit(){
		$resourceBundle = Application::getInstance()->getBundle();

		if( !$this->bannerPlace ){
			throw new LogicException( 'É necessário informar um local à ser editado.' );
		}

		$this->setContentSubPage( 'place/form.html' );
		$this->setFormTitle( $resourceBundle->getString( 'BANNERS_PLACE_FORM_EDIT' ) );

		//Popula os campos do formulário do template
		$this->assign( 'bannerPlaceName', $this->bannerPlace->getBannerPlaceName() );
		$this->assign( 'bannerPlaceWidth', $this->bannerPlace->getBannerPlaceWidth() );
		$this->assign( 'bannerPlaceHeight', $this->bannerPlace->getBannerPlaceHeight() );
		$this->assign( 'idBannerPlace', $this->bannerPlace->getIdBannerPlace() );
	}

	/**
	 * @see CrudView::setTemplateForCreate
	 */
	public function setTemplateForCreate(){
		$resourceBundle = Application::getInstance()->getBundle();

		$this->setContentSubPage( 'place/form.html' );
		$this->setFormTitle( $resourceBundle->getString( 'BANNERS_PLACE_FORM_CREATE' ) );
	}

	/**
	 * @see CrudView::setTemplateForDefault
	 * @throws LogicException Quando não haver nenhuma lista de registros à ser mostrada
	 */
	public function setTemplateForDefault(){
		$resourceBundle = Application::getInstance()->getBundle();
		$this->setContentSubPage( 'place/default.html' );
	}


	/**
	 *
	 * @param BannerPlace $bannerPlace
	 */
	public function setBannerPlace( BannerPlace $bannerPlace ){
		$this->bannerPlace = $bannerPlace;
	}

	/**
	 *
	 * @param array $bannerPlaces
	 */
	public function setBannerPlaces( $bannerPlaces ){
		$this->bannerPlaces = $bannerPlaces;
		$this->assign( 'dataTable', $bannerPlaces );
	}

}