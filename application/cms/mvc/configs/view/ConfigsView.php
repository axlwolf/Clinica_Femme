<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/view/ApplicationView.php';

/**
 * Implementação da View de configurações
 * @author	mauricio
 */
class ConfigsView extends ApplicationView {

	/**
	 *
	 * @var string
	 */
	protected $contentPage = 'configs/view/templates/default.html';


	/**
	 * @var Configuration
	 */
	private $config;

	
	public function __construct(){
		parent::__construct();

		$resourceBundle = Application::getInstance()->getBundle();

		$this->setResourceTitle( $resourceBundle->getString( 'CONFIGS_PAGE_TITLE' ) );
		$this->setResourceDescription( $resourceBundle->getString( 'CONFIGS_PAGE_DESCRIPTION' ) );
		
	}

	/**
	 * @see CrudView::setTemplateForDefault
	 * @throws LogicException Quando não haver nenhum registro para popular o formulário
	 */
	public function setTemplateForDefault(){
		$resourceBundle = Application::getInstance()->getBundle();

		if( !$this->config ){
			throw new LogicException( 'É necessário informar uma configuração.' );
		}

		$this->setContentPage( 'configs/view/templates/default.html' );

		//Popula os campos do formulário do template
		$this->assign( 'configTitle', $this->config->getConfigTitle() );
		$this->assign( 'configDescription', $this->config->getConfigDescription() );
		$this->assign( 'configEmail', $this->config->getConfigEmail() );
		$this->assign( 'configKeyWords', $this->config->getConfigKeyWords() );
		$this->assign( 'configScriptGA', $this->config->getConfigScriptGA() );
		$this->assign( 'configGAAcc', $this->config->getConfigGAAcc() );
		$this->assign( 'configGAPassword', $this->config->getConfigGAPassword() );
		$this->assign( 'configGAId', $this->config->getConfigGAId() );
	}

	/**
	 * 
	 * @param Configuration $config
	 */
	public function setConfig( Configuration $config ){
		$this->config = $config;
	}

}