<?php
/**
 * Classes e objetos relacionados com os controladores de configurações
 * @package	cms.mvc.configs.controller
 */

require_once 'cms/mvc/controller/Controller.php';
require_once 'cms/mvc/configs/view/ConfigsView.php';
require_once 'cms/mvc/configs/model/entity/Configuration.php';
require_once 'cms/mvc/view/success/SuccessView.php';
require_once 'cms/mvc/model/Auth.php';

/**
 * Controlador de Configurações
 * @author	Mauricio Giacomini Girardello
 */
class ConfigsController extends Controller {

	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {

		if(Auth::getInstance()->isAuth() && $_GET[ 'c' ] == 'configs'){
			return $this->canBeHandleBy( $_SESSION['CMS']['user']['group'] );
		}

		return false;
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {
		//Instancia o bd
		$configDataAccess = Registry::getInstance()->get( 'dataAccessFactory' )->createConfigsDataAccess();

		//Gerenciador de pacotes
		$resourceBundle = Application::getInstance()->getBundle();

		// salva uma requisição de criação
		if( $_POST['save'] ){
				
			//Atribui uma configuração
			$config = new Configuration();
			$config->setConfigDescription( $_POST['description'] );
			$config->setConfigEmail( $_POST['email'] );
			$config->setConfigGAAcc( $_POST['GAAcc'] );
			$config->setConfigGAPassword( $_POST['GAPassword'] );
			$config->setConfigGAId( $_POST['GAId'] );
			$config->setConfigKeyWords( $_POST['keywords'] );
			$config->setConfigScriptGA( $_POST['script'] );
			$config->setConfigTitle( $_POST['title'] );
			$config->setidConfig( 1 );

			//Salva os dados
			$configDataAccess->save( $config );

			//Título da página de sucesso
			$message = "A configuração foi atualizada com sucesso.";
				
			//View de sucesso
			$successView = new SuccessView( $message );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();

		}

		//View
		$view = new ConfigsView();
		$view->setConfig( $configDataAccess->getConfig() );
		$view->setTemplateForDefault();
		$view->show();
	}
}