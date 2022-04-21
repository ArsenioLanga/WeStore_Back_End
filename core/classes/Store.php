<?php

namespace core\classes;

use Exception;

class Store{

  public static function Layout($estruturas, $dados = null){

    if(!is_array($estruturas)){
        throw new Exception("Colecao de esctruturas invalida");
    }

    // VARIAVEIS
    if(!empty($dados) && is_array($dados)){
      extract($dados); //cria variaveis com base nos indices

    }

    // APRESENTAR AS VIEWS DA APLICACAO

    foreach($estruturas as $estrutura){
        include("../core/views/$estrutura.php"); 
    }
  }

  public static function clienteLogado(){

    // verifica se existe um cliente logado
    return isset($_SESSION['cliente']);
  }

  public static function criarHash($tamanho = 12){

    // CRIAR HASHES
      $chars = '01234567890123456789abcdefghijklmnopqrstuvwxyabcdefghijklmnopqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXYABCDEFGHIJKLMNOPQRSTUVWXY';
      return substr(str_shuffle($chars), 0, $tamanho);
  }

  public static function redirect($route = ''){
    header("Location: ". BASE_URL . "?p=$route ");
  }
} 