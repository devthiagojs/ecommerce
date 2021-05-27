<?php

	session_start();//usop

require_once("vendor/autoload.php");

use \Slim\Slim;
//buscando o corpo do site.'header''footer'
use \Hcode\Page;
use \Hcode\PageAdmin;

use \Hcode\Model\User;

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

	User::verifyLogin();//verificando se esta logado

	$page = new PageAdmin();

	$page->setTpl("index");//chama o conteudo da page.

});

//Login do admin
$app->get('/admin/login', function(){

	$page = new PageAdmin([
		"header"=>false,//desabilitando o header do metodo __construct
		"footer"=>false
	]);
	$page->setTpl("login");

});
//validando login
$app->post('/admin/login', function(){

	User::login($_POST["login"], $_POST["password"]);
	//Redireciona para a home page da adm
	header("Location: /admin");
	exit;
});

$app->get('/admin/logout', function(){

	User::logout();

	header("Location: /admin/login");
	exit;

});

$app->run();

 ?>
