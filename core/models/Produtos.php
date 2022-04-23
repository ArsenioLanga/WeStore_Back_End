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

        $sql = ("SELECT *FROM produtos ");
        $sql .= "WHERE visivel = 1 ";
        
            if($categoria == 'homem' || $categoria == 'mulher'){
                $sql .= "AND categoria = '$categoria'";
            }
           
        $resultado = $db->select($sql);
        return $resultado;
    }    

}
