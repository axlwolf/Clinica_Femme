<?php
/**
 * Classes e objetos relacionados com os controladores de ministérios
 * @package	cms.mvc.ministry.controller
 */

require_once 'cms/mvc/controller/Controller.php';
require_once 'cms/mvc/scrapbook/view/ScrapbookView.php';
require_once 'cms/mvc/scrapbook/model/entity/Scrap.php';
require_once 'cms/mvc/view/success/SuccessView.php';
require_once 'cms/mvc/model/Auth.php';

/**
 * Controlador de ministérios
 * @author	Mauricio Giacomini Girardello
 */
class ScrapbookController extends Controller {

	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {

		if(Auth::getInstance()->isAuth() && $_GET[ 'c' ] == 'scrapbook'){
			return $this->canBeHandleBy( $_SESSION['CMS']['user']['group'] );
		}

		return false;
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {
		//Instancia o bd
		$scrapbookDataAccess = Registry::getInstance()->get( 'dataAccessFactory' )->createScrapbookDataAccess();

		//Gerenciador de pacotes
		$resourceBundle = Application::getInstance()->getBundle();

		//Deleta um registro
		$delete = (int) $_GET['del'];
		if( $delete ){
			$scrapbookDataAccess->delete( $delete );
			//View de sucesso
			$successView = new SuccessView( 'O recado foi deletado com sucesso!' );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();
		}

		// salva uma requisição de criação
		if( $_POST['save'] ){
				
			//Atribui a configuração de um usuário
			$scrap = new Scrap();
			$scrap->setScrapApproved( (bool) $_POST['approved'] );
			$scrap->setScrapDesc( $_POST['desc'] );
			$scrap->setScrapEmail( $_POST['email'] );
			$scrap->setScrapName( $_POST['name'] );
			
			//Se for para editar, é atribuído um i
			$id = (int) $_POST['idScrap'];
			if($id){
				$scrap->setIdScrap( $id );
			}

			//Salva os dados
			$scrapbookDataAccess->save( $scrap );

			//Título da página de sucesso
			if($id){
				$message = "O recado foi editado com sucesso.";
			}else{
				$message = "O recado foi cadastrado com sucesso.";
			}

			//View de sucesso
			$successView = new SuccessView( $message );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();

		}

		//View de usuário
		$view = new ScrapbookView();

		switch($_GET['a']){
			case 'edit':
				$view->setScrap( $scrapbookDataAccess->getByID( (int) $_GET['id'] ) );
				$view->setTemplateForEdit();
				break;
			case 'create':
				$view->setTemplateForCreate();
				break;
			default:
				$view->setScraps( $scrapbookDataAccess->getAll() );
				$view->setTemplateForDefault();
				break;
		}

		$view->show();
	}
}