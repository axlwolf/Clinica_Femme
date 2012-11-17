<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/view/crud/CrudView.php';

/**
 * Implementação da View de usuário
 * @author	mauricio
 */
class UserView extends CrudView {

	/**
	 *
	 * @var string
	 */
	protected $contentPage = 'user/view/templates/default.html';


	/**
	 * @var User
	 */
	private $user;

	/**
	 *
	 * @var array
	 */
	private $users;

	/**
	 *
	 * @param array $users Lista de usuários para listar como default
	 */
	public function __construct(){
		parent::__construct();

		$resourceBundle = Application::getInstance()->getBundle();

		$this->setResourceTitle( $resourceBundle->getString( 'USERS_PAGE_TITLE' ) );
		$this->setResourceDescription( $resourceBundle->getString( 'USERS_PAGE_DESCRIPTION' ) );
		
	}

	/**
	 * @see CrudView::setTemplateForEdit
	 * @throws LogicException Quando não haver nenhum registro para popular o formulário
	 */
	public function setTemplateForEdit(){
		$resourceBundle = Application::getInstance()->getBundle();

		if(empty($this->user) || is_null($this->user)){
			throw new LogicException( 'É necessário informar um registro à ser editado.' );
		}

		$this->setContentPage( 'user/view/templates/form.html' );
		$this->setFormTitle( $resourceBundle->getString( 'USERS_FORM_EDIT' ) );

		//Popula os campos do formulário do template
		$this->assign( 'userName', $this->user->getUserName() );
		$this->assign( 'idGroup', $this->user->getIdGroup() );
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
	 * @see CrudView::setTemplateForCreate
	 */
	public function setTemplateForCreate(){
		$resourceBundle = Application::getInstance()->getBundle();
		$this->setContentPage( 'user/view/templates/form.html' );
		$this->setFormTitle( $resourceBundle->getString( 'USERS_FORM_CREATE' ) );
	}

	/**
	 * @see CrudView::setTemplateForDefault
	 * @throws LogicException Quando não haver nenhuma lista de registros à ser mostrada
	 */
	public function setTemplateForDefault(){
		$resourceBundle = Application::getInstance()->getBundle();
	
		$this->setContentPage( 'user/view/templates/default.html' );
	}

	/**
	 * Atribui um usuário para a view
	 * @param User $user Usuário
	 */
	public function setUser( User $user ){
		$this->user = $user;
	}

	/**
	 * Atribui uma lista de usuários
	 * @param array $users Usuários para listar
	 */
	public function setUsers( $users ){
		$this->users = $users;
		$this->assign( 'dataTable', $users );
	}

}