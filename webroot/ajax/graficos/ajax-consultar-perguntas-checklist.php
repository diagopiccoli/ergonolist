<?php
	
	require('../../../config.php');
	
	if(!Requisicao::isAjax()) {
	
		$CRI_ID = addslashes($_REQUEST['CRI_ID']);
		$CRI_ID = 1;
		
		$consPerguntas = $db->consultarBanco("SELECT * FROM resposta INNER JOIN questao ON resposta.RSP_QST_ID = questao.QST_ID WHERE resposta.RSP_CRI_ID = $CRI_ID AND resposta.RSP_CHK_ID = 2 GROUP BY resposta.RSP_ID ORDER BY resposta.RSP_CHK_ID");
		if($consPerguntas) {
			
			$i = 0;
			?>	
				<style>
					* {
						padding: 0;
						margin: 0;
						font-family: arial;
					}
					h3 {
						padding: 5px;
						font-size: 30px;
					}
					table {
						width: 100%;
						border-collapse: collapse;
					}
						table > thead > tr > td {
							padding: 5px;
							background: #333;
							font-size: 20px;
							color: #fff;
						}
						table > tbody > tr:nth-child(1) > td {
							padding-top: 15px;
						}
						table > tbody > tr:nth-child(even) {
							background: #ccc;
						}
						table > tbody > tr > td {
							padding: 3px 15px;
							font-size: 15px;
						}
						.tr-final > td {
							background: #333;
							color: #fff;
						}
				</style>
				<h3>Presteza</h3>
				<table>
					<thead>
						<tr>
							<td>Pergunta</td>
							<td>Resposta</td>
						</tr>
					</thead>
					<tbody>
						<?php
							$a = 0;
							$b = 0;
							$c = 0;
							while($i < count($consPerguntas)) {
								$arr[$consPerguntas[$i]['RSP_CHK_ID']][] = array("pergunta" => utf8_encode($consPerguntas[$i]['QST_PRG']), "resposta" => utf8_encode($consPerguntas[$i]['RSP_VLR']));
								
								if(utf8_encode($consPerguntas[$i]['RSP_VLR']) == 'Sim') {
									$a++;
								}
								if(utf8_encode($consPerguntas[$i]['RSP_VLR']) == 'Não') {
									$b++;
								}
								if(utf8_encode($consPerguntas[$i]['RSP_VLR']) == 'Não aplicável') {
									$c++;
								}	
									
								?>
									<tr>
										<td><?=utf8_encode($consPerguntas[$i]['QST_PRG'])?></td>
										<td><?=utf8_encode($consPerguntas[$i]['RSP_VLR'])?></td>
									</tr>
								<?php
								
								$i++;
							}
						?>
						<tr class="tr-final">
							<td>Sim</td>
							<td><?=$a?></td>
						</tr>
						<tr class="tr-final">
							<td>Não</td>
							<td><?=$b?></td>
						</tr>
						<tr class="tr-final">
							<td>Não aplicável</td>
							<td><?=$c?></td>
						</tr>
					</tbody>
				</table>
				<div id="div-grafico" class="div-grafico"></div>
				<script type="text/javascript">
					$(document).ready(function() {
						gerarGrafico('div-grafico', '<?=$a?>', '<?=$b?>', '<?=$c?>', 'ColumnChart');
					});
				</script>
			<?php			
			
		}
		else {
			$arr[0]['status'] = false;
		}	
		//echo json_encode(array($arr));	
	}

?>