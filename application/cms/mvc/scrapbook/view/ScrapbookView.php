<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	cms.mvc.view
 */

require_once 'cms/mvc/view/crud/CrudView.php';

/**
 * Implementação da View de recados
 * @author	mauricio
 */
class ScrapbookView extends CrudView {

	/**
	 *
	 * @var string
	 */
	protected $contentPage = 'scrapbook/view/templates/default.html';


	/**
	 * @var Scrap
	 */
	private $scrap;

	/**
	 *
	 * @var array[Scrap]
	 */
	private $scraps;


	public function __construct(){
		parent::__construct();

		$resourceBundle = Application::getInstance()->getBundle();

		$this->setResourceTitle( $resourceBundle->getString( 'SCRAPBOOK_PAGE_TITLE' ) );
		$this->setResourceDescription( $resourceBundle->getString( 'SCRAPBOOK_PAGE_DESCRIPTION' ) );

	}

	/**
	 * @see CrudView::setTemplateForEdit
	 * @throws LogicException Quando não haver nenhum registro para popular o formulário
	 */
	public function setTemplateForEdit(){
		$resourceBundle = Application::getInstance()->getBundle();

		if( !$this->scrap ){
			throw new LogicException( 'É necessário informar um recado à ser editado.' );
		}

		$this->setContentPage( 'scrapbook/view/templates/form.html' );
		$this->setFormTitle( $resourceBundle->getString( 'SCRAPBOOK_FORM_EDIT' ) );

		//Popula os campos do formulário do template
		$this->assign( 'scrapName', $this->scrap->getScrapName() );
		$this->assign( 'scrapEmail', $this->scrap->getScrapEmail() );
		$this->assign( 'scrapDesc', $this->scrap->getScrapDesc() );
		$this->assign( 'scrapApproved', $this->scrap->getScrapApproved() );
		$this->assign( 'idScrap', $this->scrap->getIdScrap() );
	}

	/**
	 * @see CrudView::setTemplateForCreate
	 */
	public function setTemplateForCreate(){
		$resourceBundle = Application::getInstance()->getBundle();
		$this->setContentPage( 'scrapbook/view/templates/form.html' );
		$this->setFormTitle( $resourceBundle->getString( 'SCRAPBOOK_FORM_CREATE' ) );
	}

	/**
	 * @see CrudView::setTemplateForDefault
	 * @throws LogicException Quando não haver nenhuma lista de registros à ser mostrada
	 */
	public function setTemplateForDefault(){
		$resourceBundle = Application::getInstance()->getBundle();

		$this->setContentPage( 'scrapbook/view/templates/default.html' );
	}

	/**
	 * 
	 * @param Scrap $scrap
	 */
	public function setScrap( Scrap $scrap ){
		$this->scrap = $scrap;
	}

	/**
	 *
	 * @param array[Scrap] $scraps
	 */
	public function setScraps( $scraps ){
		$this->scraps = $scraps;
		$this->assign( 'dataTable', $scraps );
	}
}