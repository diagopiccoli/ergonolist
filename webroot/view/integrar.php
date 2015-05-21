<?php
	require('../../config.php');
	$arq = 'arq2.txt';
	$fp = fopen($arq, 'r');
	if($fp) {
		$text =	fread($fp, filesize($arq));
	}
	fclose($fp);
	
	$text = explode(';', $text);
	$text = str_replace('Não aplicável', 'c', $text);
	$text = str_replace('Sim', 'a', $text);
	$text = str_replace('Não', 'b', $text);
	
	echo '<pre>';
	
	for($i=0;$i<count($text);$i++) {
		
		if(trim($text[$i]) != '') {
			$item = trim($text[$i]);
			$item = explode(',', $item);
			$items[] = $item;
		}
		
	}
	
	for($i=0;$i<count($items);$i++) {
		
		for($j=0;$j<count($items[$i]); $j++) {
			
			if(($j % 2) == 0) {
				$arr[$i][$j]['pergunta'] = trim($items[$i][$j]);
			}
			else {
				$arr[$i][$j-1]['resposta'] = trim($items[$i][$j]);				
			}
			
			
		}
		
	}
		
	for($i=0;$i<count($arr); $i++) {
	
		foreach($arr[$i] as $value) {
			
			$criterio = $i+1;
			$pergunta = $value['pergunta'];
			$resposta = $value['resposta'];
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
			
			$db->inserirBanco("resposta", "RSP_CHK_ID, RSP_CRI_ID, RSP_QST_ID, RSP_VLR", "2, $criterio, $pergunta, '$resposta'", "");
		
		}
	
	}
	
	echo '</pre>';
	
?>