<?php
class Requisicao {
	
	public static function isAjax()
	{
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')) {
			return true;
		}
		else {
			return false;
		}
	}
	
	public static function getErrorAjax()
	{
		return 'ERRO: Arquivo apenas para acesso interno.';		
	}
	
}
?>