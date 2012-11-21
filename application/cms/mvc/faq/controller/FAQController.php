<?php
/**
 * Classes e objetos relacionados com os controladores de ministérios
 * @package	cms.mvc.ministry.controller
 */

require_once 'cms/mvc/controller/Controller.php';
require_once 'cms/mvc/faq/view/FAQView.php';
require_once 'cms/mvc/faq/model/entity/FAQ.php';
require_once 'cms/mvc/view/success/SuccessView.php';
require_once 'cms/mvc/model/Auth.php';

/**
 * Controlador de links
 * @author	Mauricio Giacomini Girardello
 */
class FAQController extends Controller {

	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {

		if(Auth::getInstance()->isAuth() && $_GET[ 'c' ] == 'faq'){
			return $this->canBeHandleBy( $_SESSION['CMS']['user']['group'] );
		}

		return false;
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {
		//Instancia o bd
		$FAQDataAccess = Registry::getInstance()->get( 'dataAccessFactory' )->createFAQDataAccess();

		//Gerenciador de pacotes
		$resourceBundle = Application::getInstance()->getBundle();

		//Deleta um registro
		$delete = (int) $_GET['del'];
		if( $delete ){
			$FAQDataAccess->delete( $delete );
			//View de sucesso
			$successView = new SuccessView( 'A pergunta foi deletada com sucesso!' );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();
		}

		// salva uma requisição de criação
		if( $_POST['save'] ){
				
			//Atribui a configuração de um usuário
			$FAQ = new FAQ();
			$FAQ->setFAQQuestion( $_POST['question'] );
			$FAQ->setFAQAnswer( $_POST['answer'] );
			
			//Se for para editar, é atribuído um i
			$id = (int) $_POST['idFAQ'];
			if($id){
				$FAQ->setIdFAQ( $id );
			}

			//Salva os dados
			$FAQDataAccess->save( $FAQ );

			//Título da página de sucesso
			if($id){
				$message = "A pergunta foi editada com sucesso.";
			}else{
				$message = "A pergunta foi cadastrada com sucesso.";
			}

			//View de sucesso
			$successView = new SuccessView( $message );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();

		}

		//View de usuário
		$view = new FAQView();

		switch($_GET['a']){
			case 'edit':
				$view->setRecord( $FAQDataAccess->getByID( (int) $_GET['id'] ) );
				$view->setTemplateForEdit();
				break;
			case 'create':
				$view->setTemplateForCreate();
				break;
			default:
				$view->setRecords( $FAQDataAccess->getAll() );
				$view->setTemplateForDefault();
				break;
		}

		$view->show();
	}
}