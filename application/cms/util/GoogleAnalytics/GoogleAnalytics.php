<?php

require_once 'cms/util/GoogleAnalytics/gapi.php';

class GoogleAnalytics {

	/**
	 * 
	 * @var GoogleAnalytics
	 */
	private static $instance = null;
	
	/**
	 * @var string
	 */
	private $acc;
	
	/**
	 * 
	 * @var string
	 */
	private $id;
	
	/**
	 * 
	 * @var string
	 */
	private $password;
	
	
	public static function getInstance(){
		if( self::$instance == null ){
			self::$instance = new GoogleAnalytics();
		}
		
		return self::$instance;
	}
	
	public function __construct(){
		$config = Registry::getInstance()->get( 'dataAccessFactory' )->createConfigsDataAccess()->getConfig();
		$this->acc = $config->getConfigGAAcc();
		$this->id = $config->getConfigGAId();
		$this->password = $config->getConfigGAPassword();
	}
	
	/**
	 * Inicia a requisição de dados à API do Google Analytics
	 */
	public function init(){
		$googleAnalytics = new gapi( $this->acc, $this->password );
		$googleAnalytics->requestReportData( $this->id, array('date'), array('visitors', 'newVisits', 'visits') );
		
		Registry::getInstance()->set( '__GA_visitors', $googleAnalytics->getMetrics() );
	}

}