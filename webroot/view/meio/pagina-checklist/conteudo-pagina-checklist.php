<div class="div-conteudo-pagina">
	
	<div class="div-criar-checklist">
	
		<div class="div-new-checklist">
		
			<h3 class="titulo-descritivo">Nova checklist</h3>
		
			<form id="formCriarChecklist" class="form-block" name="formCriarChecklist" method="POST" action="<?=D_PATH?>/webroot/ajax/checklist/ajax-criar-checklist.php" data-submit="#btnCriarChecklist">
				
				<div class="div-box-form">
					<input id="CHK_URL" class="input-box" type="text" name="CHK_URL" placeholder="Url:">
				</div>
				
				<div class="div-box-form text-align-right">
					<button id="btnCriarChecklist" class="btn" type="submit" data-html="Criar checklist">Criar checklist</button>
				</div>
			
			</form>
			
		</div>
		
		<div id="conteudo-listar-checklist" class="div-listar-checklist">
		
			<h3 class="titulo-descritivo">Checklists atuais</h3>
		
			<ul>		
				<?php
					$consChecklist = $db->consultarBanco("SELECT * FROM checklist WHERE CHK_STS = 'on'");
					if($consChecklist) {
						
						for($i = 0; $i < count($consChecklist); $i++) {
							?>
								<li class="li-checklist"><a href="<?=D_LINK?>"><?=utf8_encode($consChecklist[$i]['CHK_URL'])?></a></li>
							<?php
						}
						
					}
					else {
						?>
							<li>Nenhum checklist criado.</li>
						<?php	
					}		
				?>
			</ul>	
		</div>
	
	</div>

	<div class="div-etapas-checklist">
		
		<h3 class="titulo-descritivo">Critérios</h3>
	
		<ul>
			<?php
				if(Checklist::isChecklist()) {
								
				}
				else {
					?>
						<li>Selecione um checklist</li>
					<?php
				}
			?>
		</ul>
	</div>

</div>