<?php
	require('../config.php');
	Pagina::setPagina('pagina-apresentacao');
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<?php
			require('../webroot/view/head/conteudo-head.php');
		?>
	</head>
	<body>
		
		<!-- -->
		<div class="div-box-total">
		
			<!-- -->
			<div class="div-box div-box-topo">
				<div class="div-limiter">
					<?php
						require('../webroot/view/topo/conteudo-topo.php');
					?>
				</div>
			</div>
			
			<!-- -->
			<div class="div-box div-box-conteudo">
				<div class="div-limiter">
					<?php
						require('../webroot/view/meio/pagina-apresentacao/conteudo-pagina-apresentacao.php');
					?>
				</div>
			</div>		
			
			<!-- -->
			<div class="div-box div-box-rodape">
				<div class="div-limiter">
					<?php
						//require('../webroot/view/rodape/conteudo-rodape.php');
					?>
				</div>
			</div>
			
		</div>
		
		<div id="div-retorno-geral" class="div-retorno-geral transition-all"></div>
		
	</body>
</html>