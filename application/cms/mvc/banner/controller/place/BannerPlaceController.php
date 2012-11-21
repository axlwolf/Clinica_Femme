<?php
/**
 * Classes e objetos relacionados com os controladores de usuários
 * @package	cms.mvc.banner.controller
 */

require_once 'cms/mvc/controller/Controller.php';
require_once 'cms/mvc/view/success/SuccessView.php';
require_once 'cms/mvc/banner/view/place/BannerPlaceView.php';
require_once 'cms/mvc/banner/model/entity/BannerPlace.php';
require_once 'cms/mvc/model/Auth.php';

/**
 * Controlador de Locais de banners
 * @author	Mauricio Giacomini Girardello
 */
class BannerPlaceController extends Controller {

	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {
		
		if(Auth::getInstance()->isAuth() && $_GET[ 'c' ] == 'banner-place'){
			return $this->canBeHandleBy( $_SESSION['CMS']['user']['group'] );
		}

		return false;
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {

		//Instancia o bd
		$bannerPlaceDataAccess = Registry::getInstance()->get( 'dataAccessFactory' )->createBannerPlaceDataAccess();

		//Gerenciador de pacotes
		$resourceBundle = Application::getInstance()->getBundle();

		//Deleta um registro
		$delete = (int) $_GET['del'];
		if( $delete ){
			$bannerPlaceDataAccess->delete( $delete );
			//View de sucesso
			$successView = new SuccessView( 'O Local de Banner foi deletado com sucesso!' );
			$successView->setMessage( 'O local e todos seus banners foram excluídos com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();
		}

		// salva uma requisição de criação
		if( $_POST['save'] ){

			//Atribui a configuração de um usuário
			$bannerPlace = new BannerPlace();
			$bannerPlace->setBannerPlaceHeight( (int) $_POST['height'] );
			$bannerPlace->setBannerPlaceWidth( (int) $_POST['width'] );
			$bannerPlace->setBannerPlaceName( $_POST['name'] );

			//Se for para editar, é atribuído um i
			$id = (int) $_POST['idBannerPlace'];
			if($id){
				$bannerPlace->setIdBannerPlace( $id );
			}

			//Salva os dados
			$bannerPlaceDataAccess->save( $bannerPlace );

			//Título da página de sucesso
			if($id){
				$message = "O local de banner foi editado com sucesso.";
			}else{
				$message = "O local de banner foi cadastrado com sucesso.";
			}

			//View de sucesso
			$successView = new SuccessView( $message );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();

		}

		//View de usuário
		$view = new BannerPlaceView();

		switch($_GET['a']){
			case 'edit':
				$view->setBannerPlace( $bannerPlaceDataAccess->getPlaceByID( (int) $_GET['id'] ) );
				$view->setTemplateForEdit();
				break;
			case 'create':
				$view->setTemplateForCreate();
				break;
			default:
				$view->setBannerPlaces( $bannerPlaceDataAccess->getPlaces() );
				$view->setTemplateForDefault();
				break;
		}

		$view->show();

	}
}