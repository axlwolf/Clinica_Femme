<?php
/**
 * Pacote de classes e objetos das models das configurações
 * @package cms.mvc.configs.model
 */


/**
 * Interface para criação de um acesso à dados das configurações
 * @author mauricio
 *
 */

interface ConfigsDataAccess {
	
	/**
	 * Recupera os dados de uma configuração
	 * @return Configuration
	 */
	public function getConfig();
	
	/**
	 * Edita uma configuração
	 * @param Configuration $config Entidade de uma configuração
	 */
	public function save( Configuration $config );
	
}