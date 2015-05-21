/*

	FUNÇÕES JS

*/

<?php	
	@ini_set('display_errors', 0);
	@ini_set('error_reporting', 0);
	error_reporting(0);
	$url = $_REQUEST['path'];	
	$page = base64_decode($_REQUEST['page']);
	$arquivo = "pages/$page.js";

	header('Content-Type: application/javascript');
	
	echo 'var D_PATH = "http://'.$url.'";';
	
	require('../../__autoload.php');
	
	$arrLoadJs = array();
	array_push($arrLoadJs, 'plugins/jquery.bootstrap.js');
	array_push($arrLoadJs, 'plugins/jquery.mask.js');
	array_push($arrLoadJs, 'funcoes/ajaxRequest.js');
	array_push($arrLoadJs, 'funcoes/notificador.js');
	array_push($arrLoadJs, 'funcoes/reloadPage.js');
	array_push($arrLoadJs, 'funcoes/gerarGrafico.js');
	autoload($arrLoadJs);
	
	if(file_exists($arquivo)) {	
		require($arquivo);
	}
?>
var timerOpenNotificador;
google.load("visualization", "1", {packages:["corechart"]});
$(document).ready(function() {
	$('[data-mask]').each(function() {
		$(this).mask($(this).attr('data-mask'));
	});
	$('[data-toggle="tooltip"]').tooltip();
});