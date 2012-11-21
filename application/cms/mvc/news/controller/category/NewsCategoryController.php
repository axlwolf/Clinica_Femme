<?php
/**
 * Classes e objetos relacionados com os controladores de usuários
 * @package	cms.mvc.user.controller
 */

require_once 'cms/mvc/controller/Controller.php';
require_once 'cms/mvc/view/success/SuccessView.php';
require_once 'cms/mvc/news/view/category/NewsCategoryView.php';
require_once 'cms/mvc/news/model/entity/NewsCategory.php';
require_once 'cms/mvc/model/Auth.php';

/**
 * Controlador de Categorias
 * @author	Mauricio Giacomini Girardello
 */
class NewsCategoryController extends Controller {

	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {
		
		if(Auth::getInstance()->isAuth() && $_GET[ 'c' ] == 'news-category'){
			return $this->canBeHandleBy( $_SESSION['CMS']['user']['group'] );
		}

		return false;
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {
		
		//Instancia o bd
		$categoryDataAccess = Registry::getInstance()->get( 'dataAccessFactory' )->createNewsCategoryDataAccess();

		//Gerenciador de pacotes
		$resourceBundle = Application::getInstance()->getBundle();
		
		//Deleta um registro
		$delete = (int) $_GET['del'];
		if( $delete ){
			$categoryDataAccess->delete( $delete );
			//View de sucesso
			$successView = new SuccessView( 'A categoria foi deletada com sucesso!' );
			$successView->setMessage( 'A categoria foi deletada e todas as suas respectivas galerias também. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();
		}

		// salva uma requisição de criação
		if( $_POST['save'] ){
				
			//Atribui a configuração
			$category = new NewsCategory();
			$category->setCategoryName( $_POST['name'] );
			
			//Se for para editar, é atribuído um i
			$id = (int) $_POST['idCategory'];
			if($id){
				$category->setIdCategory( $id );
			}
				
			//Salva os dados
			$categoryDataAccess->save( $category );

			//Título da página de sucesso
			if($id){
				$message = "A categoria foi editada com sucesso.";
			}else{
				$message = "A categoria foi cadastrado com sucesso.";
			}

			//View de sucesso
			$successView = new SuccessView( $message );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();

		}

		//View de usuário
		$view = new NewsCategoryView();

		switch($_GET['a']){
			case 'edit':
				$view->setCategory( $categoryDataAccess->getCategoryByID( (int) $_GET['id'] ) );
				$view->setTemplateForEdit();
				break;
			case 'create':
				$view->setTemplateForCreate();
				break;
			default:
				$view->setCategories( $categoryDataAccess->getCategories() );
				$view->setTemplateForDefault();
				break;
		}

		$view->show();
		
	}
}
