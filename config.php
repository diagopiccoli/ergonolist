<?php

/*

	CONFIG PHP

*/

//CONFIGURAÇÃO DE INI
@ini_set('display_errors', 0);
@ini_set('error_reporting', 0);
error_reporting(0);
session_start();
$serverName = $_SERVER['SERVER_NAME'];

//CONFIGURAÇão DE IDIOMA
define('D_LANG', 'pt-br');

//LOCALIZAÇÃO
date_default_timezone_set("America/Sao_Paulo");

//CONFIGURAÇÃO BANCO DE DADOS PADRÃO
define('D_HOST_DB', '127.0.0.1');
define('D_USR_DB', 'root');
define('D_PWD_DB', 'vjsecco1994');
define('D_DB_DB', 'ergonolist_db');

//CONFIGURAÇÃO URL PATH RAIZ
$path = $serverName.'/ergonomia';
define('D_PATH', 'http://'.$path);
define('D_PATH_URL', $path);
define('D_TITLE', 'Engenharia de usabilidade');
define('D_LINK', 'javascript:void(0)');

//AUTOLOAD
require('__autoload.php');
$arrLoadClass = array();
array_push($arrLoadClass, 'webroot/class/Pagina.php');
array_push($arrLoadClass, 'webroot/class/Requisicao.php');
array_push($arrLoadClass, 'webroot/class/BancoDados.php');
array_push($arrLoadClass, 'webroot/class/Validador.php');
array_push($arrLoadClass, 'webroot/class/Checklist.php');
array_push($arrLoadClass, 'webroot/class/Criterio.php');
array_push($arrLoadClass, 'webroot/class/Questao.php');
array_push($arrLoadClass, 'webroot/class/Resposta.php');
autoload($arrLoadClass);

//
$db = new BancoDados(D_HOST_DB, D_USR_DB, D_PWD_DB, D_DB_DB);

?>

