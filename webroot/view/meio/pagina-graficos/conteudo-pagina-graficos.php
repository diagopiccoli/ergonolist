<div id="div-perguntas-checklist" class="div-perguntas-checklist transition-all">
	
	<h3 class="titulo-criterio">Perguntas (<small id="categoria-perguntas">Selecione a categoria</small>)</h3>
	<div class="desc-pergunta-criterio">
		<div id="checklist-1" class="checklist-1"></div>
		<div id="checklist-2" class="checklist-2"></div>				
	</div>
	
</div>

<div class="menu-categorias">

	<form id="formSelecionarChecklist" class="form-block" name="formSelecionarChecklist" action="<?=D_PATH?>/webroot/ajax/graficos/ajax-gerar-graficos-checklist.php" method="POST">
		
		<div class="div-box-form zerar-padding-left">
			
			<label for="categoria-checklist">Selecione uma categoria:</label>
			
			<select id="CRI_ID" class="input-box" name="CRI_ID">
				<option value="" selected="" disabled="">SELECIONE</option>
				<?php
					Criterio::consultarCriteriosSelect($db);
				?>
			</select>
			
		</div>
		
		<div class="div-box-form zerar-padding-right">
		
			<label for="categoria-checklist">Selecione o tipo de gráfico:</label>
			
			<select id="CHART_TYPE" class="input-box" name="CHART_TYPE">
				<option value="PieChart" selected="">Pizza</option>
				<option value="ColumnChart">Colunas</option>
				<option value="LineChart">Linhas</option>
			</select>
		
		</div>
	
	</form>

</div>

<div id="div-resultado-checklist" class="div-resultado-checklist close transition">
	
	<div class="div-cabecalho-checklist">
		<h3 id="criterio-checklist" class="titulo-criterio"></h3>
		<p id="definicao-checklist" class="descricao-criterio"></p>
	</div>
	
	<div class="div-comparacao-checklist">
		
		<div class="div-grafico-checklist transition zerar-padding-left">
			<h3 id="h3-url-checklist-1" class="titulo-criterio"></h3>
			<div id="div-grafico-1" class="grafico-checklist"></div>
		</div>
		
		<div class="div-grafico-checklist transition zerar-padding-right">
			<h3 id="h3-url-checklist-2" class="titulo-criterio"></h3>
			<div id="div-grafico-2" class="grafico-checklist"></div>
		</div>
		
	</div>

</div>