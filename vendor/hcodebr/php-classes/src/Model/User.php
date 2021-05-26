<?php

  namespace Hcode\Model;

  use \Hcode\DB\Sql;
  use \Hcode\Model;

class User extends Model {

  const SESSION = "User";

//busca o login no Banco de Dados
  public static function login($login, $password)
  {
    //busca o login no Banco de Dados
    $sql = new Sql();

    $results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
      ":LOGIN"=>$login
    ));

    if (count($results) === 0){
      throw new \Exception("Usuario inexistente ou senha inválida.", 1);
    }

    $data = $results[0];

    //verifica a senha
    if (password_verify($password, $data["despassword"]) === true){

      $user = new User();

      $user->setData($data);

      $_SESSION[User::SESSION] = $user->getValues();

      return $user;

    }else {
      throw new \Exception("Usuario inexistente ou senha inválida.", 1);
    }

  }

  //verificando se esta logado
  public static function verifyLogin($inadmin = true)
  {

    if(!isset($_SESSION[User::SESSION])
      ||//significa "ou"
      !$_SESSION[User::SESSION]
      ||
      !(int)$_SESSION[User::SESSION]["iduser"] > 0 //verificando ID
      ||
      (bool)$_SESSION[User::SESSION]["inadmin"]!==$inadmin//se pode acessa a administracao
  ){
      header("Location: admin/login");
      exit;
    }

  }

  }

 ?>
