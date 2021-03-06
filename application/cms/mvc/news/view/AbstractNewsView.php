<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/view/crud/CrudView.php';

/**
 * Implementação da View de uma galeria de fotos
 * @author	mauricio
 */
abstract class AbstractNewsView extends CrudView {

	/**
	 *
	 * @var string
	 */
	protected $contentPage = 'news/view/templates/default.html';

	/**
	 *
	 * @var string
	 */
	protected $contentSubPage;
	
	/**
	 * 
	 * @var string
	 */
	protected $tab;


	public function __construct(){
		parent::__construct();

		if( !empty( $this->contentSubPage ) && !is_null( $this->contentSubPage ) ){
			$this->setContentSubPage( $this->contentSubPage );
		}

		$resourceBundle = Application::getInstance()->getBundle();

		$this->setResourceTitle( $resourceBundle->getString( 'NEWS_PAGE_TITLE' ) );
		$this->setResourceDescription( $resourceBundle->getString( 'NEWS_PAGE_DESCRIPTION' ) );

	}

	/**
	 * Atribui um template de conteúdo do módulo de galeria de fotos
	 * @param string $page Template a ser utilizado pelo usuário
	 */
	public function setContentSubPage( $page ){
		$this->contentSubPage = 'news/view/templates/'. $page;
		$this->assign( 'contentSubPage', 'news/view/templates/'.$page );
	}

	/**
	 * Define a aba da interface que o usuário está utilizando
	 * @param string $tab Aba utilizada pelo usuário
	 */
	public function setTab( $tab = 'news'){
		$this->tab = $tab;
		$this->assign( 'tab', $tab );
	}
}
