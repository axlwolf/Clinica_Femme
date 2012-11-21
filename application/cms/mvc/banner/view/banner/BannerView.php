<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/banner/view/AbstractBannerView.php';

/**
 * Implementação da View de banners
 * @author	mauricio
 */
class BannerView extends AbstractBannerView {

	/**
	 *
	 * @var string
	 */
	protected $contentSubPage = 'banner/default.html';

	/**
	 * @var Banner
	 */
	private $banner;

	/**
	 *
	 * @var array
	 */
	private $banners;

	/**
	 *
	 * @var array
	 */
	private $places;


	public function __construct(){
		parent::__construct();

		// define a aba que está sendo utilizada pelo usuário
		$this->setTab( 'banner' );

		$resourceBundle = Application::getInstance()->getBundle();
	}

	/**
	 * @see CrudView::setTemplateForEdit
	 * @throws LogicException Quando não haver nenhum registro para popular o formulário
	 */
	public function setTemplateForEdit(){
		$resourceBundle = Application::getInstance()->getBundle();

		if( !$this->banner->getIdBanner() ){
			throw new LogicException( 'É necessário informar um registro à ser editado.' );
		}

		if( !$this->places ){
			throw new LogicException( 'É preciso informar os locais de banners.' );
		}

		$this->setContentSubPage( 'banner/form.html' );
		$this->setFormTitle( $resourceBundle->getString( 'BANNERS_FORM_EDIT' ) );

		//Popula os campos do formulário do template
		$this->assign( 'idBanner', $this->banner->getIdBanner() );
		$this->assign( 'idBannerPlace', $this->banner->getidBannerPlace() );
		$this->assign( 'bannerTitle', $this->banner->getBannerTitle() );
		$this->assign( 'bannerDescription', $this->banner->getBannerDescription() );
		$this->assign( 'bannerDateIn', $this->banner->getBannerDateIn() );
		$this->assign( 'bannerDateOut', $this->banner->getBannerDateOut() );
		$this->assign( 'bannerLink', $this->banner->getBannerLink() );	
		
		//Verifica se o arquivo do banner existe
		//Diretório
		$dirUrl = trim($resourceBundle->getString('BANNERS_UPLOAD_URL'), '/\\');
		$dirPath = trim($resourceBundle->getString('BANNERS_UPLOAD_DIR'), '/\\');
		$file = $dirUrl .'/'. $this->banner->getBannerFile();
		$filePath = '/'. $dirPath .'/'. $this->banner->getBannerFile();
		if( file_exists( $filePath ) ){
			$this->assign( 'bannerFile', $file );
		}else{
			$this->assign( 'bannerFile', false );
		}

	}

	/**
	 * @see CrudView::setTemplateForCreate
	 * @throws LogicException Quando não haver nenhuma categoria 
	 */
	public function setTemplateForCreate(){

		if( !$this->places ){
			throw new LogicException( 'Não há nenhum local de banner. Por favor, antes de cadastrar um banner cadastre um local.' );
		}

		$resourceBundle = Application::getInstance()->getBundle();
		$this->setContentSubPage( 'banner/form.html' );
		$this->setFormTitle( $resourceBundle->getString( 'BANNERS_FORM_CREATE' ) );
	}

	/**
	 * @see CrudView::setTemplateForDefault
	 */
	public function setTemplateForDefault(){
		$resourceBundle = Application::getInstance()->getBundle();

		$this->setContentSubPage( 'banner/default.html' );

		//Monta a lista de registros a ser mostrada no template
		$this->assign( 'dataTable', $this->banners );

	}

	/**
	 *
	 * @param array $banners Lista de banners a serem listados
	 */
	public function setBanners( $banners ){
		$this->banners = $banners;
		//Monta a lista de registros a ser mostrada no template
		$this->assign( 'dataTable', $this->banners );
	}

	/**
	 *
	 * @param Banner $banner Banner para ser listado
	 */
	public function setBanner( Banner $banner ){
		$this->banner = $banner;
	}

	/**
	 * Atribui os lugares de banners
	 * @param array $places Lugares
	 */
	public function setPlaces( $places ){
		$this->places = $places;

		foreach( $this->places as $place ){
			$places[ $place->getIdBannerPlace() ] = $place->getBannerPlaceName() . ' - ' . $place->getBannerPlaceWidth() .'x'. $place->getBannerPlaceHeight();
		}

		$this->assign( 'places_options', $places);
	}

}