<?php
/**
 * Classes e objetos relacionados com os controladores de lojas virtuais
 * @package	cms.mvc.photo.controller
 */

require_once 'cms/mvc/controller/Controller.php';
require_once 'cms/mvc/view/success/SuccessView.php';
require_once 'cms/mvc/banner/view/banner/BannerView.php';
require_once 'cms/mvc/banner/model/entity/Banner.php';
require_once 'cms/util/date/DateFormat.php';
require_once 'cms/util/date/DateType.php';
require_once 'cms/util/FileHandler.php';
require_once 'cms/mvc/model/Auth.php';


/**
 * Controlador de banners
 * @author	Mauricio Giacomini Girardello
 */
class BannerController extends Controller {


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

		if(Auth::getInstance()->isAuth() && $_GET[ 'c' ] == 'banner'){
			return $this->canBeHandleBy( $_SESSION['CMS']['user']['group'] );
		}

		return false;
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {
		//Instancia o bd
		$bannerDataAccess = Registry::getInstance()->get( 'dataAccessFactory' )->createBannerDataAccess();
		$bannerPlaceDataAccess = Registry::getInstance()->get( 'dataAccessFactory' )->createBannerPlaceDataAccess();

		//Gerenciador de pacotes
		$resourceBundle = Application::getInstance()->getBundle();

		//Diretório de upload
		$uploadDir = str_replace('//', '/', '/'.$resourceBundle->getString('BANNERS_UPLOAD_DIR').'/');

		//Deleta um registro
		$delete = (int) $_GET['del'];
		if( $delete ){
			//Deleta o arquivo do banner
			$file = new FileHandler();
			$file->setDirectory( $uploadDir );
			$file->setFile( array( 'name' => $bannerDataAccess->getBannerByID( $delete )->getBannerFile() ) );
			$file->delete();

			//Deleta do banco de dados
			$bannerDataAccess->delete( $delete );
			
			//View de sucesso
			$successView = new SuccessView( 'O Banner foi deletado com sucesso!' );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();
		}

		// salva uma requisição de criação
		if( $_POST['save'] ){

			// trata a data para inserção
			$datein = new DateFormat( $_POST['dateIn'] );
			$dateout = new DateFormat( $_POST['dateOut'] );
			
			//Atribui a configuração de um banner
			$banner = new Banner();
			$banner->setBannerDateIn( $datein->format( DateType::DATETIME_PT, DateType::DATETIME_MYSQL ) );
			$banner->setBannerDateOut( $dateout->format( DateType::DATETIME_PT, DateType::DATETIME_MYSQL ) );
			$banner->setBannerDescription( $_POST['description'] );
			$banner->setBannerTitle( $_POST['title'] );
			$banner->setBannerLink( $_POST['link'] );
			$banner->setIdBannerPlace( (int) $_POST['idBannerPlace'] );
			
			$bannerFileName = FileHandler::createFileName( $_FILES['bannerFile']['name'] );
			
			//Se for para editar, é atribuído um i
			$id = (int) $_POST['idBanner'];
			if( $id ){
				$banner->setIdBanner( $id );
				// busca o banner e salva o nome do arquivo
				$bannerdata = $bannerDataAccess->getBannerByID( $id );
				$fileToDelete = $bannerdata->getBannerFile();
				
				if( !$_FILES['bannerFile']['name'] ){
					$bannerFileName = $fileToDelete;
				}
								
			}

			$banner->setBannerFile( $bannerFileName );
			
			//Salva os dados
			$bannerDataAccess->save( $banner );

			//Salva o arquivo do banner
			if( $_FILES['bannerFile']['tmp_name'] ){
				//Se o banner possuir um arquivo, e estiver cadastrando outro, é deletado o antigo
				if(isset($fileToDelete)){
					$file = new FileHandler();
					$file->setDirectory( $uploadDir );
					$file->setFile( array( 'name' => $fileToDelete ) );
					$file->delete();
				}

				$file = new FileHandler();
				$file->setFile( $_FILES['bannerFile'] );
				$file->setDirectory( $uploadDir );
				$file->upload();

			}

			//Título da página de sucesso
			if($id){
				$message = "O banner foi editado com sucesso.";
			}else{
				$message = "O banner foi cadastrado com sucesso.";
			}

			//View de sucesso
			$successView = new SuccessView( $message );
			$successView->setMessage( 'A operação foi concluída com sucesso. Para voltar ao ínicio do módulo clique no botão abaixo.' );
			$successView->show();

		}

		//View de usuário
		$view = new BannerView();

		switch($_GET['a']){
			case 'edit':
				$view->setBanner( $bannerDataAccess->getBannerByID( (int) $_GET['id'] ) );
				$view->setPlaces( $bannerPlaceDataAccess->getPlaces() );
				$view->setTemplateForEdit();
				break;
			case 'create':
				$view->setPlaces( $bannerPlaceDataAccess->getPlaces() );
				$view->setTemplateForCreate();
				break;
			default:
				$view->setBanners( $bannerDataAccess->getBanners() );
				$view->setTemplateForDefault();
				break;
		}

		$view->show();
	}

}