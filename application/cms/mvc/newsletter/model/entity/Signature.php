<?php
/**
 * Classes e objetos relacionados com a model do mural de recados
 * @package	cms.mvc.guestbook.model
 */

/**
 * Entidade de uma assinatura
 * @author mauricio
 *
 */
final class Signature {

	/**
	 *
	 * @var integer
	 */
	private $idSignature;

	/**
	 *
	 * @var string
	 */
	private $signatureName;

	/**
	 *
	 * @var string
	 */
	private $signatureEmail;

	/**
	 *
	 * @var string
	 */
	private $signatureCod;

	/**
	 *
	 * @var string - 'approved', 'canceled', 'pending'
	 */
	private $signatureStatus;
	
	/**
	 * 
	 * @param integer $id
	 */
	public function setIdSignature($id){
		$this->idSignature = (int) $id;
	}
	
	/**
	 * 
	 * @param string $status - 'approved', 'canceled', 'pending'
	 */
	public function setSignatureStatus($status){
		$this->signatureStatus = $status;
	}
	
	/**
	 * 
	 * @param string $name
	 */
	public function setSignatureName($name){
		$this->signatureName = $name;
	}
	
	/**
	 * 
	 * @param string $email
	 */
	public function setSignatureEmail($email){
		$this->signatureEmail = $email;
	}
	
	/**
	 * 
	 * @param string $cod
	 */
	public function setSignatureCod($cod){
		$this->signatureCod = $cod;
	}

	/**
	 * @return integer
	 */
	public function getIdSignature(){
		return $this->idSignature;
	}
	
	/**
	 * @return string
	 */
	public function getSignatureName(){
		return $this->signatureName;
	}
	
	/**
	 * @return string
	 */
	public function getSignatureEmail(){
		return $this->signatureEmail;
	}
	
	/**
	 * @return string
	 */
	public function getSignatureCod(){
		return $this->signatureCod;
	}
	
	/**
	 * @return string
	 */
	public function getSignatureStatus(){
		return $this->signatureStatus;
	}
	
}
