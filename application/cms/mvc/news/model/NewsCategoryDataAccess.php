<?php
/**
 * Pacote de classes e objetos das models da galeria de fotos
 * @package cms.mvc.photo.model
 */


/**
 * Interface para criação de um acesso à dados das categorias
 * @author mauricio
 *
 */

interface NewsCategoryDataAccess {
	
	/**
	 * Recupera os dados de uma categoria pelo ID
	 * @param integer $id
	 * @return NewsCategory
	 */
	public function getCategoryByID( $id );
	
	/**
	 * Recupera todos as categorias
	 * @return array
	 */
	public function getCategories();
	
	/**
	 * Edita ou adiciona uma categoria. Caso for passado um ID é editado, caso contrário é adicionado
	 * @param NewsCategory $category Dados de uma categoria a ser salva
	 */
	public function save( NewsCategory $category );
	
	/**
	 * Deleta uma categoria e todos as respectivas galerias pertencentes à ela
	 * @param integer $id Id da categoria
	 */
	public function delete( $id );
	
}
