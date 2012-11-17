<?php
/*
 * jQuery File Upload Plugin PHP Example 5.7
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

error_reporting(E_ALL | E_STRICT);

require_once '../../../application/config.php';
require_once 'cms/Application.php';
require_once 'cms/util/UploadHandler.php';

//Carrega os pacotes de externacionalização de strings,
//para recuperar os diretórios e dimensões definidas
$resourceBundle = Application::getInstance()->getBundle();

//Verifica o recurso que será utilizado para armazenar os arquivos
switch ($_REQUEST['c']){
	//Produto de uma loja virtual
	case 'virtual-store-product':
		//Path e URL de upload
		$uploadDirPath = str_replace( '//', '/', '/'.trim($resourceBundle->getString('VIRTUAL_STORE_UPLOAD_DIR') , '/\\')).'/'. (int) $_REQUEST['id'];
		$uploadDirURL = trim($resourceBundle->getString('VIRTUAL_STORE_UPLOAD_URL'), '/\\').'/'. (int) $_REQUEST['id'];
		
		//Cria os diretórios caso não existam
		if(!is_dir($uploadDirPath.'/big/'))
			mkdir( $uploadDirPath.'/big/', 0777, true );
		if(!is_dir($uploadDirPath.'/thumb/'))
			mkdir( $uploadDirPath.'/thumb/', 0777, true );
		if(!is_dir($uploadDirPath.'/files/'))
			mkdir( $uploadDirPath.'/files/', 0777, true );
		
		//Instancia o manipulador de upload
		$upload_handler = new UploadHandler(array(
			'upload_dir' => $uploadDirPath.'/files/',
            'upload_url' => $uploadDirURL.'/files/',
			'image_versions' => array( //Tipo de imagens que vão ser criadas
                'thumbnail' => array(
                    'upload_dir' => $uploadDirPath.'/thumb/',
                    'upload_url' => $uploadDirURL.'/thumb/',
                    'max_width' => $resourceBundle->getInt('VIRTUAL_STORE_UPLOAD_SIZES_THUMB_WIDTH'),
                    'max_height' => $resourceBundle->getInt('VIRTUAL_STORE_UPLOAD_SIZES_THUMB_HEIGHT')
                ),
                'larger' => array(
                    'upload_dir' => $uploadDirPath.'/big/',
                    'upload_url' => $uploadDirURL.'/big/',
                    'max_width' => $resourceBundle->getInt('VIRTUAL_STORE_UPLOAD_SIZES_BIG_WIDTH'),
                    'max_height' => $resourceBundle->getInt('VIRTUAL_STORE_UPLOAD_SIZES_BIG_HEIGHT')
                )
            )
		));
		break;
	//Recurso de uma galeria de foto
	case 'photo-gallery':
		//Path e URL de upload
		$uploadDirPath = str_replace( '//', '/', '/'.trim($resourceBundle->getString('PHOTOS_UPLOAD_DIR') , '/\\')).'/'. (int) $_REQUEST['id'];
		$uploadDirURL = trim($resourceBundle->getString('PHOTOS_UPLOAD_URL'), '/\\').'/'. (int) $_REQUEST['id'];
		
		//Cria os diretórios caso não existam
		if(!is_dir($uploadDirPath.'/big/'))
			mkdir( $uploadDirPath.'/big/', 0777, true );
		if(!is_dir($uploadDirPath.'/thumb/'))
			mkdir( $uploadDirPath.'/thumb/', 0777, true );
		if(!is_dir($uploadDirPath.'/files/'))
			mkdir( $uploadDirPath.'/files/', 0777, true );
		
		//Instancia o manipulador de upload
		$upload_handler = new UploadHandler(array(
			'upload_dir' => $uploadDirPath.'/files/',
            'upload_url' => $uploadDirURL.'/files/',
			'image_versions' => array( //Tipo de imagens que vão ser criadas
                'thumbnail' => array(
                    'upload_dir' => $uploadDirPath.'/thumb/',
                    'upload_url' => $uploadDirURL.'/thumb/',
                    'max_width' => $resourceBundle->getInt('PHOTOS_UPLOAD_SIZES_THUMB_WIDTH'),
                    'max_height' => $resourceBundle->getInt('PHOTOS_UPLOAD_SIZES_THUMB_HEIGHT')
                ),
                'larger' => array(
                    'upload_dir' => $uploadDirPath.'/big/',
                    'upload_url' => $uploadDirURL.'/big/',
                    'max_width' => $resourceBundle->getInt('PHOTOS_UPLOAD_SIZES_BIG_WIDTH'),
                    'max_height' => $resourceBundle->getInt('PHOTOS_UPLOAD_SIZES_BIG_HEIGHT')
                )
            )
		));
		break;
	default:
		$upload_handler = new UploadHandler();
		break;
}

header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Content-Disposition: inline; filename="files.json"');
header('X-Content-Type-Options: nosniff');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

//Recupera o tipo de requisição HTTP para manipular os arquivos
switch ($_SERVER['REQUEST_METHOD']) {
    case 'OPTIONS':
        break;
    case 'HEAD':
    case 'GET':
        $upload_handler->get();
        break;
    case 'POST':
        if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
            $upload_handler->delete();
        } else {
            $upload_handler->post();
        }
        break;
    case 'DELETE':
        $upload_handler->delete();
        break;
    default:
        header('HTTP/1.1 405 Method Not Allowed');
}