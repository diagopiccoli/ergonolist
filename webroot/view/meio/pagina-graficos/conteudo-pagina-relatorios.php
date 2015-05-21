<?php
	
	//require('../../../config.php');
	
	if(!Requisicao::isAjax()) {
	
		$CRI_ID = addslashes($_REQUEST['CRI_ID']);
		$CRI_ID = 1;
		$CHK_ID = 1;
		
		$WHERE = "WHERE resposta.RSP_CRI_ID = $CRI_ID AND resposta.RSP_CHK_ID = $CHK_ID AND descricao.DSC_CHK_ID = $CHK_ID";
		
		$consPerguntas = $db->consultarBanco("SELECT * FROM resposta INNER JOIN questao ON resposta.RSP_QST_ID = questao.QST_ID INNER JOIN criterio ON resposta.RSP_CRI_ID = criterio.CRI_ID INNER JOIN checklist ON resposta.RSP_CHK_ID = checklist.CHK_ID INNER JOIN descricao ON descricao.DSC_CRI_ID = criterio.CRI_ID $WHERE GROUP BY resposta.RSP_ID ORDER BY resposta.RSP_ID ASC");
		if($consPerguntas) {
			
			$i = 0;
			?>	
				<style>
					* {
						padding: 0;
						margin: 0;
						font-family: arial;
						text-align: left;
					}
					body {
						padding: 15px;
					}
					h3 {
						padding: 5px;
						font-size: 30px;
					}
					h4 {
						padding: 5px;
						font-size: 20px;
						line-height: 1.5;
						text-align: justify;						
					}
					p {
						padding: 5px;
						font-size: 22px;
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
							padding: 3px 5px;
							font-size: 15px;
						}
						.tr-final > td {
							background: #333;
							color: #fff;
						}
					.div-grafico {
						width: 100%;
						height: 550px;
						display: inline-block;
					}
				</style>
				<h3><?=utf8_encode($consPerguntas[0]['CRI_NOM']).' ('.utf8_encode($consPerguntas[0]['CHK_URL']).')'?></h3>
				<h4><?=utf8_encode($consPerguntas[0]['DSC_DESC'])?></h4>
				<p></p>
				<table>
					<thead>
						<tr>
							<td style="width: 50px;">#</td>
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
										<td><?=$i+1?></td>
										<td><?=utf8_encode($consPerguntas[$i]['QST_PRG'])?></td>
										<td><?=utf8_encode($consPerguntas[$i]['RSP_VLR'])?></td>
									</tr>
								<?php
								
								$i++;
							}
						?>
					</tbody>
				</table>
				<div id="div-grafico" class="div-grafico"></div>
				<script type="text/javascript">
					$(document).ready(function() {
						gerarGrafico('div-grafico', '<?=$a?>', '<?=$b?>', '<?=$c?>', 'PieChart');
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