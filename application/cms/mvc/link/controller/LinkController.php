<?php
/**
 * Classes e objetos relacionados com os controladores de ministérios
 * @package	cms.mvc.ministry.controller
 */

require_once 'cms/mvc/controller/Controller.php';
require_once 'cms/mvc/link/view/LinkView.php';
require_once 'cms/mvc/link/model/entity/Link.php';
require_once 'cms/mvc/view/success/SuccessView.php';
require_once 'cms/mvc/model/Auth.php';

/**
 * Controlador de links
 * @author	Mauricio Giacomini Girardello
 */
class LinkController extends Controller {

	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {

		if(Auth::getInstance()->isAuth() && $_GET[ 'c' ] == 'link'){
			return $this->canBeHandleBy( $_SESSION['CMS']['user']['group'] );
		}

		return false;
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {
		//Instancia o bd
		$linkDataAccess = Registry::getInstance()->get( 'dataAccessFactory' )->createScrapbookDataAccess();

		//Gerenciador de pacotes
		$resourceBundle = Application::getInstance()->getBundle();

		//Deleta um registro
		$delete = (int) $_GET['del'];
		if( $delete ){
			$linkDataAccess->delete( $delete );
			//View de sucesso
			$successView = new SuccessView( 'O link foi deletado com sucesso!' );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();
		}

		// salva uma requisição de criação
		if( $_POST['save'] ){
				
			//Atribui a configuração de um usuário
			$link = new Link();
			$link->setLinkUrl( $_POST['url'] );
			$link->setLinkName( $_POST['name'] );
			
			//Se for para editar, é atribuído um i
			$id = (int) $_POST['idLink'];
			if($id){
				$link->setIdLink( $id );
			}

			//Salva os dados
			$linkDataAccess->save( $link );

			//Título da página de sucesso
			if($id){
				$message = "O link foi editado com sucesso.";
			}else{
				$message = "O link foi cadastrado com sucesso.";
			}

			//View de sucesso
			$successView = new SuccessView( $message );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();

		}

		//View de usuário
		$view = new LinkView();

		switch($_GET['a']){
			case 'edit':
				$view->setScrap( $linkDataAccess->getByID( (int) $_GET['id'] ) );
				$view->setTemplateForEdit();
				break;
			case 'create':
				$view->setTemplateForCreate();
				break;
			default:
				$view->setScraps( $linkDataAccess->getAll() );
				$view->setTemplateForDefault();
				break;
		}

		$view->show();
	}
}