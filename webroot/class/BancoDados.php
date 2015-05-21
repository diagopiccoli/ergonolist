<?php	
class BancoDados
{
	
	protected $con;
	protected $host;
	protected $usuario;
	protected $senha;
	protected $nomeBanco;
			
	public function __construct($host, $usuario, $senha, $nomeBanco)
	{
		$this->host = $host;
		$this->usuario = $usuario;
		$this->senha = $senha;
		$this->nomeBanco = $nomeBanco;
	}

	public function __get($name)
	{
		return $this->$name;
	}
	
	public function __set($name, $value)
	{
		$this->$name = $value;
	}
	
	private function conectarBanco()
	{
		$conectarBanco = mysql_connect($this->__get('host'), $this->__get('usuario'), $this->__get('senha')) or die ('Não foi possível estabelecer uma conexão com o banco de dados.');
		$selecionarBanco = mysql_select_db($this->__get('nomeBanco'), $conectarBanco) or die ('Não foi possível selecionar o banco de dados.');
		$this->__set('con', $conectarBanco);
	}
	
	public function consultarBanco($sqlQuery)
	{
	
		$this->conectarBanco();
	
		if(!empty($sqlQuery)) {
			$sqlConsultarBanco = mysql_query($sqlQuery);
			$numSqlSelectBanco = mysql_num_rows($sqlConsultarBanco);
			
			if($numSqlSelectBanco > 0) {
				//Declarando variáveis de quantidade.
				$qntdCampos = mysql_num_fields($sqlConsultarBanco);
				$qtndLinhas = mysql_num_rows($sqlConsultarBanco);
				$count = 0;
				
				//Recebendo valores.
				while($sqlValoresConsultarBanco = mysql_fetch_object($sqlConsultarBanco)) {
				
					$i = 0;					
					while($i < $qntdCampos) {
						//Atribuindo valores.
						$identificador = mysql_field_name($sqlConsultarBanco, $i);
						$arraySqlConsultarBanco[$count][$identificador] = $sqlValoresConsultarBanco->$identificador;
						$i++;
					}
					$count++;
				}
				
				//Retornando array dos valores.
				return $arraySqlConsultarBanco;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
		
		$this->closeBanco();						
	}
			
	public function inserirBanco($tabela, $campos, $valores, $outros)
	{
		
		$this->conectarBanco();
		
		//Atribuindo variável de acção
		$inserirBanco = 'INSERT INTO '.$tabela.' ('.$campos.') VALUES ('.$valores.') '.$outros.'';
		
		//Armazenar resposta do query
		$sqlInserirBanco = mysql_query("".$inserirBanco."");

		//Verificação de erro/sucesso
		if($sqlInserirBanco) {
			if(mysql_insert_id() != 0) {
				return mysql_insert_id();
			}
			else {
				return true;
			}
		}
		else {
			echo mysql_error();
			return false;
		}
		
		$this->closeBanco();
	}
	
	public function atualizarBanco($tabela, $campos, $onde, $outros)
	{
	
		$this->conectarBanco();
	
		//Atribuindo variável de acção
		$atualizarBanco = 'UPDATE '.$tabela.' SET '.$campos.' WHERE '.$onde.' '.$outros.'';
		
		//Armazenar resposta do query
		$sqlAtualizarBanco = mysql_query("".$atualizarBanco."");
		print_r(mysql_error());
		//Verificação de erro/sucesso
		return $sqlAtualizarBanco;
		
		$this->closeBanco();
	}
	
	public function deletarBanco($tabela, $onde, $outros)
	{
	
		$this->conectarBanco();
	
		//Atribuindo variável de acção
		$deletarBanco = 'DELETE FROM '.$tabela.' WHERE '.$onde.' '.$outros.'';
		
		//Armazenar resposta do query
		$sqlDeletarBanco = mysql_query("".$deletarBanco."");
		
		//Verificação de erro/sucesso
		return $sqlDeletarBanco;
		
		$this->closeBanco();
	}
	
	private function closeBanco()
	{
		
		mysql_close($this->__get('con'));
		
	}
	
}
?>