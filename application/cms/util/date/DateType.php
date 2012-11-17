<?php
/**
 * Classes e objetos utilitários da aplicação
 * @package	cms.core
 */

/**
 * Interface de tipos de datas
 * @author	mauricio
 */
interface DateType {
	
	const DATE_MYSQL = 'Y-m-d';
	const DATE_PT = 'd/m/Y';
	const DATETIME_MYSQL = 'Y-m-d H:i';
	const DATETIME_PT = 'd/m/Y H:i';
	
}