<?php
/**
 * Pacote de classes e objetos das models do mural de recados
 * @package cms.mvc.guestbook.model
 */


/**
 * Interface para criação de um acesso à dados do mural de recados
 * @author mauricio
 *
 */

interface NewsletterDataAccess {
	
	/**
	 * Recupera os dados de uma assinatura
	 * @param integer $id
	 * @return Signature
	 */
	public function getByID( $id );
	
	/**
	 * Recupera todas as assinaturas
	 * @return array[Signature]
	 */
	public function getAll();
	
	/**
	 * Confirma a assinatura pelo código enviado no e-mail
	 * @param string $email
	 * @param string $cod
	 * @return boolean
	 */
	public function confirmSignature( $email, $cod );
	
	/**
	 * Remove a assinatura do e-mail
	 * @param string $email
	 * @return boolean
	 */
	public function removeSignature( $email );
	
	/**
	 * Deleta uma assinatura
	 * @param integer $id
	 */
	public function delete( $id );

	/**
	 * @param string $email
	 * @param string $status - 'pending', 'approved', 'canceled'
	 */
	public function changeStatus( $email, $status = 'pending' );
	
}
