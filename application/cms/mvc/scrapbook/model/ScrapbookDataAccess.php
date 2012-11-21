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

interface ScrapbookDataAccess {
	
	/**
	 * @param integer $id
	 * @return Scrap
	 */
	public function getByID( $id );
	
	/**
	 * @return array
	 */
	public function getAll();
	
	/**
	 * @param Scrap $scrap
	 */
	public function edit( Scrap $scrap );
	
	/**
	 * @param integer $id
	 */
	public function delete( $id );
	
}