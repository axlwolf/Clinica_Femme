<?php
/**
 * Classes e objetos relacionados com a model da galeria de fotos
 * @package	cms.mvc.photo.model
 */

/**
 * Entidade de uma galeria de fotos
 * @author mauricio
 *
 */
class NewsEntity {

	/**
	 *
	 * @var integer
	 */
	private $idNews, $idCategory;

	/**
	 *
	 * @var string
	 */
	private $categoryName;

	/**
	 *
	 * @var string
	 */
	private $newsTitle, $newsResume, $newsText, $newsPhoto, $newsDate;

	public function setIdCategory( $id ){
		$this->idCategory = (int) $id;
	}

	public function getIdCategory(){
		return $this->idCategory;
	}

	public function setIdNews( $id ){
		$this->idNews = (int) $id;
	}

	/**
	 * @return integer
	 */
	public function getIdNews(){
		return $this->idNews;
	}


	public function setNewsTitle( $title ){
		$this->newsTitle = $title;
	}

	/**
	 * @return string
	 */
	public function getNewsTitle(){
		return $this->newsTitle;
	}

	/**
	 *
	 * @param string $place Local que foram tiradas as fotos
	 */
	public function setNewsResume( $resume ){
		$this->newsResume = $resume;
	}

	/**
	 * @return string
	 */
	public function getNewsResume(){
		return $this->newsResume;
	}

	public function setNewsText( $text ){
		$this->newsText = $text;
	}

	/**
	 * @return string
	 */
	public function getNewsText(){
		return $this->newsText;
	}

	public function setNewsDate( $date ){
		$this->newsDate = $date;
	}

	/**
	 * @return string
	 */
	public function getNewsDate(){
		return $this->newsDate;
	}

	public function setNewsPhoto( $photo ){
		$this->newsPhoto = $photo;
	}

	/**
	 * @return string
	 */
	public function getNewsPhoto(){
		return $this->newsPhoto;
	}

	/**
	 * Atribui um nome de categoria
	 * @param string $name Nome da categoria
	 */
	public function setCategoryName( $name ){
		$this->categoryName = $name;
	}

	/**
	 * Retorna o nome da categoria
	 * @return string
	 */
	public function getCategoryName(){
		return $this->categoryName;
	}

}
