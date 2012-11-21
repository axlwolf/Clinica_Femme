<?php
/**
 * Classes e objetos relacionados com a Model da aplicação
 * @package	cms.mvc.model.mysql
 */

require_once 'cms/mvc/model/AbstractDataAccessFactory.php';
require_once 'cms/mvc/user/model/mysql/MySQLUserDataAccess.php';
require_once 'cms/mvc/group/model/mysql/MySQLGroupDataAccess.php';
require_once 'cms/mvc/configs/model/mysql/MySQLConfigsDataAccess.php';


// módulo de banners
require_once 'cms/mvc/banner/model/mysql/MySQLBannerDataAccess.php';
require_once 'cms/mvc/banner/model/mysql/MySQLBannerPlaceDataAccess.php';

// módulo de newsletter
require_once 'cms/mvc/newsletter/model/mysql/MySQLNewsletterDataAccess.php';

// módulo de mural de recados
require_once 'cms/mvc/scrapbook/model/mysql/MySQLScrapbookDataAccess.php';

// módulo de links
require_once 'cms/mvc/link/model/mysql/MySQLLinkDataAccess.php';

// módulo de faq
require_once 'cms/mvc/faq/model/mysql/MySQLFAQDataAccess.php';

// módulo de notícias
require_once 'cms/mvc/news/model/mysql/MySQLNewsDataAccess.php';
require_once 'cms/mvc/news/model/mysql/MySQLNewsCategoryDataAccess.php';

/**
 * Fábrica de objetos Model que utilizam acesso a dados em
 * bancos MySQL
 * @author	mauricio
 */
class MySQLDataAccessFactory extends AbstractDataAccessFactory {


	public function __construct() {
		$registry = Registry::getInstance();

		if ( !$registry->has( 'pdo' ) ) {
			$resourceBundle = Application::getInstance()->getBundle();

			$registry->set( 'pdo',
			new PDO(
			$resourceBundle->getString( 'MYSQL_DSN' ),
			$resourceBundle->getString( 'MYSQL_USER' ),
			$resourceBundle->getString( 'MYSQL_PSWD' )
			)
			);
		}
	}


	/**
	 * @return UserDataAccess
	 * @see AbstractDataAccessFactory::createUserDataAccess
	 */
	public function createUserDataAccess(){
		return new MySQLUserDataAccess();
	}

	/**
	 * @return GroupDataAccess
	 * @see AbstractDataAccessFactory::createGroupDataAccess
	 */
	public function createGroupDataAccess(){
		return new MySQLGroupDataAccess();
	}

	/**
	 * @see AbstractDataAccessFactory::createBannerDataAccess
	 * @return BannerDataAccess
	 */
	public function createBannerDataAccess(){
		return new MySQLBannerDataAccess();
	}

	/**
	 * @see AbstractDataAccessFactory::createBannerPlaceDataAccess
	 * @return BannerPlaceDataAccess
	 */
	public function createBannerPlaceDataAccess(){
		return new MySQLBannerPlaceDataAccess();
	}

	/**
	 * @see AbstractDataAccessFactory::createConfigDataAccess
	 * @return PhotoCategoryDataAccess
	 */
	public function createConfigsDataAccess(){
		return new MySQLConfigsDataAccess();
	}

	/**
	 * @see AbstractDataAccessFactory::createNewsletterDataAccess
	 * @return NewsletterDataAccess
	 */
	public function createNewsletterDataAccess(){
		return new MySQLNewsletterDataAccess();
	}

	/**
	 * @see AbstractDataAccessFactory::createScrapbookDataAccess
	 * @return NewsletterDataAccess
	 */
	public function createScrapbookDataAccess(){
		return new MySQLScrapbookDataAccess();
	}

	/**
	 * @see AbstractDataAccessFactory::createLinkDataAccess
	 * @return LinkDataAccess
	 */
	public function createLinkDataAccess(){
		return new MySQLLinkDataAccess();
	}

	/**
	 * @see AbstractDataAccessFactory::createFAQDataAccess
	 * @return FAQDataAccess
	 */
	public function createFAQDataAccess(){
		return new MySQLFAQDataAccess();
	}

/**
	 * @return NewsDataAccess
	 */
	public function createNewsDataAccess(){
		return new MySQLNewsDataAccess();
	}

	/**
	 * @return NewsCategoryDataAccess
	 */
	public function createNewsCategoryDataAccess(){
		return new MySQLNewsCategoryDataAccess();
	}
}
