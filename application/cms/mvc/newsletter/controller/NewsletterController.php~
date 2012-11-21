<?php
/**
 * Classes e objetos relacionados com os controladores de ministérios
 * @package	cms.mvc.ministry.controller
 */

require_once 'cms/mvc/controller/Controller.php';
require_once 'cms/mvc/newsletter/view/NewsletterView.php';
require_once 'cms/mvc/newsletter/model/entity/Signature.php';
require_once 'cms/mvc/view/success/SuccessView.php';
require_once 'cms/mvc/model/Auth.php';

/**
 * Controlador de newsletter
 * @author	Mauricio Giacomini Girardello
 */
class NewsletterController extends Controller {

	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {

		// Para confirmar ou remover uma assinatura não é preciso estar logado, pois o usuário final do site o terá de fazer.
		if( $_GET[ 'c' ] == 'newsletter' && ( $_GET['action'] == 'confirmSignature' || $_GET['action'] == 'removeSignature' && ( !$_GET['del'] && !$_POST['save'] ) ) ){
			return true;
		}
		
		// define a permissão
		$this->permission = parent::PERMISSION_ADMIN | parent::PERMISSION_MODERATOR;

		if(Auth::getInstance()->isAuth() && $_GET[ 'c' ] == 'newsletter'){
			return $this->canBeHandleBy( $_SESSION['CMS']['user']['group'] );
		}

		return false;
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {
		//Instancia o bd
		$newsletterDataAccess = Registry::getInstance()->get( 'dataAccessFactory' )->createNewsletterDataAccess();

		//Gerenciador de pacotes
		$resourceBundle = Application::getInstance()->getBundle();

		//Deleta um registro
		$delete = (int) $_GET['del'];
		if( $delete ){
			$newsletterDataAccess->delete( $delete );
			//View de sucesso
			$successView = new SuccessView( 'A assinatura foi deletado com sucesso!' );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();
		}

		// salva uma requisição de criação
		if( $_POST['save'] ){
				
			//Atribui a configuração de um recado
			/*$signature = new Signature();
			$signature->setSignatureStatus( $_POST['status'] );
			$signature->setIdSignature( (int) $_POST['idSignature'] );*/

			//Salva os dados
			$newsletterDataAccess->changeStatus( $_POST['email'], $_POST['status'] );

			//View de sucesso
			$successView = new SuccessView( "A assinatura foi editada com sucesso." );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();

		}

		//View de usuário
		$view = new NewsletterView();
		
		if(isset($_GET['action']) && !empty($_GET['action'])){
			if( $_GET['action'] != 'confirmSignature' ){
				if( $newsletterDataAccess->confirmSignature( $_GET['email'], $_GET['cod'] ) ){
					echo 'Sua assinatura de newsletter foi confirmada com sucesso.';
					exit;
				}
			}
		
			if( $_GET['action'] != 'removeSignature' ){
				if( $newsletterDataAccess->removeSignature( $_GET['email'] ) ){
					echo 'Sua assinatura de newsletter foi removida com sucesso. A partir desse momento você não receberá mais notificações deste site.';
					exit;
				}
			}
		}
				
		switch($_GET['a']){
			case 'edit':
				$view->setSignature( $newsletterDataAccess->getByID( (int) $_GET['id'] ) );
				$view->setTemplateForEdit();
				break;
			default:
				$view->setSignatures( $newsletterDataAccess->getAll() );
				$view->setTemplateForDefault();
				break;
		}

		$view->show();
	}
}
