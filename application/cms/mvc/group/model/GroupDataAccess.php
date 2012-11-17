<?php
/**
 * Pacote de classes e objetos das models dos grupos de usuários
 * @package cms.mvc.group.model
 */


/**
 * Interface para criação de um acesso à dados dos grupos de usuários do sistema
 * @author mauricio
 *
 */

interface GroupDataAccess {
	
	/**
	 * Recupera os dados de um grupo pelo ID
	 * @param integer $id
	 * @return Group
	 */
	public function getGroupByID( $id );
	
}