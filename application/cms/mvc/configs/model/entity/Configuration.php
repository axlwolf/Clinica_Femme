<?php
/**
 * Classes e objetos relacionados com a model dos eventos
 * @package	cms.mvc.event.model
 */

/**
 * Entidade de um evento
 * @author mauricio
 *
 */
final class Configuration {

	/**
	 *
	 * @var integer
	 */
	private $idConfig;

	/**
	 *
	 * @var string
	 */
	private $configTitle;

	/**
	 *
	 * @var string
	 */
	private $configDescription;
	
	/**
	 *
	 * @var string
	 */
	private $configEmail;

	/**
	 *
	 * @var string
	 */
	private $configKeyWords;

	/**
	 *
	 * @var string
	 */
	private $configScriptGA;

	/**
	 *
	 * @var string
	 */
	private $configGAAcc;

	/**
	 *
	 * @var string
	 */
	private $configGAPassword;
	
	/**
	 * 
	 * @var string
	 */
	private $configGAId;

	/**
	 * @param integer $id
	 * @throws UnexpectedValueException Quando o ID informado não é inteiro
	 */
	public function setidConfig( $id ){
		if(is_int( $id )){
			$this->idConfig = (int) $id;
		}else{
			throw new UnexpectedValueException( 'O ID da configuração deve ser um inteiro.' );
		}
	}

	/**
	 *
	 * @param string $title Título do site
	 */
	public function setConfigTitle( $title ){
		$this->configTitle = $title;
	}

	/**
	 * @param string $description Breve descrição do site
	 */
	public function setConfigDescription( $description ){
		$this->configDescription = $description;
	}

	/**
	 *
	 * @param string $keyWords Palavras-chaves para os buscadores
	 */
	public function setConfigKeyWords( $keyWords ){
		$this->configKeyWords = $keyWords;
	}
	
/**
	 *
	 * @param string $email E-mail para envio de e-mails do sistema e do site
	 */
	public function setConfigEmail( $email ){
		$this->configEmail = $email;
	}

	/**
	 *
	 * @param string $script Script do Google Analytics para monitorar os acessos do site
	 */
	public function setConfigScriptGA( $script ){
		$this->configScriptGA = $script;
	}

	/**
	 *
	 * @param string $account Conta do google analytics
	 */
	public function setConfigGAAcc( $account ){
		$this->configGAAcc = $account;
	}

	/**
	 *
	 * @param string $password Senha da acc do google analytics
	 */
	public function setConfigGAPassword( $password ){
		$this->configGAPassword = $password;
	}
	
/**
	 *
	 * @param string $report_id ID do google analytics pra a conta selecionada
	 */
	public function setConfigGAId( $report_id ){
		$this->configGAId = $report_id;
	}

	/**
	 * @return integer
	 */
	public function getidConfig(){
		return $this->idConfig;
	}

	/**
	 * @return string
	 */
	public function getConfigTitle(){
		return $this->configTitle;
	}

	/**
	 * @return string
	 */
	public function getConfigDescription(){
		return $this->configDescription;
	}
	
/**
	 * @return string
	 */
	public function getConfigEmail(){
		return $this->configEmail;
	}

	/**
	 * @return string
	 */
	public function getConfigKeyWords(){
		return $this->configKeyWords;
	}

	/**
	 * @return string
	 */
	public function getConfigScriptGA(){
		return $this->configScriptGA;
	}

	/**
	 * @return string
	 */
	public function getConfigGAAcc(){
		return $this->configGAAcc;
	}

	/**
	 * @return string
	 */
	public function getConfigGAPassword(){
		return $this->configGAPassword;
	}
	
/**
	 * @return string
	 */
	public function getConfigGAId(){
		return $this->configGAId;
	}
	
}