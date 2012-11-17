<?php
/**
 * Classes e objetos relacionados com os controladores de usuários
 * @package	cms.mvc.user.controller
 */

require_once 'cms/mvc/controller/Controller.php';
require_once 'cms/mvc/user/view/UserView.php';
require_once 'cms/mvc/user/model/entity/User.php';
require_once 'cms/mvc/view/success/SuccessView.php';
require_once 'cms/mvc/model/Auth.php';
require_once 'cms/util/ImageHandler.php';

/**
 * Controlador de Users
 * @author	Mauricio Giacomini Girardello
 */
class UserController extends Controller {

	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {

		if(Auth::getInstance()->isAuth() && $_GET[ 'c' ] == 'user'){
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

		//Deleta um registro
		$delete = (int) $_GET['del'];
		if( $delete ){
			$userDataAccess->delete( $delete );
			//View de sucesso
			$successView = new SuccessView( 'O Usuário foi deletado com sucesso!' );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();
		}

		// salva uma requisição de criação
		if( $_POST['save'] ){

			//Diretório de upload
			$uploadDir = str_replace('//', '/', '/'.$resourceBundle->getString('USERS_UPLOAD_DIR').'/');
				
			//Atribui a configuração de um usuário
			$user = new User();
			$user->setIdGroup( (int) $_POST['group'] );
			$user->setUserEmail( $_POST['email'] );
			$user->setUserLogin( $_POST['login'] );
			$user->setUserName( $_POST['name'] );
			if( !empty($_POST['password']) && $_POST['password'] !== null ){
				$user->setUserPassword( $_POST['password'] );
			}
			$user->setUserPhoto( $_FILES['photo']['name'] ? FileHandler::createFileName( $_FILES['photo']['name'] ) :null );
			//Se for para editar, é atribuído um i
			$id = (int) $_POST['idUser'];
			if($id){
				$user->setIdUser( $id );
				// busca o usuário e salva o nome da foto para deletar caso o usuário tenha cadastrado outra
				$userdata = $userDataAccess->getUserByID( $id );
				$photoToDelete = $userdata->getUserPhoto();
			}

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
				$image->redimensiona( 33, 33, 'crop' );
				$image->grava( $uploadDir . FileHandler::createFileName( $_FILES['photo']['name'] ) );
			}
				
			//Título da página de sucesso
			if($id){
				$message = "O usuário foi editado com sucesso.";
			}else{
				$message = "O usuário foi cadastrado com sucesso.";
			}

			//View de sucesso
			$successView = new SuccessView( $message );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();

		}

		//View de usuário
		$view = new UserView();

		switch($_GET['a']){
			case 'edit':
				$view->setUser( $userDataAccess->getUserByID( (int) $_GET['id'] ) );
				$view->setTemplateForEdit();
				break;
			case 'create':
				$view->setTemplateForCreate();
				break;
			default:
				$view->setUsers( $userDataAccess->getUsers() );
				$view->setTemplateForDefault();
				break;
		}

		$view->show();
	}
}