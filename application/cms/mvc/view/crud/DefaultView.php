<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/view/crud/CrudView.php';

/**
 * Implementação da View de um módulo default
 * @author	mauricio
 */
abstract class DefaultView extends CrudView {

	/**
	 * @var Entity
	 */
	private $one;

	/**
	 *
	 * @var array
	 */
	private $all;

	/**
	 * Atribui um registro para ser mostrado
	 * @param Entity $entity
	 */
	public function setOne( Entity $entity ){
		$this->event = $event;
	}

	/**
	 * Atribui uma lista de registros a ser mostrado
	 * @param array[Entity] $entities
	 */
	public function setAll( $entities ){
		$this->all = $entities;
		$this->assign( 'dataTable', $entities );
	}

}