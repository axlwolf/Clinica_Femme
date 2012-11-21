<?php
/**
 * Classes e objetos relacionados com os controladores de lojas virtuais
 * @package	cms.mvc.photo.controller
 */

require_once 'cms/mvc/controller/Controller.php';
require_once 'cms/mvc/view/success/SuccessView.php';
require_once 'cms/mvc/news/view/news/NewsView.php';
require_once 'cms/mvc/news/model/entity/NewsEntity.php';
require_once 'cms/util/date/DateFormat.php';
require_once 'cms/util/date/DateType.php';
require_once 'cms/mvc/model/Auth.php';


/**
 * Controlador de Notícia de fotos
 * @author	Mauricio Giacomini Girardello
 */
class NewsController extends Controller {


	/**
	 *
	 * @var string
	 */
	private $uploadDirPath;

	/**
	 *
	 * @var string
	 */
	private $uploadDirURL;


	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {

		if(Auth::getInstance()->isAuth() && $_GET[ 'c' ] == 'news'){
			return $this->canBeHandleBy( $_SESSION['CMS']['user']['group'] );
		}

		return false;
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {
		//Instancia o bd
		$newsDataAccess = Registry::getInstance()->get( 'dataAccessFactory' )->createNewsDataAccess();
		$categoryDataAccess = Registry::getInstance()->get( 'dataAccessFactory' )->createNewsCategoryDataAccess();

		//Gerenciador de pacotes
		$resourceBundle = Application::getInstance()->getBundle();

		// atribui os diretórios de upload
		$this->uploadDirPath = str_replace( '//', '/', '/'.trim($resourceBundle->getString('NEWS_UPLOAD_DIR') , '/\\'));
		$this->uploadDirURL = trim($resourceBundle->getString('NEWS_UPLOAD_URL'), '/\\');

		//Deleta um registro
		$delete = (int) $_GET['del'];

		if( $delete ){
			$newsDataAccess->delete( $delete );
			if( $this->removeDirectory( $this->uploadDirPath .'/'. $delete ) ){
				//View de sucesso
				$successView = new SuccessView( 'A Notícia foi deletada com sucesso!' );
				$successView->setMessage( 'A notícia e todas suas fotos foram excluídas. Para voltar ao ínicio do módulo clique no botão abaixo.' );
				$successView->show();
			}else{
				throw new RuntimeException( 'Não foi possível excluir as fotos da notícia.' );
			}
		}

		// salva uma requisição de criação
		if( $_POST['save'] || $_POST['upload-images'] ){
			
			$date = new DateFormat( substr($_POST['date'], 0, 9) );
			
			//Atribui a configuração de um usuário
			$news = new NewsEntity();
			$news->setIdCategory( (int) $_POST['idCategory'] );
			$news->setNewsDate( $date->format() );
			$news->setNewsText( $_POST['text'] );
			$news->setNewsResume( $_POST['resume'] );
			$news->setNewsTitle( $_POST['title'] );
			

			//Se for para editar, é atribuído um i
			$id = (int) $_POST['idNews'];
			if($id){
				$news->setIdNews( $id );
			}

			//Salva os dados
			$newsDataAccess->save( $news );

			//Diretório de upload
			$uploadDir = $this->uploadDirPath . '/' . $news->getIdNews();

			if( !is_dir( $uploadDir ) ){
				mkdir( $uploadDir, 0777);
			}

			if( !isset( $_POST['upload-images'] ) ){
				//Título da página de sucesso
				if($id){
					$message = "A Notícia foi editada com sucesso.";
				}else{
					$message = "A Notícia foi cadastrada com sucesso.";
				}

				//View de sucesso
				$successView = new SuccessView( $message );
				$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
				$successView->show();
			}else{
				$_GET['a'] = 'upload_images';
				$_GET['id'] = $news->getIdNews();
			}

		}

		//View de usuário
		$view = new NewsView();

		switch($_GET['a']){
			case 'edit':
				$view->setNew( $newsDataAccess->getByID( (int) $_GET['id'] ) );
				$view->setCategories( $categoryDataAccess->getCategories() );
				$view->setTemplateForEdit();
				break;
			case 'create':
				$view->setCategories( $categoryDataAccess->getCategories() );
				$view->setTemplateForCreate();
				break;
			case 'upload_images':

				//Recupera os dados de um produto
				$news = $newsDataAccess->getByID( (int) $_GET['id'] );

				//Deleta uma foto do produto
				if( $_GET['delPhoto'] ){
					$dir = $this->uploadDirPath . '/' . $news->getIdNews();
						
					//Verifica se a imagem existe e então a exclui
					if( file_exists( $dir .'/thumb/'.$_GET['delPhoto'] ) ){
						if( !unlink( $dir .'/thumb/'.$_GET['delPhoto'] ) || !unlink( $dir .'/big/'.$_GET['delPhoto'] )){
							throw new RuntimeException( 'Não foi possível excluir esta foto.' );
						}
					}
				}

				$view->setNew( $news );
				$view->setTemplateForImages();
				break;
			default:
				$view->setNews( $newsDataAccess->getAll() );
				$view->setTemplateForDefault();
				break;
		}

		$view->show();
	}

	/**
	 * Remove um diretório e todo seu conteúdo
	 * @param string $dir Diretório a ser apagado
	 */
	private function removeDirectory( $dir ) {
		foreach( glob( $dir . '/*' ) as $file ){
			if( is_dir( $file ) ){
				self::removeDirectory( $file );
			}else{
				unlink( $file );
			}
		}
		rmdir( $dir );
		return true;
	}

}
