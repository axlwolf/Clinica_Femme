<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/view/ApplicationView.php';

/**
 * Implementação da View de mural de recados
 * @author	mauricio
 */
class NewsletterView extends ApplicationView {

	/**
	 * 
	 * @var string
	 */
	protected $formTitle;
	
	/**
	 *
	 * @var string
	 */
	protected $contentPage = 'newsletter/view/templates/default.html';


	/**
	 * @var Signature
	 */
	private $signature;

	/**
	 *
	 * @var array[Signature]
	 */
	private $signatures;


	public function __construct(){
		parent::__construct();

		$resourceBundle = Application::getInstance()->getBundle();

		$this->setResourceTitle( $resourceBundle->getString( 'NEWSLETTER_PAGE_TITLE' ) );
		$this->setResourceDescription( $resourceBundle->getString( 'NEWSLETTER_PAGE_DESCRIPTION' ) );

	}

	/**
	 * @see CrudView::setTemplateForEdit
	 * @throws LogicException Quando não haver nenhum registro para popular o formulário
	 */
	public function setTemplateForEdit(){
		$resourceBundle = Application::getInstance()->getBundle();

		if( !$this->signature ){
			throw new LogicException( 'É necessário informar uma assinatura à ser editada.' );
		}

		$this->setContentPage( 'newsletter/view/templates/form.html' );
		$this->setFormTitle( $resourceBundle->getString( 'NEWSLETTER_FORM_EDIT' ) );

		//Popula os campos do formulário do template
		$this->assign( 'signatureName', $this->signature->getSignatureName() );
		$this->assign( 'signatureEmail', $this->signature->getSignatureEmail() );
		$this->assign( 'signatureCod', $this->signature->getSignatureCod() );
		$this->assign( 'signatureStatus', $this->signature->getSignatureStatus() );
		$this->assign( 'idSignature', $this->signature->getIdSignature() );
	}

	/**
	 * @see CrudView::setTemplateForDefault
	 * @throws LogicException Quando não haver nenhuma lista de registros à ser mostrada
	 */
	public function setTemplateForDefault(){
		$resourceBundle = Application::getInstance()->getBundle();

		$this->setContentPage( 'newsletter/view/templates/default.html' );
	}

	/**
	 * 
	 * @param Signature $signature
	 */
	public function setSignature( Signature $signature ){
		$this->signature = $signature;
	}

	/**
	 *
	 * @param array[Signature] $signatures
	 */
	public function setSignatures( $signatures ){
		$this->signatures = $signatures;
		$this->assign( 'dataTable', $signatures );
	}
	
	/**
	 * Atribui um título ao formulário
	 * @param string $title Título do formulário
	 */
	public function setFormTitle( $title ){
		$this->formTitle = $title;
		$this->assign( 'formTitle', $title );
	}

}