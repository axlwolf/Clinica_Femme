<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/view/View.php';

/**
 * Base para implementação das Views da aplicação
 * @author	mauricio
 */
abstract class ApplicationView extends View {

	/**
	 *
	 * @var string
	 */
	protected $page = 'view/templates/application.html';

	/**
	 *
	 * @var string
	 */
	protected $contentPage = 'view/templates/default.tpl';

	/**
	 *
	 * @var string
	 */
	public $resourceTitle;

	/**
	 *
	 * @var string
	 */
	public $resourceDescription;


	public function __construct(){
		parent::__construct();

		$resourceBundle = Application::getInstance()->getBundle();

		//Atribui o titulo da página
		$this->setTitle( $resourceBundle->getString( 'MAIN_TITLE' ) );

		//Atribui a página interna do sistema que o usuário quer acessar
		$this->assign( 'contentPage', $this->contentPage );

		$this->setResourceTitle( 'Sem título' );
		$this->setResourceDescription( '' );

		//Atribui o nome do usuário que está logado
		$this->assign( 'userLoggedName', $_SESSION['CMS']['user']['name'] );


		//Monta o menu da aplicação
		$i = 0;
		foreach ( $resourceBundle->getResource( 'MENU' ) as $resourceItem ) {
			$menu[$i]['name'] = $resourceItem->getValue();
			$menu[$i]['url'] = $resourceItem->getIterator()->current()->getValue();
			$i++;
		}
		$this->assign( 'sideMenu', $menu );
		
		//Verifica se a imagem do usuário existe
		$dirUrl = trim($resourceBundle->getString('USERS_UPLOAD_URL'), '/\\');
		$dirPath = trim($resourceBundle->getString('USERS_UPLOAD_DIR'), '/\\');
		$img = $_SESSION['CMS']['user']['img'];
		if( file_exists( '/'. $dirPath .'/'. $img ) ){
			$this->assign( '__profilePhoto', $dirUrl .'/'. $img );
		}else{
			$this->assign( '__profilePhoto', $dirUrl .'/'. $resourceBundle->getString('PROFILE_IMAGE_DEFAULT') );
		}
		
	}

	/**
	 * Atribui uma página ao conteúdo da aplicação
	 * @param string $page Página de conteúdo para ser carregada
	 * @return this Retorna uma própria referência da classe ApplicationView
	 */
	public function setContentPage( $page ){
		$this->contentPage = $page;
		$this->assign( 'contentPage', $this->contentPage );

		return $this;
	}

	/**
	 * Retorna a página de conteúdo carregada
	 * @return string
	 */
	public function getContentPage(){
		return $this->contentPage;
	}

	/**
	 * Atribui um titulo ao recurso que está sendo acessado(usuários, notícias,...)
	 * @param string $title Título do recurso
	 */
	public function setResourceTitle( $title ){
		$this->resourceTitle = $title;
		$this->assign( 'resourceTitle', $this->resourceTitle );

		return $this;
	}

	/**
	 * Retorna o titulo do recurso
	 * @return string
	 */
	public function getResourceTitle(){
		return $this->resourceTitle;
	}

	/**
	 * Atribui uma descrição ao recurso que está sendo acessado(usuários, notícias,...)
	 * @param string $description Descrição do recurso
	 */
	public function setResourceDescription( $description ){
		$this->resourceDescription = $description;
		$this->assign( 'resourceDescription', $this->resourceDescription );

		return $this;
	}

	/**
	 * Retorna a descrição do recurso
	 * @return string
	 */
	public function getResourceDescription(){
		return $this->resourceDescription;
	}

}