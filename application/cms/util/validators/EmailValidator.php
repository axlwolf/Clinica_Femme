<?php
/**
 * Classes e objetos utilitários da aplicação
 * @package	com.imasters.pro.core
 */

require_once 'cms/util/validators/Validator.php';

/**
 * Implementação de uma validação de e-mail
 * @author	Mauricio Giacomini Girardello
 */
class EmailValidator extends Validator {

	protected static $pattern = "^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+.([a-zA-Z]{2,4})$";

	public static function valid( $value ){
		if (ereg( self::$pattern , $value)){
			return true;
		}else{
			return false;
		}
	}

}