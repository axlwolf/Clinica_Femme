<?php
/**
 * Classes e objetos relacionados com a model dos grupos de usuários
 * @package	cms.mvc.group.model
 */

/**
 * Entidade de um grupo de usuário
 * @author mauricio
 *
 */
final class Group {

	/**
	 *
	 * @var integer
	 */
	private $idGroup;

	/**
	 *
	 * @var string
	 */
	private $groupName;

	/**
	 *
	 * @var bit
	 */
	private $groupPermission;

	/**
	 * Atribui um ID para um grupo
	 * @param integer $id
	 * @throws UnexpectedValueException Quando o ID informado não é inteiro
	 */
	public function setIdGroup( $id ){
		if(is_int( $id )){
			$this->idGroup = (int) $id;
		}else{
			throw new UnexpectedValueException( 'O ID do grupo deve ser um inteiro.' );
		}
	}


	/**
	 * Retorna o id do grupo
	 * @return integer
	 */
	public function getIdGroup(){
		return $this->idGroup;
	}

	/**
	 * Atribui um nome ao grupo
	 * @param string $name Nome do grupo
	 */
	public function setGroupName( $name ){
		$this->groupName = $name;
	}

	/**
	 * Retorna o nome do grupo
	 * @return string
	 */
	public function getGroupName(){
		return $this->groupName;
	}
	
	/**
	 * Atribui uma permissão
	 * @param integer $permission Permissão do grupo
	 */
	public function setGroupPermission( $permission ){
		$this->groupPermission = $permission;
	}

	/**
	 * Retorna a permissão do grupo
	 * @return integer
	 */
	public function getGroupPermission(){
		return $this->groupPermission;
	}

}