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
class FAQView extends CrudView {

	/**
	 *
	 * @var string
	 */
	protected $contentPage = 'faq/view/templates/default.html';


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

		$this->setResourceTitle( $resourceBundle->getString( 'FAQ_PAGE_TITLE' ) );
		$this->setResourceDescription( $resourceBundle->getString( 'FAQ_PAGE_DESCRIPTION' ) );

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

		$this->setContentPage( 'faq/view/templates/form.html' );
		$this->setFormTitle( $resourceBundle->getString( 'FAQ_FORM_EDIT' ) );

		//Popula os campos do formulário do template
		$this->assign( 'FAQQuestion', $this->record->getFAQQuestion() );
		$this->assign( 'FAQAnswer', $this->record->getFAQAnswer() );
		$this->assign( 'idFAQ', $this->record->getIdFAQ() );
	}

	/**
	 * @see CrudView::setTemplateForCreate
	 */
	public function setTemplateForCreate(){
		$resourceBundle = Application::getInstance()->getBundle();
		$this->setContentPage( 'faq/view/templates/form.html' );
		$this->setFormTitle( $resourceBundle->getString( 'FAQ_FORM_CREATE' ) );
	}

	/**
	 * @see CrudView::setTemplateForDefault
	 * @throws LogicException Quando não haver nenhuma lista de registros à ser mostrada
	 */
	public function setTemplateForDefault(){
		$resourceBundle = Application::getInstance()->getBundle();

		$this->setContentPage( 'faq/view/templates/default.html' );
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
	public function setRecords( $records ){
		$this->records = $records;
		$this->assign( 'dataTable', $records );
	}
}