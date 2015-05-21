<?php
class Criterio
{

	protected $criId;
	protected $criNom;
	protected $criDsc;
	protected $criCon;
	protected $criOrd;
	protected $criSts;
	
	public function __get($name)
	{
		return $this->$name;
	}
	
	public function __set($name, $value)
	{
		$this->$name = $value;
	}

	public static function consultarCriteriosSelect($db)
	{
		$consCategorias = $db->consultarBanco("SELECT * FROM criterio");
		if($consCategorias) {
			for($i=0;$i<count($consCategorias);$i++) {
				?>
					<option value="<?=$consCategorias[$i]['CRI_ID']?>"><?=utf8_encode($consCategorias[$i]['CRI_NOM'])?></option>
				<?php
			}
			?>
				<option value="all">Comparação total (Sem opção de perguntas)</option>
			<?php
		}
	}

}
?>