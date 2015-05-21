<?php
	
	require('../../../config.php');
	
	if(Requisicao::isAjax()) {
	
		$CRI_ID = addslashes($_REQUEST['CRI_ID']);
		
		if($CRI_ID != 'all') {
			$WHERE = "WHERE CRI_ID = '$CRI_ID'";
			$WHERE_UNION = "AND RSP_CRI_ID = $CRI_ID";
		}
		
		$consCriterio = $db->consultarBanco("SELECT criterio.CRI_NOM, criterio.CRI_CON FROM criterio $WHERE");
		if($consCriterio) {
			
			$CRI_NOM = $CRI_ID != 'all' ? utf8_encode($consCriterio[0]['CRI_NOM']) : 'Comparação total';
			$CRI_CON = $CRI_ID != 'all' ? utf8_encode($consCriterio[0]['CRI_CON']) : '';
			
			$arr[] = array("criterio" => "$CRI_NOM", "definicao" => "$CRI_CON", "status" => true);
			
			$consChecklist = $db->consultarBanco("SELECT CHK_ID, CHK_URL FROM checklist WHERE CHK_STS = 'on'");
			if($consChecklist) {
				
				$i = 0;
				while($i < count($consChecklist)) {
					
					$CHK_ID = $consChecklist[$i]['CHK_ID'];
					$CHK_URL = $consChecklist[$i]['CHK_URL'];
					
					$consResposta = $db->consultarBanco("SELECT RSP_VLR, count(*) FROM resposta WHERE RSP_VLR = 'Sim' AND RSP_CHK_ID = $CHK_ID $WHERE_UNION AND RSP_STS = 'on'
												  		 UNION ALL
												  		 SELECT RSP_VLR, count(*) FROM resposta WHERE RSP_VLR = '".utf8_decode('Não')."' AND RSP_CHK_ID = $CHK_ID $WHERE_UNION AND RSP_STS = 'on'
												  		 UNION ALL
												  		 SELECT RSP_VLR, count(*) FROM resposta WHERE RSP_VLR = '".utf8_decode('Não aplicável')."' AND RSP_CHK_ID = $CHK_ID $WHERE_UNION AND RSP_STS = 'on'");
											
					$sim = $consResposta[0]['count(*)'];
					$nao = $consResposta[1]['count(*)'];
					$naoAplicavel = $consResposta[2]['count(*)'];
					
					$arr[] = array("url" => "$CHK_URL", "a" => "$sim", "b" => "$nao", "c" => "$naoAplicavel"); 
					
					$i++;
				}
				
			}
			else {
				$arr[0]['status'] = false;
			}
            
		}
		else {
			$arr[0]['status'] = false;
		}
		
		echo json_encode($arr);
		
	}

?>