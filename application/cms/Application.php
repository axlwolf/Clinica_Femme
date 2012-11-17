<?php
/**
 * Gerenciamento de Conteúdo Martinhago
 * @package cms
 */

require_once 'cms/mvc/controller/ControllerManager.php';
require_once 'cms/mvc/controller/auth/AuthController.php';
require_once 'cms/mvc/controller/auth/LogoutController.php';
require_once 'cms/mvc/user/controller/UserController.php';
require_once 'cms/mvc/home/controller/HomeController.php';
require_once 'cms/mvc/profile/controller/ProfileController.php';
require_once 'cms/mvc/view/error/ErrorView.php';
require_once 'cms/mvc/model/mysql/MySQLDataAccessFactory.php';
require_once 'cms/util/ResourcesBundle.php';
require_once 'cms/util/Registry.php';

// módulo de configurações
require_once 'cms/mvc/configs/controller/ConfigsController.php';

/**
 * Classe principal da aplicação
 * @author	mauricio
 */
class Application {
	/**
	 * @var	Application
	 */
	private static $instance;

	/**
	 * @var	ControllerManager
	 */
	private $controllerManager;

	/**
	 * @var	ResourcesBundle
	 */
	private $resourceBundle;

	private function __construct() {
		$this->resourceBundle = ResourcesBundle::getInstance();
		$this->resourceBundle->load( 'cms/res/default' , 'pt' );

		$this->controllerManager = ControllerManager::getInstance();
		$this->controllerManager->addController( new HomeController() );
		$this->controllerManager->addController( new ConfigsController() );
		$this->controllerManager->addController( new UserController() );

		// Controlador de Autenticação
		$this->controllerManager->addController( new AuthController() );
		$this->controllerManager->addController( new LogoutController() );
	}

	/**
	 * Recupera o pacote de recursos da aplicação.
	 * @return	ResourcesBundle
	 */
	public function getBundle() {
		return $this->resourceBundle;
	}

	/**
	 * Delega a manipulação das requisições feitas à
	 * aplicação ao controlador responsável.
	 */
	public function handle() {
		try {
			
			$resourceBundle = self::getInstance()->getBundle();
			
			if( $resourceBundle->getString('STAGING') === 'production' )
				error_reporting(0);
			else if ( $resourceBundle->getString('STAGING') === 'development' )
				error_reporting( E_ALL | E_STRICT );
			
			Registry::getInstance()->set( 'dataAccessFactory' , new MySQLDataAccessFactory() );

			$this->sessionInit();
			
			$this->controllerManager->handle();
				
		} catch ( Exception $e ) {
			$view = new ErrorView();
			$view->setMessage( $e->getMessage() );
			$view->show();
		}
	}

	/**
	 * Recupera a instância da aplicação.
	 * @return	Application
	 */
	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new Application();
		}

		return self::$instance;
	}

	public function sessionInit(){
		session_save_path( realpath( dirname(__FILE__) ) . '/session/' );		
		session_start();
	}
	
	/**
	 * Inicializa a aplicação.
	 * @see		Application::handle()
	 */
	public static function start() {
		self::getInstance()->handle();
	}
	
}