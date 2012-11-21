<?php
/**
 * Pacote de classes e objetos das models da galeria de fotos
 * @package cms.mvc.photo.model
 */


/**
 * Interface para criação de um acesso à dados das galerias de fotos
 * @author mauricio
 *
 */

interface NewsDataAccess {
	
	/**
	 * Recupera os dados de uma galeria pelo ID
	 * @param integer $id
	 * @return NewsEntity
	 */
	public function getByID( $id );
	
	/**
	 * Recupera todos as galerias
	 * @return array
	 */
	public function getAll();
	
	/**
	 * Recupera todas as galerias de uma categoria
	 * @param integer $idCategory ID da categoria
	 * @return array
	 */
	public function getByCategory( $idCategory );
	
	/**
	 * Edita ou adiciona uma noticia
	 * @return integer
	 */
	public function save( NewsEntity $news );
	
	/**
	 * Deleta uma noticia
	 * @param integer $id
	 */
	public function delete( $id );
	
}
