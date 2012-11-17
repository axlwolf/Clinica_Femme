<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/view/ApplicationView.php';

/**
 * Implementação da View de configurações
 * @author	mauricio
 */
class ProfileView extends ApplicationView {

	/**
	 *
	 * @var string
	 */
	protected $contentPage = 'profile/view/templates/default.html';


	/**
	 * @var User
	 */
	private $user;


	public function __construct(){
		parent::__construct();

		$resourceBundle = Application::getInstance()->getBundle();

		$this->setResourceTitle( $resourceBundle->getString( 'PROFILE_PAGE_TITLE' ) );
		$this->setResourceDescription( $resourceBundle->getString( 'PROFILE_PAGE_DESCRIPTION' ) );

	}

	/**
	 * @see CrudView::setTemplateForDefault
	 * @throws LogicException Quando não haver nenhum registro para popular o formulário
	 */
	public function setTemplateForDefault(){
		$resourceBundle = Application::getInstance()->getBundle();

		if( !$this->user ){
			throw new LogicException( 'É necessário informar o perfil de um usuário.' );
		}

		$this->setContentPage( 'profile/view/templates/default.html' );

		//Popula os campos do formulário do template
		$this->assign( 'userName', $this->user->getUserName() );
		$this->assign( 'groupName', $this->user->getGroupName() );
		$this->assign( 'idUser', $this->user->getIdUser() );
		$this->assign( 'userLogin', $this->user->getUserLogin() );
		$this->assign( 'userEmail', $this->user->getUserEmail() );

		//Verifica se a imagem do usuário existe
		//Diretório
		$dirUrl = trim($resourceBundle->getString('USERS_UPLOAD_URL'), '/\\');
		$dirPath = trim($resourceBundle->getString('USERS_UPLOAD_DIR'), '/\\');
		$photo = $dirUrl .'/'. $this->user->getUserPhoto();
		$photoPath = '/'. $dirPath .'/'. $this->user->getUserPhoto();
		if( file_exists( $photoPath ) ){
			$this->assign( 'userPhoto', $photo );
		}else{
			$this->assign( 'userPhoto', false );
		}
	}

	/**
	 *
	 * @param User $user
	 */
	public function setUser( User $user ){
		$this->user = $user;
	}

}