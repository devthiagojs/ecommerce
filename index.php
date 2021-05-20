<?php

require_once("vendor/autoload.php");

use \Slim\Slim;
//buscando o corpo do site.'header''footer'
use \Hcode\Page;
use \Hcode\PageAdmin;

$app = new \Slim\Slim();

$app->config('debug', true);
//daqui pra cima o nescessario para cria a pagina

//primeira rota
$app->get('/', function() {
	//tem q cria a variavel Page
	$page = new Page();//chama o __construct, o header

	$page->setTpl("index");//chama o conteudo. por exemplo o 'h1'
	//__destruct e automatico
});

$app->get('/admin', function() {

	$page = new PageAdmin();

	$page->setTpl("index");//chama o conteudo da page.

});

$app->run();

 ?>
