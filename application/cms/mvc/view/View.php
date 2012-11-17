<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'smarty/Smarty.class.php';

/**
 * Interface para implementação de uma View
 * @author	mauricio
 */
abstract class View extends Smarty {

	/**
	 * @var	string
	 */
	protected $title;
	
	/**
	 * @var string
	 */
	protected $page;

	public function __construct() {
		parent::__construct();
		$this->setTitle( 'Sem título' );
		
		$this->setCacheDir( '../application/cms/smarty/cache' );
		$this->setCompileDir( '../application/cms/smarty/compiled' );
		$this->setConfigDir( '../application/cms/smarty/configs' );
		$this->setTemplateDir( '../application/cms/mvc/' );
		
	}
	
	/**
	 * Recupera o título da View.
	 * @return	string
	 * @see		Component::getParent()
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Define o título da View.
	 * @param	string $title O título da View
	 * @return	View Uma referência à própria View.
	 * @see		Component::setTitle()
	 */
	public function setTitle( $title ) {
		$this->title = $title;
		$this->assign( 'title', $this->title );
		return $this;
	}

	/**
	 * Exibe a View
	 * @see		Component::draw()
	 */
	public function show() {
		$this->display( $this->page );
		die();
	}
}