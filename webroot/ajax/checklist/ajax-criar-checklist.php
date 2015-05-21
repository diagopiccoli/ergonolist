<?php
	
	require('../../../config.php');
	
	if(Requisicao::isAjax()) {
		
		$urlChecklist = addslashes($_REQUEST['CHK_URL']);
		
		if(trim($urlChecklist) != '') {
			
			$inserirChecklist = $db->inserirBanco("checklist", "CHK_URL", "'$urlChecklist'", "");
			if($inserirChecklist) {
				$arr = array("status" => true, "acao" => "reloadPage();");
			}
			else {
				$arr = array("status" => false, "msg" => "Erro ao inserir checklist.", "acao" => "");
			}
			
		}
		else {
			$arr = array("status" => false, "msg" => "Preencha a url para criar um checklist.", "acao" => "");
		}
		
		echo json_encode(array($arr));
		
	}
	
?>