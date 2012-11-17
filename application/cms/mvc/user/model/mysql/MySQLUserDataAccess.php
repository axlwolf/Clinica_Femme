<?php
/**
 * Pacote de classes e objetos das models dos usuários
 * @package cms.mvc.user.model
 */

require_once 'cms/mvc/user/model/UserDataAccess.php';
require_once 'cms/mvc/user/model/entity/User.php';

/**
 * Acesso de dados de usuários à um banco MySQL
 * @author mauricio
 *
 */
class MySQLUserDataAccess implements UserDataAccess {

	/**
	 * @see UserDataAccess::getUserByID
	 * @param integer $id
	 * @return User
	 */
	public function getUserByID( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT  `idUser` , `u`.`idGroup` ,  `userName` ,  `userEmail` ,  `userLogin` ,  `userPassword` ,  `userPhoto` , `groupName`
							FROM  `cms_users` AS  `u` 
							INNER JOIN `cms_groups` AS `g` ON g.idGroup = u.idGroup
							WHERE  `u`.`idUser` = :id;' );
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'User' );
		$stm->execute();

		$user = $stm->fetch();

		$stm->closeCursor();

		if ( $user instanceof User ) {
			return $user;
		} else {
			throw new RuntimeException( 'Nenhum usuário encontrado com o ID fornecido.' );
		}
	}

	/**
	 * @see UserDataAccess::getUsers
	 * @return array
	 */
	public function getUsers(){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT  `idUser` , `u`.`idGroup` ,  `userName` ,  `userEmail` ,  `userLogin` ,  `userPassword` ,  `userPhoto` , `groupName`
							FROM  `cms_users` AS  `u` 
							INNER JOIN `cms_groups` AS `g` ON g.idGroup = u.idGroup');
		$stm->setFetchMode( PDO::FETCH_CLASS , 'User' );
		$stm->execute();

		return $stm->fetchAll();
	}

	/**
	 * Edita ou adiciona um usuário. Caso for passado um User::$userId é editado, caso contrário é adicionado
	 * @param User $user Dados de um usuário para serem cadastrados
	 * @throws RuntimeException Se o usuário existir
	 */
	public function save( User $user ){
		$pdo = Registry::getInstance()->get( 'pdo' );

		// Verifica se todos os campos estão preenchidos
		if(!$user->getUserEmail()){
			throw new RuntimeException( 'É necessário informar um e-mail para o usuário.' );
		}

		if(!$user->getUserLogin()){
			throw new RuntimeException( 'É necessário informar um login para o usuário.' );
		}

		if(!$user->getUserName()){
			throw new RuntimeException( 'É necessário informar um nome para o usuário.' );
		}

		//Só é necessário informar uma senha caso esteja cadastrando
		if( !$user->getUserPassword() && !$user->getIdUser() ){
			throw new RuntimeException( 'É necessário informar uma senha para o usuário.' );
		}

		// Verifica se o usuário existe
		if( $this->existsUser($user) ){
			throw new RuntimeException( 'Este usuário já existe.' );
		}else{ // faz uma verificação se é para editar ou adicionar
			if( !( $user->getIdUser() ) ){ // adiciona
				$stm = $pdo->prepare( 'INSERT INTO `cms_users`(`idGroup`, `userName`, `userEmail`, `userLogin`, `userPassword`)
										VALUES (:group, :name,:email,:login,:password);' );
				$stm->bindParam( ':group' , $user->getIdGroup(), PDO::PARAM_INT );
				$stm->bindParam( ':name' , $user->getUserName(), PDO::PARAM_STR );
				$stm->bindParam( ':email' , $user->getUserEmail(), PDO::PARAM_STR );
				$stm->bindParam( ':login' , $user->getUserLogin(), PDO::PARAM_STR );
				$stm->bindParam( ':password' , $user->getUserPassword(), PDO::PARAM_STR );
				$stm->execute();
				//Atribui um id para o usuário cadastrado para inserir uma imagem
				$user->setIdUser( $pdo->lastInsertId() );
			}else{
				if($user->getUserPassword()){
					$stm = $pdo->prepare( 'UPDATE `cms_users` SET `idGroup`=:group,`userName`=:name,`userEmail`=:email,`userLogin`=:login,`userPassword`=:password
										WHERE `idUser` = :id ' );
					$stm->bindParam( ':group' , $user->getIdGroup(), PDO::PARAM_INT );
					$stm->bindParam( ':name' , $user->getUserName(), PDO::PARAM_STR );
					$stm->bindParam( ':email' , $user->getUserEmail(), PDO::PARAM_STR );
					$stm->bindParam( ':login' , $user->getUserLogin(), PDO::PARAM_STR );
					$stm->bindParam( ':password' , $user->getUserPassword(), PDO::PARAM_STR );
					$stm->bindParam( ':id' , $user->getIdUser(), PDO::PARAM_INT );
				}else{
					$stm = $pdo->prepare( 'UPDATE `cms_users` SET `idGroup`=:group,`userName`=:name,`userEmail`=:email,`userLogin`=:login
										WHERE `idUser` = :id ' );
					$stm->bindParam( ':group' , $user->getIdGroup(), PDO::PARAM_INT );
					$stm->bindParam( ':name' , $user->getUserName(), PDO::PARAM_STR );
					$stm->bindParam( ':email' , $user->getUserEmail(), PDO::PARAM_STR );
					$stm->bindParam( ':login' , $user->getUserLogin(), PDO::PARAM_STR );
					$stm->bindParam( ':id' , $user->getIdUser(), PDO::PARAM_INT );
				}
				$stm->execute();
			}
		}

		//Verifica se foi inserido alguma imagem
		if( $user->getUserPhoto() ){
			$stm = $pdo->prepare( 'UPDATE `cms_users` SET `userPhoto`=:photo
										WHERE `idUser` = :id ' );
			$stm->bindParam( ':photo' , $user->getUserPhoto(), PDO::PARAM_STR );
			$stm->bindParam( ':id' , $user->getIdUser(), PDO::PARAM_INT );
			$stm->execute();
		}

	}

	private function existsUser( User $user ){
		$pdo = Registry::getInstance()->get( 'pdo' );

		// verifica a existencia de um usuario para adicionar
		if( !$user->getIdUser() ){
			$stm = $pdo->prepare( 'SELECT * FROM `cms_users` as `u`
									WHERE `u`.`userEmail` = :email OR
									`u`.`userLogin` = :login ' );
		}else{ // verifica a existencia de um usuario para editar
			$stm = $pdo->prepare( 'SELECT * FROM `cms_users` as `u`
									WHERE (`u`.`userEmail` = :email OR
									`u`.`userLogin` = :login)
									AND `u`.`idUser` <> :id' );
			$stm->bindParam( ':id' , $user->getIdUser(), PDO::PARAM_INT );
		}

		$stm->bindParam( ':login' , $user->getUserLogin(), PDO::PARAM_STR );
		$stm->bindParam( ':email' , $user->getUserEmail(), PDO::PARAM_STR );
		$stm->execute();

		if(count($stm->fetchAll())){
			return true;
		}
	}

	/**
	 * Reupera os dados de um usuário pelo seus dados de acesso ao sistema
	 * @see UserDataAccess::getUserByLoginPassword
	 * @param string $login Login ou E-mail do usuário
	 * @param string $password Senha do usuário
	 * @return User
	 */
	public function getUserByLoginPassword( $login, $password ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT * FROM `cms_users` AS `u` WHERE `u`.`userPassword` = :password AND ( `u`.`userLogin` = :login OR `u`.`userEmail` = :login ) ;' );
		$stm->bindParam( ':login' , $login, PDO::PARAM_STR );
		$stm->bindParam( ':password' , $password, PDO::PARAM_STR );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'User' );
		$stm->execute();

		$user = $stm->fetch();

		$stm->closeCursor();

		if ( $user instanceof User ) {
			return $user;
		}
		
		return false;
	}

	/**
	 * Deleta um usuário
	 * @param int $id ID do usuário a ser deletado
	 * @see UserDataAccess::delete
	 */
	public function delete( $id ){
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'DELETE FROM `cms_users` WHERE `idUser` = :id' );
		$stm->bindParam( ':id' , $id, PDO::PARAM_INT );
		$stm->execute();
	}

}