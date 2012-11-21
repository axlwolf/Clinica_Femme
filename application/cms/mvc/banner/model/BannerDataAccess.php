<?php
/**
 * Pacote de classes e objetos das models dos usuários
 * @package cms.mvc.banner.model
 */


/**
 * Interface para criação de um acesso à dados dos banners
 * @author mauricio
 *
 */

interface BannerDataAccess {
	
	/**
	 * Recupera os dados de um banner pelo ID
	 * @param integer $id
	 * @return Banner
	 */
	public function getBannerByID( $id );
	
	/**
	 * Recupera os banners de um local
	 * @param integer $idBannerPlace
	 * @return array
	 */
	public function getBannersByPlace( $idBannerPlace );
	
	/**
	 * Recupera todos os banners
	 * @return array : Banner
	 */
	public function getBanners();
	
	/**
	 * Edita ou adiciona um banner. Caso for passado um Banner::$idBanner é editado, caso contrário é adicionado
	 * @param Banner $banner Dados de um banner para serem cadastrados
	 */
	public function save( Banner $banner );
	
	/**
	 * Deleta um banner
	 * @param integer $id Id do banner
	 */
	public function delete( $id );
	
}