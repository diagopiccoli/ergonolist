<?php

	require('config.php');
	
	$arq_txt = 'perguntas.txt';
	$arq = fopen($arq_txt, 'r');
	
	if($arq) {
		$txt = fread($arq, filesize($arq_txt));
	}
	
	$arr = explode(']', $txt);
	
	
	for($i = 0; $i < count($arr); $i++) {
		
		if(trim($arr[$i]) != '') {
			$arrInd = explode(',', $arr[$i]);
			
			for($j = 0; $j < count($arrInd); $j++) {	
				
				if(($j % 2) == 0) {
					$arrIndTrim[$i][$j]['pergunta'] = trim($arrInd[$j]);
					$arrIndTrim[$i][$j]['resposta'] = trim($arrInd[$j+1]);
					
					$pergunta = $arrIndTrim[$i][$j]['pergunta'];
					$resposta = $arrIndTrim[$i][$j]['resposta'];
					
					$cri = $i + 1;
					
					if($pergunta > 76 && $pergunta < 166) {
						$pergunta++;
					}
					if($pergunta >= 166) {
						$pergunta = $pergunta + 2;
					}
					
					
					if($resposta == 'a') {
						$resposta = 'Sim';
					}
					else if($resposta == 'b') {
						$resposta = 'Não';
					}
					else {
						$resposta = 'Não aplicável';
					}
					
					$resposta = utf8_decode($resposta);
					
					$db->inserirBanco("resposta",
									  "RSP_CHK_ID, RSP_CRI_ID, RSP_QST_ID, RSP_VLR",
									  "2, $cri, $pergunta, '$resposta'",
									  "");
					
					
				}
				
			}

			//$arrIndTrim[] = $arrInd;
		}
	}
	
	echo '<pre>';
	
	//print_r($arrIndTrim);
	
	echo '</pre>';
	
?>