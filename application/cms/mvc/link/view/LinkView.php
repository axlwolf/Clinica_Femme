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
class LinkView extends CrudView {

	/**
	 *
	 * @var string
	 */
	protected $contentPage = 'link/view/templates/default.html';


	/**
	 * @var Entity
	 */
	private $record;

	/**
	 *
	 * @var array[Entity]
	 */
	private $records;


	public function __construct(){
		parent::__construct();

		$resourceBundle = Application::getInstance()->getBundle();

		$this->setResourceTitle( $resourceBundle->getString( 'LINK_PAGE_TITLE' ) );
		$this->setResourceDescription( $resourceBundle->getString( 'LINK_PAGE_DESCRIPTION' ) );

	}

	/**
	 * @see CrudView::setTemplateForEdit
	 * @throws LogicException Quando não haver nenhum registro para popular o formulário
	 */
	public function setTemplateForEdit(){
		$resourceBundle = Application::getInstance()->getBundle();

		if( !$this->record ){
			throw new LogicException( 'É necessário informar um registro à ser editado.' );
		}

		$this->setContentPage( 'link/view/templates/form.html' );
		$this->setFormTitle( $resourceBundle->getString( 'LINK_FORM_EDIT' ) );

		//Popula os campos do formulário do template
		$this->assign( 'linkName', $this->record->getLinkName() );
		$this->assign( 'linkUrl', $this->record->getLinkUrl() );
		$this->assign( 'idLink', $this->record->getIdLink() );
	}

	/**
	 * @see CrudView::setTemplateForCreate
	 */
	public function setTemplateForCreate(){
		$resourceBundle = Application::getInstance()->getBundle();
		$this->setContentPage( 'link/view/templates/form.html' );
		$this->setFormTitle( $resourceBundle->getString( 'LINK_FORM_CREATE' ) );
	}

	/**
	 * @see CrudView::setTemplateForDefault
	 * @throws LogicException Quando não haver nenhuma lista de registros à ser mostrada
	 */
	public function setTemplateForDefault(){
		$resourceBundle = Application::getInstance()->getBundle();

		$this->setContentPage( 'link/view/templates/default.html' );
	}

	/**
	 * 
	 * @param Entity $scrap
	 */
	public function setRecord( $record ){
		$this->record = $record;
	}

	/**
	 *
	 * @param array[Entity] $records
	 */
	public function setScraps( $records ){
		$this->records = $records;
		$this->assign( 'dataTable', $records );
	}
}