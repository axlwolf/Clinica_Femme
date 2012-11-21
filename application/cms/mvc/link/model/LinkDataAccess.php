<?php
/**
 * Pacote de classes e objetos das models do mural de recados
 * @package cms.mvc.scrapbook.model
 */


/**
 * Interface para criação de um acesso à dados de um mural de recados
 * @author mauricio
 *
 */

interface LinkDataAccess {
	
	/**
	 * @param integer $id
	 * @return Link
	 */
	public function getByID( $id );
	
	/**
	 * @return array
	 */
	public function getAll();
	
	/**
	 * @param Link $link
	 */
	public function save( Link $link );
	
	/**
	 * @param integer $id
	 */
	public function delete( $id );
	
}