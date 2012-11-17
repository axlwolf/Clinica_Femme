<?php
/**
 * Classes e objetos relacionados com os controladores de profile
 * @package	cms.mvc.profile.controller
 */

require_once 'cms/mvc/controller/Controller.php';
require_once 'cms/mvc/profile/view/ProfileView.php';
require_once 'cms/mvc/user/model/entity/User.php';
require_once 'cms/mvc/view/success/SuccessView.php';
require_once 'cms/mvc/model/Auth.php';

/**
 * Controlador de Profile
 * @author	Mauricio Giacomini Girardello
 */
class ProfileController extends Controller {

	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {

		// define a permissão
		$this->permission = parent::PERMISSION_ADMIN | parent::PERMISSION_MODERATOR | parent::PERMISSION_OTHERS;

		if(Auth::getInstance()->isAuth() && $_GET[ 'c' ] == 'profile'){
			return $this->canBeHandleBy( $_SESSION['CMS']['user']['group'] );
		}

		return false;
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {
		//Instancia o bd
		$userDataAccess = Registry::getInstance()->get( 'dataAccessFactory' )->createUserDataAccess();

		//Gerenciador de pacotes
		$resourceBundle = Application::getInstance()->getBundle();

		//Recupera os dados do usuário que está sendo editado
		$userdata = $userDataAccess->getUserByID( (int) $_SESSION['CMS']['user']['id'] );

		// salva uma requisição de criação
		if( $_POST['save'] ){

			//Diretório de upload
			$uploadDir = str_replace('//', '/', '/'.$resourceBundle->getString('USERS_UPLOAD_DIR').'/');
				
			//Atribui a configuração de um usuário
			$user = new User();
			$user->setIdGroup( (int) $_SESSION['CMS']['user']['group'] );
			$user->setUserEmail( $_POST['email'] );
			$user->setUserLogin( $_POST['login'] );
			$user->setUserName( $_POST['name'] );
			if( !empty($_POST['password']) && $_POST['password'] !== null ){
				$user->setUserPassword( $_POST['password'] );
			}
			$user->setUserPhoto( $_FILES['photo']['name'] ? FileHandler::createFileName( $_FILES['photo']['name'] ) :null );
			$user->setIdUser( (int) $_SESSION['CMS']['user']['id'] );
			
			//Salva o nome da foto para deletar caso o usuário tenha cadastrado outra
			$photoToDelete = $userdata->getUserPhoto();

			//Salva os dados
			$userDataAccess->save( $user );
			
			//Salva a foto do usuário
			if( $_FILES['photo']['tmp_name'] ){
				//Se o cliente possuir uma foto, e estiver cadastrando outra, é deletado a antiga
				if(isset($photoToDelete)){
					unlink( $uploadDir . $photoToDelete );
				}

				$image = new ImageHandler();
				$image->carrega( $_FILES['photo']['tmp_name'] );
				$image->redimensiona( 33, 33 );
				$image->grava( $uploadDir . FileHandler::createFileName( $_FILES['photo']['name'] ) );
			}

			//Título da página de sucesso
			$message = "Seu perfil foi modificado com sucesso!";

			//View de sucesso
			$successView = new SuccessView( $message );
			$successView->setMessage( 'Para as alterações serem aplicadas, você precisará entrar novamente no sistema.' );
			$successView->show();

		}

		//View
		$view = new ProfileView();
		$view->setUser( $userdata );
		$view->setTemplateForDefault();
		$view->show();
	}
}