<?php

//especifica em que pasta esta
namespace Hcode;
//namespace do rain
use Rain\tpl;

/**
 *
 */
//apos cria a base do construct e destruct. inicia a config do tpl
class Page {

  private $tpl;
  private $options = [];
  //algumas opcoes padroes
  private $defaults = [
		"data"=>[]
	];

  public function __construct($opts = array(), $tpl_dir = "/views/"){
    //mescla os arrays.
    //O ULTIMO ARRAY VAI SOBSCREVER OS OUTROS com a mesclagem os array fica no $options
    $this->options = array_merge($this->defaults, $opts);

    // config
  	$config = array(
            //$_SERVER["DOCUMENT_ROOT"] DIZ ONDE ESTA O ROOT. "/views/" onde esta o template
  					"tpl_dir"    => $_SERVER["DOCUMENT_ROOT"]. $tpl_dir,
  					"cache_dir"  => $_SERVER["DOCUMENT_ROOT"]. "/views-cache/",
  					"debug"      => false // set to false to improve the speed
  				   );

  	Tpl::configure( $config );

    // create the Tpl object
  	$this->tpl = new Tpl;

    $this->setData($this->options["data"]);

    //criando tags repetitivas, que serao criada na pasta 'views'
    $this->tpl->draw("header");

  }

//foreach///////////
  private function setData($data = array())
  {
    foreach ($data as $key => $value) {
      $this->tpl->assign($key, $value);
    }
  }

  //'$name' nome do template, '$data = array()' dados. por padrao e vazio
  public function setTpl($name, $data = array(), $returnHTML = false){

    $this->setData($data);

    return $this->tpl->draw($name, $returnHTML);
  }//html do conteudo

  public function __destruct(){
    //criando tags repetitivas, que serao criada na pasta 'views'
    $this->tpl->draw("footer");

  }

}


 ?>
