<?php
/**
 * Classes e objetos relacionados com os controladores
 * da aplicação
 * @package	cms.mvc.controller.auth
 */

require_once 'cms/mvc/controller/Controller.php';
require_once 'cms/mvc/model/Auth.php';
require_once 'cms/mvc/model/auth/adapter/DataAccessAuthAdapter.php';
require_once 'cms/mvc/view/LoginView.php';

/**
 * Controlador da autenticação
 * @author	mauricio
 */
class AuthController extends Controller {

	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {
		$auth = Auth::getInstance();
		return !$auth->isAuth() || $_GET[ 'c' ] == 'login';
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {
		
		$auth = Auth::getInstance();
		
		$view = new LoginView();
		
		//Quando enviado o formulário, é feito a autenticação
		if( $_POST['submit-login'] ){
			$dataAccessAdapter = new DataAccessAuthAdapter();
			$dataAccessAdapter->setLogin( $_POST['login'] );
			$dataAccessAdapter->setPassword( $_POST['password'] );

			if($auth->write( $dataAccessAdapter )){
				header("location: ?c=home");
			}else{
				$view->assign( 'authError', true );
			}

		}
		
		$view->show();
		
	}
}