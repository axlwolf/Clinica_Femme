<?php
/**
 * Pacote de classes e objetos das models dos usuários
 * @package cms.mvc.banner.model
 */


/**
 * Interface para criação de um acesso à dados dos locais de banners
 * @author mauricio
 *
 */

interface BannerPlaceDataAccess {
	
	/**
	 * Recupera os dados de um local de banner pelo ID
	 * @param integer $id
	 * @return BannerPlace
	 */
	public function getPlaceByID( $id );
	
	/**
	 * Recupera todos os locais de banners
	 * @return array : BannerPlace
	 */
	public function getPlaces();
	
	/**
	 * Edita ou adiciona um local de banner. Caso for passado um BannerPlace::$idBannerPlace é editado, caso contrário é adicionado
	 * @param BannerPlace $bannerPlace Dados de um local para serem cadastrados
	 */
	public function save( BannerPlace $bannerPlace );
	
	/**
	 * Deleta um local de banner
	 * @param integer $id Id do local
	 */
	public function delete( $id );
	
}