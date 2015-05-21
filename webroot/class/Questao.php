<?php
class Questao
{

	protected $qstId;
	protected $qstCriId;
	protected $qstPrg;
	protected $qstSts;
	
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