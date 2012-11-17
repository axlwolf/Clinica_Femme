<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

/**
 * Interface para implementação de uma PageWrap
 * @author	mauricio
 */
class PageWrap {
	
	private $item;
	
	/**
	 * Cria uma fábrica de PageWrap's
	 * @return PageWrap
	 */
	public static function factory(){
		return new PageWrap();
	}
	
	public function __construct(){
		$this->item = array();
	}
	
	/**
	 * Contrói um PageWraper a partir de um recurso.
	 * @param string $resource ID de um recurso.
	 * @return array
	 */
	public function build( $resource ){
		$resourceBundle = Application::getInstance()->getBundle();
		
		$i = 0;
		foreach ( $resourceBundle->getResource( $resource ) as $resourceItem ) {
			$this->item[$i]['name'] = $resourceItem->getValue();
			$this->item[$i]['url'] = $resourceItem->getIterator()->current()->getValue();
			$i++;
		}
		
		return $this->item;
	}
	
}