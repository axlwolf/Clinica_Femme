<?php
/**
 * Pacote de classes e objetos das models dos usuários
 * @package cms.mvc.user.model
 */


/**
 * Interface para criação de um acesso à dados dos usuários do sistema
 * @author mauricio
 *
 */

interface UserDataAccess {
	
	/**
	 * Recupera os dados de um usuário pelo ID
	 * @param integer $id
	 * @return User
	 */
	public function getUserByID( $id );
	
	/**
	 * Recupera todos os usuários, ou apenas os que estejam nas condições passadas pelo filtro; também podem ser ordenados
	 * @return array
	 */
	public function getUsers();
	
	/**
	 * Edita ou adiciona um usuário. Caso for passado um User::$userId é editado, caso contrário é adicionado
	 * @param User $user Dados de um usuário para serem cadastrados
	 */
	public function save( User $user );
	
	/**
	 * Reupera os dados de um usuário pelo seus dados de acesso ao sistema
	 * @param string $login Login ou E-mail do usuário
	 * @param string $password Senha do usuário
	 * @return User
	 */
	public function getUserByLoginPassword( $login, $password );
	
	/**
	 * Deleta um usuário
	 * @param integer $id Id do usuário
	 */
	public function delete( $id );
	
}