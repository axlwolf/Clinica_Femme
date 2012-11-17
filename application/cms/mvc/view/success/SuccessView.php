<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/view/ApplicationView.php';

/**
 * Implementação da View de sucesso
 * @author	mauricio
 */
class SuccessView extends ApplicationView {
	
	/**
	 * @see ApplicationView::$contentPage
	 * @var string
	 */
	protected $contentPage = 'view/templates/success.html';
	
	/**
	 * 
	 * @var string
	 */
	private $message;
	
	/**
	 * 
	 * @param string $successTitle Título da página de sucesso
	 */
	public function __construct( $successTitle ){
		parent::__construct();
		
		$this->assign( 'successTitle', $successTitle );
		
		//Define o título da página
		$this->setResourceTitle( 'Sucesso!' );
	}
	
	/**
	 * Atribui uma mensagem de erro ao template
	 * @param string $message Mensagem a ser exibida
	 */
	public function setMessage( $message ){
		$this->message = $message;
		$this->assign( 'message', $this->message );
	}
	
}