<?php
/**
 * Classes e objetos utilitários da aplicação
 * @package	cms.util
 */

/**
 * Classe para manipulação de arquivos
 * @author mauricio
 *
 */
class FileHandler {

	/**
	 *
	 * @var array
	 */
	protected $file;

	/**
	 *
	 * @var string
	 */
	protected $dir;

	/**
	 *
	 * @var integer
	 */
	protected $maxSize = null;


	/**
	 *
	 * @param array $file
	 */
	public function __construct( $file ){
		$this->setFile( $file );
	}

	/**
	 * Atribui um arquivo para ser manipulado
	 * @param array $file Arquivo para ser feito manipulado ( $_FILES )
	 */
	public function setFile( $file ){
		$this->file = $file;
	}

	/**
	 * Atribui um diretório para fazer o upload do arquivo
	 * @param string $dir Diretório de upload
	 */
	public function setDirectory( $dir ){
		$this->dir = str_replace( '//', '/', '/'.trim( $dir , '/\\' ) );
	}

	/**
	 * Atribui um tamanho máximo para o arquivo
	 * @param integer $maxSize
	 */
	public function setMaxSize( $maxSize ){
		$this->maxSize = (int) $maxSize;
	}

	/**
	 * Faz o upload do arquivo
	 * @throws LogicException Quando nenhum arquivo for definido para upload
	 * @throws RuntimeException Se não for possível criar a pasta para armazenar o arquivo
	 * @throws RuntimeException Se o tamanho do arquivo for maior que o permitido
	 * @throws RuntimeException Se não for possível fazer o upload do arquivo
	 * @return boolean
	 */
	public function upload(){

		//Verifica se foi definido algum arquivo
		if( !$this->file ){
			throw new LogicException( 'Informe um arquivo para ser feito upload.' );
		}

		//Verifica o diretório, se não existir tenta criar com recursividade
		if( !is_dir( $this->dir ) ){
			if( !mkdir( $this->dir, 0755, true ) ){
				throw new RuntimeException( 'Não foi possível criar a pasta para armazenar o arquivo.' );
			}
		}

		//Verifica se foi definido um tamanho máximo para o arquivo, e então verifica se o arquivo está no padrão
		if( $this->maxSize ){
			if( filesize( $this->file['tmp_name'] ) <= ($this->maxSize * 1024) ){
				$uploadChecked = true;
			}else{
				throw new RuntimeException( 'O tamanho do arquivo é maior do que o esperado. Por favor, insira um arquivo menor que <strong>'. $this->maxSize .'Kbytes.</strong>' );
			}
		}else{
			$uploadChecked = true;
		}

		//Se tudo estiver correto, é feito upload
		if($uploadChecked){
			if( !move_uploaded_file( $this->file['tmp_name'], $this->dir .'/'. self::createFileName( $this->file['name'] ) ) ){
				throw new RuntimeException( 'Não foi possível armazenar o arquivo.' );
			}
		}

		return true;
	}

	/**
	 * Deleta um arquivo ou diretório
	 * @param boolean $deleteFolder Define se é para deletar o diretório ou só o arquivo
	 */
	public function delete( $deleteFolder = false ){
		if( !$deleteFolder ){
			unlink( $this->dir .'/'. $this->file['name'] );
		}else{
			$this->removeDirectory( $this->dir );
		}
		
		return true;
	}

	/**
	 * Remove um diretório e todo seu conteúdo
	 * @param string $dir Diretório a ser apagado
	 */
	private function removeDirectory( $dir ) {
		foreach( glob( $dir . '/*' ) as $file ){
			if( is_dir( $file ) ){
				self::removeDirectory( $file );
			}else{
				unlink( $file );
			}
		}
		rmdir( $dir );
		return true;
	}

	/**
	 * Cria um nome para o arquivo conforme o timestamp atual
	 * @param string $filename Arquivo a ser criado um nome
	 * @return string
	 */
	public static function createFileName( $filename ){
		$fileInfo = pathinfo( $filename );
		$extension = $fileInfo['extension'];
		return md5( $filename.time() ) .'.'. $extension;
	}

}