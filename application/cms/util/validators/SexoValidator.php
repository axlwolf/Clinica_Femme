<?php
/**
 * Classes e objetos utilitários da aplicação
 * @package	com.imasters.pro.core
 */

require_once 'cms/util/validators/Validator.php';

/**
 * Implementação de uma validação de sex
 * @author	Mauricio Giacomini Girardello
 */
class SexoValidator extends Validator {

	protected static $pattern = "^[MF]$";

	public static function valid( $value ){
		if (ereg( self::$pattern , $value)){
			return true;
		}else{
			return false;
		}
	}

}