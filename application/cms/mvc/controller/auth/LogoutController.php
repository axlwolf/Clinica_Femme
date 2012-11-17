<?php
/**
 * Classes e objetos relacionados com os controladores
 * da aplicação
 * @package	cms.mvc.controller.auth
 */

require_once 'cms/mvc/controller/Controller.php';
require_once 'cms/mvc/model/Auth.php';

/**
 * Controlador de logout
 * @author	mauricio
 */
class LogoutController extends Controller {

	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {
		$auth = Auth::getInstance();
		return $_GET[ 'c' ] == 'logout';
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {
		$auth = Auth::getInstance();
		$auth->logout();
		header("location: ?c=login");
	}
}