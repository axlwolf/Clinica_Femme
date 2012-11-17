<?php
/**
 * Classes e objetos relacionados com os controladores de usuários
 * @package	cms.mvc.user.controller
 */

require_once 'cms/mvc/controller/Controller.php';
require_once 'cms/mvc/home/view/HomeView.php';
require_once 'cms/mvc/model/Auth.php';

/**
 * Controlador de Users
 * @author	Mauricio Giacomini Girardello
 */
class HomeController extends Controller {

	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {

		// define a permissão
		$this->permission = parent::PERMISSION_ADMIN | parent::PERMISSION_MODERATOR | parent::PERMISSION_OTHERS;

		if(Auth::getInstance()->isAuth() && (!$_GET[ 'c' ] || $_GET[ 'c' ] == 'home')){
			return $this->canBeHandleBy( $_SESSION['CMS']['user']['group'] );
		}

		return false;
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {		
		//View da home
		$view = new HomeView();
		$view->show();
	}
}