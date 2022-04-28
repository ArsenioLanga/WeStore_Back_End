<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Produtos
{

    public function lista_produtos_disponiveis($categoria)
    {
        // TRAZER TODOS PRODUTOS DISPONIVEIS
        $db = new Database();

        // TRAZER CATEGORIAS
        $categorias = $this->lista_categorias();

        $sql = ("SELECT *FROM produtos ");
        $sql .= "WHERE visivel = 1 ";
        
            if(in_array($categoria, $categorias)){
                $sql .= "AND categoria = '$categoria'";
            }
           
        $resultado = $db->select($sql);
        return $resultado;
    }    

    public function lista_categorias(){
        // RETORNA TODAS AS CATEGORIAS
        $db = new Database();
        $resultados = $db->select("SELECT DISTINCT categoria FROM produtos");

        $categorias = [];
        foreach($resultados as $resultado){
            array_push($categorias, $resultado['categoria']);
        } 

        return $categorias;
    }

    public function verificar_Id($id){
        $db = new Database();
        $params = [
            ':id' => $id
        ];
        $resultado = $db->select("SELECT * FROM produtos WHERE id = :id AND stock > 0 AND visivel = 1", $params);
        
        return count($resultado) != 0 ? true : false;

    }

}
