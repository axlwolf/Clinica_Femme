<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/view/View.php';

/**
 * View de login
 * @author	mauricio
 */
class LoginView extends View {
	
	protected $page = 'view/templates/login.html';
	
	public function __construct(){
		parent::__construct();
		$this->setTitle( 'Bem vindo! Faça seu login' );
	}
	
}