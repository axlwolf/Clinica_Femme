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

interface FAQDataAccess {
	
	/**
	 * @param integer $id
	 * @return FAQ
	 */
	public function getByID( $id );
	
	/**
	 * @return array
	 */
	public function getAll();
	
	/**
	 * @param FAQ $FAQ
	 */
	public function save( FAQ $FAQ );
	
	/**
	 * @param integer $id
	 */
	public function delete( $id );
	
}