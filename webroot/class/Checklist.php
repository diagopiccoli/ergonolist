<?php
class Checklist
{
	
	public static function newChecklist($nome, $url)
	{
		$_SESSION['url_checklist'] = $url;
	}
	
	public static function isChecklist()
	{
		$retorno = false;
		if(trim($_SESSION['url_checklist']) != '') {
			$retorno = true;
		}
		return $retorno;
	}

}
?>