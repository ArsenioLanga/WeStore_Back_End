<?php

namespace core\classes;

use Exception;
use PDO;
use PDOException;

class Database{

    private $connect;

    private function connection(){ 
        // LIGAR A BASE DE DADOS
        $this->connect =  new PDO(
            'mysql:'.
            'host='.MYSQL_SERVER.';'.
            'dbname='.MYSQL_DATABASE.';'.
            'chartset='.MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        //DEBUG
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    private function close_connection(){
        // DESLIGAR A BASE DE DADOS
        $this->connect = null;
    }

    //=========================   CRUD  =============================

    // READ
    public function select($sql, $parametros = null){

        // VERIFICAR SE E UM SELECT
        $sql = trim($sql);
        if(!preg_match("/^SELECT/i", $sql)){
            throw new Exception('Base de Dados - Nao e uma instrucao select');
        }

        // FAZER A CONEXAO
        $this->connection();

        $results = null;

        // COMUNICAR
        try {
            //cominicacao com a base da dados
            if(!empty($parametros)){
                $executy = $this->connect->prepare($sql);
                $executy->execute($parametros);
                // $results = $executy->fetchAll(PDO::FETCH_CLASS);
                // echo $clientes[0]->nome
                $results = $executy->fetchAll(PDO::FETCH_ASSOC);
                // echo $clientes[0]['nome']
            } else {
                $executy = $this->connect->prepare($sql);
                $executy->execute();
                // $results = $executy->fetchAll(PDO::FETCH_CLASS);
                $results = $executy->fetchAll(PDO::FETCH_ASSOC);
            }

        } catch (PDOException $e) {
            //caso exista erros
            return false;
        }

        // DESLIGAR A CONEXAO
        $this->close_connection();

        // RETORNAR OS RESULTADOS
        return $results;
    }

    // INSERT
    public function insert($sql, $parametros = null){

        // VERIFICAR SE E UM INSERT
        $sql = trim($sql);
        if(!preg_match("/^INSERT/i", $sql)){
            throw new Exception('Base de Dados - Nao e uma instrucao insert');
        }

        // FAZER A CONEXAO
        $this->connection();

        // COMUNICAR
        try {
            //cominicacao com a base da dados
            if(!empty($parametros)){
                $executy = $this->connect->prepare($sql);
                $executy->execute($parametros);
            } else {
                $executy = $this->connect->prepare($sql);
                $executy->execute();
            }

        } catch (PDOException $e) {
            //caso exista erros
            return false;
        }

        // DESLIGAR A CONEXAO
        $this->close_connection();
    }

     // UPDATE
     public function update($sql, $parametros = null){

        // VERIFICAR SE E UM UPDATE
        $sql = trim($sql);
        if(!preg_match("/^UPDATE/i", $sql)){
            throw new Exception('Base de Dados - Nao e uma instrucao update');
        }

        // FAZER A CONEXAO
        $this->connection();

        // COMUNICAR
        try {
            //cominicacao com a base da dados
            if(!empty($parametros)){
                $executy = $this->connect->prepare($sql);
                $executy->execute($parametros);
            } else {
                $executy = $this->connect->prepare($sql);
                $executy->execute();
            }

        } catch (PDOException $e) {
            //caso exista erros
            return false;
        }

        // DESLIGAR A CONEXAO
        $this->close_connection();
    }

    // DELETE
    public function delete($sql, $parametros = null){

        // VERIFICAR SE E UM DELETE
        $sql = trim($sql);
        if(!preg_match("/^DELETE/i", $sql)){
            throw new Exception('Base de Dados - Nao e uma instrucao delete');
        }

        // FAZER A CONEXAO
        $this->connection();

        // COMUNICAR
        try {
            //cominicacao com a base da dados
            if(!empty($parametros)){
                $executy = $this->connect->prepare($sql);
                $executy->execute($parametros);
            } else {
                $executy = $this->connect->prepare($sql);
                $executy->execute();
            }

        } catch (PDOException $e) {
            //caso exista erros
            return false;
        }

        // DESLIGAR A CONEXAO
        $this->close_connection();
    }
    

    // GENERICA
    public function statement($sql, $parametros = null){

        // VERIFICAR SE E UMA FUNCAO DIFERENTE DAS ANTERIORES
        $sql = trim($sql);
        if(preg_match("/^(SELECT|INSERT|UPADE|DELETE)/i", $sql)){
            throw new Exception('Base de Dados - Instrucao invalida');
        }

        // FAZER A CONEXAO
        $this->connection();

        // COMUNICAR
        try {
            //cominicacao com a base da dados
            if(!empty($parametros)){
                $executy = $this->connect->prepare($sql);
                $executy->execute($parametros);
            } else {
                $executy = $this->connect->prepare($sql);
                $executy->execute();
            }

        } catch (PDOException $e) {
            //caso exista erros
            return false;
        }

        // DESLIGAR A CONEXAO
        $this->close_connection();
    }
}
