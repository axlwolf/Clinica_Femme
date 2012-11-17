<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/view/ApplicationView.php';

/**
 * Implementação da View da home
 * @author	mauricio
 */
class HomeView extends ApplicationView {

	/**
	 *
	 * @var string
	 */
	protected $contentPage = 'home/view/templates/default.html';


	public function __construct(){
		parent::__construct();

		$resourceBundle = Application::getInstance()->getBundle();

		$this->setResourceTitle( $resourceBundle->getString( 'HOME_PAGE_TITLE' ) );
		$this->setResourceDescription( $resourceBundle->getString( 'HOME_PAGE_DESCRIPTION' ) );

	}

}