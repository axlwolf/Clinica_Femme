<?php
/**
 * Classes e objetos utilitários da aplicação
 * @package	com.imasters.pro.core
 */

require_once 'cms/util/validators/Validator.php';

/**
 * Implementação de uma validação de dat
 * @author	Mauricio Giacomini Girardello
 */
class DateValidator extends Validator {

	protected static $pattern = "^([0-9]{4})+-([0-9]{2})+-([0-9]{2})$";

	public static function valid( $value ){
		if (ereg( self::$pattern , $value)){
			return true;
		}else{
			return false;
		}
	}

}