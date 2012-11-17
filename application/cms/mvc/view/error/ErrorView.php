<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/view/ApplicationView.php';

/**
 * Implementação da View de usuário
 * @author	mauricio
 */
class ErrorView extends ApplicationView {
	
	/**
	 * @see ApplicationView::$contentPage
	 * @var string
	 */
	protected $contentPage = 'view/templates/error.html';
	
	/**
	 * 
	 * @var string
	 */
	private $message;
	
	public function __construct(){
		parent::__construct();
		
		//Recupera o título da página de erro
		$title = Application::getInstance()->getBundle()->getString( 'ERROR_TITLE' );
		
		//Recupera o nome do botão
		$button = Application::getInstance()->getBundle()->getString( 'ERROR_BUTTON' );
		$this->assign( 'bt_value', $button );
		
		//Define o título da página
		$this->setTitle( $title );
		$this->setResourceTitle( 'Erro' );
	}
	
	/**
	 * Atribui uma mensagem de erro ao template
	 * @param string $message Mensagem a ser exibida
	 */
	public function setMessage( $message ){
		$this->message = $message;
		$this->assign( 'message', $this->message );
	}
	
	/**
	 * Retorna a mensagem de erro
	 * @return string
	 */
	public function getMessage(){
		return $this->message;
	}
	
}