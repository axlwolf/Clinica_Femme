<?php
/**
 * Classes e objetos utilitários da aplicação
 * @package	com.imasters.pro.core
 */

require_once 'cms/util/validators/Validator.php';

/**
 * Implementação de uma validação de nome de arquivo
 * @author	Mauricio Giacomini Girardello
 */
class FileValidator extends Validator {

	public static function valid( $value, $fileExtensions = 'pdf|txt|doc|csv|jpg|swf|png|wma|mp3' ){
		$pattern = "/^[a-zA-Z0-9-_\.]+\.(".$fileExtensions.")$/";
		if (preg_match($pattern, $value)){
			return true;
		}else{
			return false;
		}
	}

}