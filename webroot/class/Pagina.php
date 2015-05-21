<?php
class Pagina
{
	
	public static function setPagina($pagina)
	{
		$_SESSION['page'] = base64_encode($pagina);		
	}
	
	public static function getpagina()
	{
		return $_SESSION['page'];
	}
	
	public static function paginaAtual($pagina)
	{
		if(Pagina::getPagina() == base64_encode($pagina)) {
			return 'active';
		}
	}

}
?>