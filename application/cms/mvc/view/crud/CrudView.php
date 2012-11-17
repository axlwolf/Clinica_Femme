<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/view/ApplicationView.php';

/**
 * Implementação da View de CRUD
 * @author	mauricio
 */
abstract class CrudView extends ApplicationView {
	
	/**
	 * 
	 * @var string
	 */
	protected $formTitle;
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * Atribui um título ao formulário
	 * @param string $title Título do formulário
	 */
	public function setFormTitle( $title ){
		$this->formTitle = $title;
		$this->assign( 'formTitle', $title );
	}
	
	/**
	 * Atribui o template para edição
	 */
	public abstract function setTemplateForEdit();
	
	/**
	 * Atribui o template para criação
	 */
	public abstract function setTemplateForCreate();
	
	/**
	 * Template padrão da view
	 */
	public abstract function setTemplateForDefault();
	
}