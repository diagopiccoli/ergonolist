<?php
class Resposta
{
	
	protected $rspQstId;
	protected $rspVlr;
	protected $rspCom;
	protected $rspSts;
	
	public function __get($name)
	{
		return $this->$name;
	}
	
	public function __set($name, $value)
	{
		$this->$name = $value;
	}

}
?>