<?php
/**
 * Classes e objetos relacionados com a Model da aplicação
 * @package	cms.mvc.model
 */

/**
 * Interface para definição de uma fábrica abstrata para
 * criação das Model da aplicação.
 * @author	Mauricio Giacomini Girardello
 */
abstract class AbstractDataAccessFactory {

	/**
	 * Cria uma instância da Model de Usuários
	 * @return UserDataAccess
	 */
	public abstract function createUserDataAccess();

	/**
	 * Cria uma instância da Model de Grupos de Usuários
	 * @return GroupDataAccess
	 */
	public abstract function createGroupDataAccess();
	
	/**
	 * Cria uma instância da Model de configurações
	 * @return ConfigDataAccess
	 */
	public abstract function createConfigsDataAccess();

	/**
	 * @return NewsletterDataAccess
	 */
	public abstract function createNewsletterDataAccess();

	/**
	 * @return NewsDataAccess
	 */
	public abstract function createNewsDataAccess();

	/**
	 * @return NewsCategoryDataAccess
	 */
	public abstract function createNewsCategoryDataAccess();

/**
	 * Cria uma instância da Model de Banners
	 * @return BannerDataAccess
	 */
	public abstract function createBannerDataAccess();

	/**
	 * Cria uma instância da Model de Locais de Banners
	 * @return BannerPlaceDataAccess
	 */
	public abstract function createBannerPlaceDataAccess();

	/**
	 * @return FAQDataAccess
	 */
	public abstract function createFAQDataAccess();

	/**
	 * @return ScrapbookDataAccess
	 */
	public abstract function createScrapbookDataAccess();
	
	/**
	 * @return LinkDataAccess
	 */
	public abstract function createLinkDataAccess();
		
}
