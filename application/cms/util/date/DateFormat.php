<?php
/**
 * Classes e objetos utilitários da aplicação
 * @package	cms.core
 */

/**
 * Implementação de um formatador de datas.
 * @author	mauricio
 */
class DateFormat {
	
	/**
	 * @var string
	 */
	private $date;
	
	/**
	 * 
	 * @param string $date Data a ser formatada
	 */
	public function __construct( $date ){
		$this->date = $date;
	}
	
	/**
	 * Formata uma data
	 * @param string $inputType Formato de entrada da data
	 * @param string $outputType Formato de saída da data
	 * @return string
	 */
	public function format( $inputType = DateType::DATE_PT, $outputType = DateType::DATE_MYSQL ){
		//return date( $type, strtotime( $this->date ) );
		$date = DateTime::createFromFormat( $inputType, $this->date );
		return $date->format( $outputType );
	}
	
	/**
	 * Atribui a data para ser trabalhada
	 * @param string $date
	 */
	public function setDate( $date ){
		$this->date = $date;
	}

}